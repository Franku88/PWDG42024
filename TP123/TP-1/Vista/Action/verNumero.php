<?php
    include "../../Control/Numero.php";
    include "../../Utils/funciones.php";
    
    $numero = new Numero();
    $mensaje = $numero->verSigno(data_submitted());
?>

<html>

<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Ejercicio 1: Resultado</title>
</head>
<body>
    <div>
        <h1 class="position-relative border p-4">Ejercicio 1: Resultado</h1>
    </div>
    <div class="modal position-relative d-block p-5 py-md-5">
        <div class="modal-dialog">
            <div class="modal-content rounded-4 shadow">
                <div class="modal-header p-5 pb-4 border-bottom-0">
                    <p class="fw-bold mb-0 fs-3">El valor ingresado es <b><?php echo($mensaje)?></b></p>
                </div>
                <div class="modal-body p-5 pt-0">
                    <form action="../ej1.php">
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