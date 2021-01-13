function DatabaseInterface() {
    let self = this;
    let $tableSelection = jQuery('#table-options');
    let $tableDisplayElement = jQuery('#table-element');

    this.tableDisplayHandler = function() {
        //todo clear table contents at the beginning of this function so that only one table's data is displayed
        let selection = $tableSelection.find(':selected').attr('data-table');

        //todo - make ajax url below dynamic
        jQuery.ajax({
            type: 'GET',
            url: `/${selection}/Ajax/getTableDisplay`
        }).done(this.ajaxTableDisplayHandler.bind(this));
    }

    this.ajaxTableDisplayHandler = function(data, successState, responseObj) {
        let parsedData = JSON.parse(data);
        let tableHTML = "";
        let formElement = $('#set-form-action');
        formElement.remove();

        $tableDisplayElement.before(parsedData['formActions']);
        let $filterOption = jQuery('#filter-options');
        let $allMenus = jQuery('[data-visible-for*="hide"]');
        $allMenus.hide();
        $filterOption.on("change", this.displayFormActions.bind(this));
        jQuery('[data-form="table-actions"]').on('submit', this.formSubmitHandler.bind(this));

        parsedData['rows'].forEach(element => {
            tableHTML += "<tr><td>" + element.id + "</td><td>" + element.ip + "</td><td>" + element.date + "</td><td>" + element.calculation + "</td></tr>";
        });
        //todo get table headers working
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
        }).done(this.ajaxFormSubmitHandler);
    }

    this.ajaxFormSubmitHandler = function(data, successState, responseObj) {
        $tableDisplayElement.show();
        let parsedData = JSON.parse(data);
        let rowsUpdated = parsedData['rowsModified'];
        let tableHTML = "";
        let tableHeadersElement = jQuery('.table-headers');

        parsedData['allResults'].forEach(element => {
            tableHTML += "<tr><td>" + element.id + "</td><td>" + element.ip + "</td><td>" + element.date + "</td><td>" + element.calculation + "</td></tr>";
        });

        jQuery('.insert-message').html(rowsUpdated);
        tableHeadersElement.siblings().remove();
        tableHeadersElement.after(tableHTML);
        jQuery("form[data-form='table-actions']")[0].reset();
    }


    $tableSelection.on("change", this.tableDisplayHandler.bind(this));
}

let databaseInterface = new DatabaseInterface();
