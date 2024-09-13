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
            $(form).addClass('was-validated'); // Activa las validaciones de Bootstrap
            form.submit(); // Envía el formulario si es válido
        }
    });

    // Función de validación para el campo de año
    function validarAnio(input) {
        const yearValue = input.val();
        const yearInt = parseInt(yearValue);

        // Remover clases de validación en cada cambio
        input.removeClass('is-invalid is-valid');

        // Validar que solo sean números y que tenga hasta 4 dígitos
        const isValidNumber = /^\d{1,4}$/.test(yearValue);

        if (!isValidNumber || isNaN(yearInt)) {
            input.addClass('is-invalid');
            input.siblings('.invalid-feedback').text('El año debe ser un número válido de hasta 4 dígitos.');
        } else if (yearInt < minYear) {
            input.addClass('is-invalid');
            input.siblings('.invalid-feedback').text(`El año no puede ser menor a ${minYear}.`);
        } else if (yearInt > maxYear) {
            input.addClass('is-invalid');
            input.siblings('.invalid-feedback').text(`El año no puede ser mayor a ${maxYear}.`);
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

    // Validación para el campo de imagen
    $('#imagen').on('change', function (event) {
        const file = event.target.files[0];
        if (file) {
            const validImageTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg'];

            // Verifica si el archivo es de un tipo de imagen permitido
            if (!validImageTypes.includes(file.type)) {
                alert('Por favor, seleccione solo archivos de imagen (JPG, JPEG, PNG, GIF).');
                $(this).val(''); // Limpia el input para evitar el envío del archivo no válido
            }
        }
    });
});
