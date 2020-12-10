function DatabaseInterface() {
    let self = this;
    let $option = jQuery('#filter-options');
    let $allMenus = jQuery('[data-visible-for*="hide"]');
    let $tableDisplay = jQuery('.database-display');
    $allMenus.hide();

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
            //todo make this get the form action - you will need to update the current state of the form action as the user uses the main select field
            url: jQuery("form[data-form='get-data']").attr('action') + $method,
            data: formData,
        }).done(this.ajaxCompleteHandler);
    }

    this.ajaxCompleteHandler = function(data) {
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
    $option.on("change", this.displayOptions);
}

let databaseInterface = new DatabaseInterface();
