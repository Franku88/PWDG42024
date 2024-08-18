$(document).ready(function() {
    /* Aplicamos validación del formulario*/


    // Recuperamos el form y el label para mostrar el error
    var form = $('#form');
    var error = $('#error');
    var password = $('#password');
    var username = $('#user');

    form.submit(function(event) {
        // 1. Validamos que el usuario y la contraseña no estén vacíos
        if (password.val() === '' || username.val() === '') {
            error.text('El usuario y la contraseña son obligatorios').css('color', 'red');
            event.preventDefault();
        } 
        // 2. Validamos que la contraseña tenga al menos 8 caracteres
        else if (password.val().length < 8) {
            error.text('La contraseña debe tener al menos 8 caracteres').css('color', 'red');;
            event.preventDefault();
        } 
        // 3. Validamos que la contraseña no sea igual al nombre de usuario
        else if (password.val() === username.val()) {
            error.text('La contraseña no puede ser igual al nombre de usuario').css('color', 'red');;
            event.preventDefault();
        } 
        // 4. Validamos que la contraseña contenga al menos una letra y un número
        else if (!password.val().match(/^(?=.*[a-zA-Z])(?=.*\d)[a-zA-Z\d]+$/)) {
            error.text('La contraseña debe contener letras y números').css('color', 'red');;
            event.preventDefault();
        }
    });
});
