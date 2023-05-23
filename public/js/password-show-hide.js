$(document).ready(function () {
    $('#password + .glyphicon').on('click', function () {
        $(this).toggleClass('fa-eye-slash').toggleClass('fa-eye'); // toggle our classes for the eye icon
        $('#password').togglePassword(); // activate the hideShowPassword plugin
    });

    $('#password-confirm + .glyphicon').on('click', function () {
        $(this).toggleClass('fa-eye-slash').toggleClass('fa-eye'); // toggle our classes for the eye icon
        $('#password-confirm').togglePassword(); // activate the hideShowPassword plugin
    });

    const $feedback = $('.invalid-feedback');
    if ($feedback.length > 0) {
        $('.form-control.is-invalid').css('background-image', 'none');
    }

    const $passwordInput = $('#password');
    $passwordInput.on('click', function () {
        $('.form-control').removeClass('is-invalid');
    });
});