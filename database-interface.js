function DatabaseInterface() {
    let self = this;
    let $tableSelection = jQuery('#table-options');

    this.tableDisplayHandler = function() {
        let selection = $tableSelection.find(':selected').attr('data-table');

        //todo - make ajax url below dynamic
        jQuery.ajax({
            type: 'GET',
            url: `/${selection}/Ajax/getTableDisplay`
        }).done(this.ajaxTableDisplayHandler.bind(this));
    }

    this.ajaxTableDisplayHandler = function(data, successState, responseObj) {
        let parsedData = JSON.parse(data);
        let $formElement = $('#set-form-action');
        let $tableDisplayElement = jQuery('#table-element');
        let $dbDisplayElement = jQuery('#db-display');

        $formElement.remove();
        $tableDisplayElement.remove();

        $dbDisplayElement.after(parsedData['template']);

        let $filterOption = jQuery('#filter-options');
        let $allMenus = jQuery('[data-visible-for*="hide"]');
        $allMenus.hide();

        $filterOption.on("change", this.displayFormActions.bind(this));
        jQuery('[data-form="table-actions"]').on('submit', this.formSubmitHandler.bind(this));

        let tableHTML = this.createTableHTML(parsedData['tableData']);

        jQuery('.table-headers').after(tableHTML);
    }

    this.displayFormActions = function() {
        let showType = jQuery("#filter-options").find(':selected').attr('data-show-val');
        let $selectedFilter = jQuery('[data-visible-for*="' + showType + '"]');
        let $remainingFilters = jQuery('[data-visible-for]');
        $remainingFilters.hide();
        $selectedFilter.show();
    }

    this.formSubmitHandler = function(ev) {
        ev.preventDefault();
        let formData = jQuery(ev.currentTarget).serializeArray();
        let selection = $tableSelection.find(':selected').attr('data-table');
        //todo make action path flexible
        $('#set-form-action').attr('action', `/${selection}/Ajax/`);
        let $method = jQuery('#filter-options').find(':selected').attr('data-method');

        jQuery.ajax({
            type: 'POST',
            url: jQuery("form[data-form='table-actions']").attr('action') + $method,
            data: formData,
        }).done(this.ajaxFormSubmitHandler.bind(this));
    }

    this.ajaxFormSubmitHandler = function(data, successState, responseObj) {
        let parsedData = JSON.parse(data);
        //todo may want to use rows modified in a success message; currently undefined/not part of response
        let rowsUpdated = parsedData['rowsModified'];
        let tableHeadersElement = jQuery('.table-headers');

        //todo - low priority, but could be nice to highlight the row that was added after an add request
        let tableHTML = this.createTableHTML(parsedData['tableData']);

        jQuery('.insert-message').html(rowsUpdated);
        tableHeadersElement.siblings().remove();
        tableHeadersElement.after(tableHTML);
        jQuery("form[data-form='table-actions']")[0].reset();
    }

    this.createTableHTML = function(data) {
        let tableHTML = '';

        for (let i = 0; i < data.length; i++) {
            tableHTML += "<tr>";
            if (`${data[i]['deleted']}` != 1) {
                for (const value in data[i]) {
                    if (`${value}` !== 'deleted' && `${value}` !== 'password') {
                        tableHTML += "<td>" + `${data[i][value]}` + "</td>";
                    }
                }
            }
            tableHTML += "</tr>";
        }
        return tableHTML;
    }

    $tableSelection.on("change", this.tableDisplayHandler.bind(this));
}

let databaseInterface = new DatabaseInterface();
