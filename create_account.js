function CreateAccount() {

    this.newAccountHandler = function (ev) {
        ev.preventDefault();
        let formData = jQuery(ev.currentTarget).serializeArray();
        jQuery.ajax({
            type: 'POST',
            url: '/Users/Ajax/add',
            data: formData,
        }).done(this.ajaxNewAccountHandler.bind(this));
    }

    this.ajaxNewAccountHandler = function (data, successState, responseObj) {
        let parsedData = JSON.parse(data);

        if (parsedData['response']) {
            window.location.href = 'executePostCreation';
        } else {
            $('.insert-message').html(parsedData['responseMessage']);
        }
    }

    jQuery('[data-form="create-account-form"]').on("submit", this.newAccountHandler.bind(this));
}

let newAccount = new CreateAccount();
