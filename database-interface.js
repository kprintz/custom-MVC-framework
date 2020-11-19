function DatabaseInterface() {
    let self = this;
    let option = document.getElementById("filter-options");
    let menu = $('.edit-window__filters');
    let tableDisplay = $('.database-display');
    menu.hide();

    this.displayOptions = function() {
        menu.show();
        let showType = jQuery("#filter-options").find(':selected').attr('data-show-val');
        let $selectedFilter = jQuery('[data-visible-for*="' + showType + '"]');
        let $remainingFilters = jQuery('[data-visible-for]');

        $remainingFilters.hide();
        $remainingFilters.parent().hide();
        $selectedFilter.show();
        $selectedFilter.parent().show();

    }

    this.pageDisplay = function() {
        jQuery.ajax({
            type: 'POST',
            url: '/Calculation/Index/getAllData',
            data: 'test',
        }).done(this.ajaxCompleteHandler);
    }

    this.formSubmitHandler = function(ev) {
        ev.preventDefault();
        let formData = jQuery(ev.currentTarget).serializeArray();
        let $method = $('#filter-options').find(':selected').attr('data-method');

        jQuery.ajax({
            type: 'POST',
            //todo make this get the form action - you will need to update the current state of the form action as the user uses the main select field
            url: jQuery('#edit-form-reset').attr('action') + $method,
            data: formData,
        }).done(this.ajaxCompleteHandler);
    }

    this.ajaxCompleteHandler = function(data) {
        tableDisplay.show();
        let parsedData = JSON.parse(data);
        let rowsUpdated = parsedData['rowsUpdated'];
        let tableHTML = " "

        parsedData['allResults'].forEach(element => {
            tableHTML += "<tr><td>" + element.ID + "</td><td>" + element.ip + "</td><td>" + element.date + "</td><td>" + element.calculation + "</td></tr>";
        });

        $('.insert-message').html(rowsUpdated);
        $('.table-headers').after(tableHTML);
        $('#edit-form-reset')[0].reset();
    }

    jQuery(document).ready(this.pageDisplay);
    jQuery('[data-form="get-data"]').on('submit', this.formSubmitHandler.bind(this));
    option.addEventListener("change", this.displayOptions);
}

let databaseInterface = new DatabaseInterface();
