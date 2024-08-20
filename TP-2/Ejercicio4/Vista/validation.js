$(document).ready(function () {
    // Validación para el campo de año
    $('#anio').on('input', function () {
        const maxLength = 4;
        var date = new Date();
        var year = date.getFullYear();
        if ($(this).val().length > maxLength || $(this).val() > year) {
            $(this).val($(this).val().slice(0, maxLength)); // Te obliga a que el campo de anio no supere los 4 dígitos
            $(this).val(year); // Si pones un año mayor al actual, se pone el año actual como valor por defecto
        }
    });

    // Validación para el campo de duración
    $('#duracion').on('input', function () {
        const maxLength = 3;
        if ($(this).val().length > maxLength) {
            $(this).val($(this).val().slice(0, maxLength));
        }
    });

    // Al hacer clic en el botón "Enviar"
    $("#peliculaForm").on("submit", function (event) {
        event.preventDefault(); // Evita que se envíe el formulario automáticamente
        let form = this;

        // Verifica si el formulario es válido según Bootstrap
        if (form.checkValidity() === false) {
            event.stopPropagation(); // Detiene el envío si no es válido
        } else {
            // Si el formulario es válido, envíalo manualmente
            form.submit();
        }

        $(form).addClass('was-validated'); // Agrega la clase para activar las validaciones de Bootstrap
    });

    // Limpiar el formulario y las clases de validación al hacer clic en "Borrar"
    $("button[type='reset']").click(function () {
        $("#peliculaForm").removeClass('was-validated');
    });

       // Al recargar la página, esconder el div de datos de la película
    if (performance.navigation.type === performance.navigation.TYPE_RELOAD) {
        $(".mt-4").hide();
    }
});
