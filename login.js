function Login() {
    let form = $('[data-form="login-form"]');
    let loginButton = $('#login_button');
    let createAccountButton = $('#create_button');

    this.loginHandler = function (ev) {
        ev.preventDefault();
        let formData = form.serializeArray();
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

    this.createAccountHandler = function (ev) {
        ev.preventDefault();
        //todo use ajax to move username and password to account creation page if entered on login page
        window.location.href = '/Account/Index/execute';
    }

    //todo is there a better way to do this or should I just add more events
    loginButton.on("click", this.loginHandler.bind(this));
    createAccountButton.on("click", this.createAccountHandler.bind(this));
}

let login = new Login();
