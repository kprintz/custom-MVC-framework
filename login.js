function Login() {
let $loginButton = jQuery(".buttons__login");

    this.loginHandler = function (ev) {
        let formData = jQuery(ev.currentTarget).serializeArray();
        jQuery.ajax({
            type: 'POST',
            url: '/Users/Ajax/Verify',
            data: formData,
        }).done(this.ajaxLoginHandler);
    }

    this.ajaxLoginHandler = function () {
        let parsedData = JSON.parse(data);

        if (parsedData['response'] === true) {
            console.log('great job');
        } else {
            jQuery('.insert-message').html(parsedData['responseMessage']);
        }
    }

    $loginButton.on("submit", this.loginHandler.bind(this));
}

let login = new Login;
