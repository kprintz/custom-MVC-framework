function DatabaseInterface() {
    let self = this;
    let $databaseSelection = jQuery('#database-options');
    let $filterOption = jQuery('#filter-options');
    let $allMenus = jQuery('[data-visible-for*="hide"]');
    let $tableDisplay = jQuery('.database-display');
    $allMenus.hide();
    $tableDisplay.hide();

    this.changeFormAction = function() {
        let selection = $databaseSelection.find(':selected').attr('data-database');
        $('#set-form-action').attr('action', `'/${selection}/Index/'`);
        let method = $databaseSelection.find(':selected').attr('data-method');
        //todo - make url more flexible
        jQuery.ajax({
            type: 'POST',
            url: '/Database/Ajax/' + method,
            data: {
                'test': method
            },
        }).done(function (data, test) {
            $tableDisplay.show();
        });
    }

    this.displayOptions = function() {
        let showType = jQuery("#filter-options").find(':selected').attr('data-show-val');
        let $selectedFilter = jQuery('[data-visible-for*="' + showType + '"]');
        let $remainingFilters = jQuery('[data-visible-for]');
        $remainingFilters.hide();
        $selectedFilter.show();
    }

    this.formSubmitHandler = function(ev) {
        ev.preventDefault();
        let formData = jQuery(ev.currentTarget).serializeArray();
        let $method = jQuery('#filter-options').find(':selected').attr('data-method');

        jQuery.ajax({
            type: 'POST',
            url: jQuery("form[data-form='get-data']").attr('action') + $method,
            data: formData,
        }).done(this.ajaxCompleteHandler);
    }

    this.ajaxCompleteHandler = function(data) {
        //todo only show table selected (users OR calculations)
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
    $filterOption.on("change", this.displayOptions);
    $databaseSelection.on("change", this.changeFormAction);
}

let databaseInterface = new DatabaseInterface();
