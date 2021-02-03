function Login() {

    this.loginHandler = function (ev) {
        ev.preventDefault();
        let formData = jQuery(ev.currentTarget).serializeArray();
        jQuery.ajax({
            type: 'POST',
            url: '/Users/Ajax/verify',
            data: formData,
        }).done(this.ajaxLoginHandler.bind(this));
    }

    this.ajaxLoginHandler = function (data, successState, responseObj) {
        let parsedData = JSON.parse(data);

        if (parsedData['response']) {
            window.location.href = '/Database/Index/executePostLogin';
        } else {
            $('.insert-message').html(parsedData['responseMessage']);
        }
    }
    jQuery('[data-form="login-form"]').on("submit", this.loginHandler.bind(this));
}

let login = new Login();
