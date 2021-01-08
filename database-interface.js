function DatabaseInterface() {
    let self = this;
    let $tableSelection = jQuery('#table-options');
    let $filterOption = jQuery('#filter-options');
    let $allMenus = jQuery('[data-visible-for*="hide"]');
    let $tableDisplay = jQuery('.table-display');
    $allMenus.hide();
    $tableDisplay.hide();

    this.tableDisplayHandler = function() {
        //todo clear data contents at the beginning of this function so that only the latest selection is displayed
        let selection = $tableSelection.find(':selected').attr('data-table');

        //todo - make ajax url below more dynamic
        jQuery.ajax({
            type: 'GET',
            url: `/${selection}/Ajax/getTableDisplay`,
        }).done(this.ajaxTableDisplayHandler);
    }

    this.ajaxTableDisplayHandler = function(data, successState, responseObj) {
        $tableDisplay.show();
        let parsedData = JSON.parse(data);
        let tableHTML = " "

        parsedData['rows'].forEach(element => {
            tableHTML += "<tr><td>" + element.id + "</td><td>" + element.ip + "</td><td>" + element.date + "</td><td>" + element.calculation + "</td></tr>";
        });

        jQuery('.table-headers').after(tableHTML);
    }

    this.displayTableActions = function() {
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
            url: jQuery("form[data-form='get-data']").attr('action') + $method,
            data: formData,
        }).done(this.ajaxFormSubmitHandler);
    }

    this.ajaxFormSubmitHandler = function(data, successState, responseObj) {
        $tableDisplay.show();
        let parsedData = JSON.parse(data);
        let rowsUpdated = parsedData['rowsModified'];
        let tableHTML = " "

        parsedData['allResults'].forEach(element => {
            tableHTML += "<tr><td>" + element.ID + "</td><td>" + element.ip + "</td><td>" + element.date + "</td><td>" + element.calculation + "</td></tr>";
        });

        jQuery('.insert-message').html(rowsUpdated);
        jQuery('.table-headers').after(tableHTML);
        jQuery("form[data-form='get-data']")[0].reset();
    }

    jQuery('[data-form="get-data"]').on('submit', this.formSubmitHandler.bind(this));
    $filterOption.on("change", this.displayTableActions);
    $tableSelection.on("change", this.tableDisplayHandler.bind(this));
}

let databaseInterface = new DatabaseInterface();
