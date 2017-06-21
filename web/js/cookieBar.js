$(document).ready(function() {
    $('.cookie-message').cookieBar({ closeButton : '.my-close-button', hideOnClose: false });
    $('.cookie-message').on('cookieBar-close', function() { $(this).slideUp(); });
});
