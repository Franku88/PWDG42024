<?php
    include "../../Control/Matematica.php";
    include "../../Utils/funciones.php";

    $datos = data_submitted();
    $mat = new Matematica();
    $resultado = $mat->operar($datos);
?>

<html>

    <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <title>Ejercicio 7: Resultado</title>
    </head>

    <body>
        <div>
            <h1 class="position-relative border p-4">Ejercicio 7: Resultado</h1>
        </div>
        <div class="modal position-relative d-block p-5 py-md-5">
            <div class="modal-dialog">
                <div class="modal-content rounded-4 shadow">
                    <div class="modal-header p-5 pb-4 border-bottom-0">
                        <p class="fw-bold mb-0 fs-4"><?php echo($datos["num1"]." ".$datos["operacion"]." ".$datos["num2"]." = ".$resultado)?></p>
                    </div>
                    <div class="modal-body p-5 pt-0">
                        <form action="../ej7.php">
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