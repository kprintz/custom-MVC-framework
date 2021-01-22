function DatabaseInterface() {
    let self = this;
    let $tableSelection = jQuery('#table-options');

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
        let $formElement = $('#set-form-action');
        let $tableDisplayElement = jQuery('#table-element');
        let $dbInterfaceElement = jQuery('#db-interface');

        $formElement.remove();
        $tableDisplayElement.remove();

        $dbInterfaceElement.after(parsedData['formActions']);
        $('#set-form-action').after(parsedData['tableDisplay']);

        let $filterOption = jQuery('#filter-options');
        let $allMenus = jQuery('[data-visible-for*="hide"]');
        $allMenus.hide();

        $filterOption.on("change", this.displayFormActions.bind(this));
        jQuery('[data-form="table-actions"]').on('submit', this.formSubmitHandler.bind(this));

        parsedData['tableData'].forEach(element => {
            if (element.deleted != 1) {
                tableHTML += "<tr><td>" + element.id + "</td><td>" + element.ip + "</td><td>" + element.date + "</td><td>" + element.calculation + "</td></tr>";
            }
        });

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
        let parsedData = JSON.parse(data);
        //todo may want to use rows modified in a success message; currently undefined/not part of response
        let rowsUpdated = parsedData['rowsModified'];
        let tableHTML = "";
        let tableHeadersElement = jQuery('.table-headers');

        //todo - low priority, but could be nice to highlight the row that was added after an add request
        parsedData['tableData'].forEach(element => {
            if (element.deleted != 1) {
                tableHTML += "<tr><td>" + element.id + "</td><td>" + element.ip + "</td><td>" + element.date + "</td><td>" + element.calculation + "</td></tr>";
            }
        });

        jQuery('.insert-message').html(rowsUpdated);
        tableHeadersElement.siblings().remove();
        tableHeadersElement.after(tableHTML);
        jQuery("form[data-form='table-actions']")[0].reset();
    }

    $tableSelection.on("change", this.tableDisplayHandler.bind(this));
}

let databaseInterface = new DatabaseInterface();
