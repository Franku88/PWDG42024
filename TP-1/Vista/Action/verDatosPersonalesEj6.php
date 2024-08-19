<?php
    include "../../Control/Persona.php";
    include "../../Utils/funciones.php";

    $datos = data_submitted();

    //Verifica si se marcó algun deporte
    if (isset($datos["deportes"])) { //Verifica que este definido el array
        $deportes = $datos["deportes"];
    } else {
        $deportes = array();
    }
    
    $persona1 = new Persona($datos["nombre"], $datos["apellido"], $datos["edad"], $datos["direccion"], $datos["estudios"], $datos["sexo"], $deportes);
    $presentacion = $persona1->presentarseEESD();
?>

<html>

    <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <title>Ejercicio 6: Resultado</title>
    </head>

    <body>
        <div>
            <h1 class="position-relative border p-4">Ejercicio 6: Resultado</h1>
        </div>
        <div class="modal position-relative d-block p-5 py-md-5">
            <div class="modal-dialog">
                <div class="modal-content rounded-4 shadow">
                    <div class="modal-header p-5 pb-4 border-bottom-0">
                        <p class="fw-bold mb-0 fs-4"><?php echo(nl2br($presentacion))?></p>
                    </div>
                    <div class="modal-body p-5 pt-0">
                        <form action="../ej6.php">
                            <div class="form-floating mb-2">
                                <button class="w-100 btn btn-lg rounded-3 btn-primary">Volver</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>