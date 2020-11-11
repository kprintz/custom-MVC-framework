document.addEventListener('DOMContentLoaded', init, false);

function init() {
    let option = document.getElementById("updateTypeID");
    function displayOptions() {
        if (option.value === 'getAllData') {
            document.querySelectorAll(".edit-window__options").forEach(element => {
                    element.style.display = 'none';
                }
            );
            console.log('great');
        } else {
            document.querySelectorAll(".edit-window__options").forEach(element => {
                    element.style.display = 'block';
                }
            );

            if (option.value === 'updateData') {
                document.getElementById("options-view").style.display = 'none';
                document.getElementById("options-update").style.display = 'block';
            }
            if (option.value === 'getRows' || option.value === 'deleteData') {
                document.getElementById("options-view").style.display = 'block';
                document.getElementById("options-update").style.display = 'none';
            }
        }

    }
    jQuery('[data-form="get-data"]').on('submit', function(ev) {
        ev.preventDefault();
        jQuery.ajax({
            //todo send to server
        });
    });
    option.addEventListener("click", displayOptions);
}
