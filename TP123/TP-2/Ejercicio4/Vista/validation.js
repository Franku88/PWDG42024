$(document).ready(function () {
    const maxYear = new Date().getFullYear();
    const minYear = 1850;

    // Validación al escribir en el campo de año
    $('#anio').on('input', function () {
        validarAnio($(this));
    });

    // Validación al enviar el formulario
    $("#peliculaForm").on("submit", function (event) {
        let form = this;
        let anioInput = $('#anio');

        // Validar el campo de año antes de enviar
        validarAnio(anioInput);

        // Verifica si el formulario es válido según Bootstrap y la lógica adicional
        if (form.checkValidity() === false || anioInput.hasClass('is-invalid')) {
            event.preventDefault();
            event.stopPropagation(); // Evita el envío si no es válido
        } else {
            // Remover el preventDefault para permitir el envío del formulario
            form.submit();
        }

        $(form).addClass('was-validated'); // Activa las validaciones de Bootstrap
    });

    // Función de validación para el campo de año
    function validarAnio(input) {
        const yearValue = parseInt(input.val());

        // Remover clases de validación en cada cambio
        input.removeClass('is-invalid is-valid');

        if (isNaN(yearValue) || yearValue < 0) {
            input.addClass('is-invalid');
            input.siblings('.invalid-feedback').text('El año no puede ser negativo.');
        } else if (yearValue > maxYear) {
            input.addClass('is-invalid');
            input.siblings('.invalid-feedback').text(`El año no puede ser mayor a ${maxYear}.`);
        } else if (yearValue < minYear) {
            input.addClass('is-invalid');
            input.siblings('.invalid-feedback').text(`El año no puede ser menor a ${minYear}.`);
        } else {
            input.addClass('is-valid');
        }
    }

    // Validación para el campo de duración
    $('#duracion').on('input', function () {
        const maxLength = 3;
        let durationValue = parseInt($(this).val());

        if (durationValue < 0 || $(this).val().length > maxLength) {
            // Si el valor es negativo o excede los 3 dígitos, ajustarlo
            $(this).val(Math.max(0, durationValue).toString().slice(0, maxLength));
        }
    });

    // Limpiar el formulario y las clases de validación al hacer clic en "Borrar"
    $("button[type='reset']").click(function () {
        $("#peliculaForm").removeClass('was-validated');
        // Limpia las clases de validación en los campos individuales
        $('#anio, #duracion').removeClass('is-valid is-invalid');
    });

    // Al recargar la página, esconder el div de datos de la película
    if (performance.navigation.type === performance.navigation.TYPE_RELOAD) {
        $(".mt-4").hide();
    }
});
