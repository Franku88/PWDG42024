$(function() {
    var esValido = true;
    const msjVacio = "Valor necesario.";
    const msjNaN = "El valor no es numerico.";
    const msjRango = "El valor debe ser igual o mayor a 0.";
    const msjRadio = "Seleccione una opcion.";

    $("#miFormulario1").on("submit", function(event) {
        // Previene el envío del formulario si hay errores
        esValido = true;
        // Limpia mensajes de error anteriores
        $(".error").text("");
        
        var numero = $("#numero").val().trim();
        if (numero == "") {
            $("#errorNumero").text(msjVacio);
            esValido = false;
        } else {
            if (isNaN(parseFloat(numero))) {
                $("#errorNumero").text(msjNaN);
                esValido = false;
            }
        }

        // Si el formulario no es válido, evita el envío
        if (!esValido) {
            event.preventDefault();
        }
    });

    $("#miFormulario2").on("submit", function(event) {
        // Previene el envío del formulario si hay errores
        esValido = true;
        // Limpia mensajes de error anteriores
        $(".error").text("");

        var lunes = $("#lunes").val().trim();
        var martes = $("#martes").val().trim();
        var miercoles = $("#miercoles").val().trim();
        var jueves = $("#jueves").val().trim();
        var viernes = $("#viernes").val().trim();
        
        if (lunes == "") {
            $("#errorLunes").text(msjVacio);
            esValido = false;
        } else {
            if (isNaN(parseFloat(lunes))) {
                $("#errorLunes").text(msjNaN);
                esValido = false;
            } else {
                if (lunes < 0) {
                    $("#errorLunes").text(msjRango);
                    esValido = false;
                }     
            }
        }
        
        if (martes == "") {
            $("#errorMartes").text(msjVacio);
            esValido = false;
        } else {
            if (isNaN(parseFloat(martes))) {
                $("#errorMartes").text(msjNaN);
                esValido = false;
            } else {
                if (martes < 0) {
                    $("#errorMartes").text(msjRango);
                    esValido = false;
                }     
            }
        }

        if (miercoles == "") {
            $("#errorMiercoles").text(msjVacio);
            esValido = false;
        } else {
            if (isNaN(parseFloat(miercoles))) {
                $("#errorMiercoles").text(msjNaN);
                esValido = false;
            } else {
                if (miercoles < 0) {
                    $("#errorMiercoles").text(msjRango);
                    esValido = false;
                }     
            }
        }

        if (jueves == "") {
            $("#errorJueves").text(msjVacio);
            esValido = false;
        } else {
            if (isNaN(parseFloat(jueves))) {
                $("#errorJueves").text(msjNaN);
                esValido = false;
            } else {
                if (jueves < 0) {
                    $("#errorJueves").text(msjRango);
                    esValido = false;
                }     
            }
        }

        if (viernes == "") {
            $("#errorViernes").text(msjVacio);
            esValido = false;
        } else {
            if (isNaN(parseFloat(viernes))) {
                $("#errorViernes").text(msjNaN);
                esValido = false;
            } else {
                if (viernes < 0) {
                    $("#errorViernes").text(msjRango);
                    esValido = false;
                }     
            }
        }

        // Si el formulario no es válido, evita el envío
        if (!esValido) {
            event.preventDefault();
        }
    });

    $("#miFormulario3").on("submit", function(event) {
        // Previene el envío del formulario si hay errores
        esValido = true;
        // Limpia mensajes de error anteriores
        $(".error").text("");

        var nombre = $("#nombre").val().trim();
        var apellido = $("#apellido").val().trim();
        var edad = $("#edad").val().trim();
        var direccion = $("#direccion").val().trim();
        
        if (nombre == "") {
            $("#errorNombre").text(msjVacio);
            esValido = false;
        }

        if (apellido == "") {
            $("#errorApellido").text(msjVacio);
            esValido = false;
        }

        if (edad == "") {
            $("#errorEdad").text(msjVacio);
            esValido = false;
        } else {
            if (isNaN(parseFloat(edad))) {
                $("#errorEdad").text(msjNaN);
                esValido = false;
            } else {
                if (edad < 0) {
                    $("#errorEdad").text(msjRango);
                    esValido = false;
                }
            }
        }

        if (direccion == "") {
            $("#errorDireccion").text(msjVacio);
            esValido = false;
        }

        // Si el formulario no es válido, evita el envío
        if (!esValido) {
            event.preventDefault();
        }
    });

    $("#miFormulario5").on("submit", function(event) {
        // Previene el envío del formulario si hay errores
        esValido = true;
        // Limpia mensajes de error anteriores
        $(".error").text("");

        var nombre = $("#nombre").val().trim();
        var apellido = $("#apellido").val().trim();
        var edad = $("#edad").val().trim();
        var direccion = $("#direccion").val().trim();
        var estudios = $('input[name="estudios"]:checked').val(); 
        var sexo = $('input[name="sexo"]:checked').val();
        
        if (nombre == "") {
            $("#errorNombre").text(msjVacio);
            esValido = false;
        }

        if (apellido == "") {
            $("#errorApellido").text(msjVacio);
            esValido = false;
        }

        if (edad == "") {
            $("#errorEdad").text(msjVacio);
            esValido = false;
        } else {
            if (isNaN(parseFloat(edad))) {
                $("#errorEdad").text(msjNaN);
                esValido = false;
            } else {
                if (edad < 0) {
                    $("#errorEdad").text(msjRango);
                    esValido = false;
                }
            }
        }

        if (direccion == "") {
            $("#errorDireccion").text(msjVacio);
            esValido = false;
        }

        if (sexo == null) {
            $("#errorSexo").text(msjRadio);
            esValido = false;
        }

        if (estudios == null) {
            $("#errorEstudios").text(msjRadio);
            esValido = false;
        }

        // Si el formulario no es válido, evita el envío
        if (!esValido) {
            event.preventDefault();
        }
    });

    $("#miFormulario7").on("submit", function(event) {
        // Previene el envío del formulario si hay errores
        esValido = true;
        // Limpia mensajes de error anteriores
        $(".error").text("");

        var num1 = $("#num1").val().trim();
        var num2 = $("#num2").val().trim();
        var operacion = $("#operacion").val();

        if (num1 == "") {
            $("#errorNum1").text(msjVacio);
            esValido = false;
        } else {
            if (isNaN(parseFloat(num1))) {
                $("#errorNum1").text(msjNaN);
                esValido = false;
            }
        }

        if (num2 == "") {
            $("#errorNum2").text(msjVacio);
            esValido = false;
        } else {
            if (isNaN(parseFloat(num2))) {
                $("#errorNum2").text(msjNaN);
                esValido = false;
            }
        }

        if (operacion == "") {
            $("#errorOperacion").text(msjVacio);
            esValido = false;
        }

        // Si el formulario no es válido, evita el envío
        if (!esValido) {
            event.preventDefault();
        }
    });

    $("#miFormulario8").on("submit", function(event) {
        // Previene el envío del formulario si hay errores
        esValido = true;
        // Limpia mensajes de error anteriores
        $(".error").text("");

        var edad = $("#edad").val().trim();
        var estudia = $('input[name="estudia"]:checked').val(); 

        if (edad == "") {
            $("#errorEdad").text(msjVacio);
            esValido = false;
        } else {
            if (isNaN(parseFloat(edad))) {
                $("#errorEdad").text(msjNaN);
                esValido = false;
            } else {
                if (edad < 0) {
                    $("#errorEdad").text(msjRango);
                    esValido = false;
                }
            }
        }

        if (estudia == null) {
            $("#errorEstudia").text(msjRadio);
            esValido = false;
        }

        // Si el formulario no es válido, evita el envío
        if (!esValido) {
            event.preventDefault();
        }
    });
}
);