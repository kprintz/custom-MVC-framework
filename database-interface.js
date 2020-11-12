function DatabaseInterface() {
    let option = document.getElementById("filter-options");
    let menu = $('.edit-window__options');
    menu.hide();

    function displayOptions() {
        menu.show();
        let showType = jQuery("#filter-options").find(':selected').attr('data-show-val');
        let $selectedFilter = jQuery('[data-visible-for*="' + showType + '"]');
        let $remainingFilters = jQuery('[data-visible-for]');

        $remainingFilters.hide();
        $remainingFilters.parent().hide();
        $selectedFilter.show();
        $selectedFilter.parent().show();

    }

    jQuery('[data-form="get-data"]').on('submit', function (ev) {
        ev.preventDefault();

        let $columnName = $('#columnHeader').val();
        let $inputData = $('#dataInput').val();
        let $currentVal = $('#currentVal').val();
        let $newVal = $('#newVal').val();
        let $method = $('#filter-options').find(':selected').attr('data-method');

        jQuery.ajax({
            type: 'POST',
            url: 'Calculation/Index/' + $method,
            data: {
                'columnName': $columnName,
                'inputData': $inputData,
                'currentValue': $currentVal,
                'newValue': $newVal,
            }
        }).done(function (data, test, stuff) {
            console.log('db data sent')
        });

    });
    option.addEventListener("change", displayOptions);
}

let databaseInterface = DatabaseInterface();
