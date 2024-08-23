<?php
include_once '../Action/actionEJ1.php';
include_once '../../Utils/funciones.php';
include_once '../../Control/controlEJ1.php';

$datos = darDatosSubmitted();

$obj = new Archivo();

//validación si el archivo es de extensión pdf o doc y mayor a 2MB
if ($datos['archivo']["type"] == "application/pdf" || $datos['archivo']["type"] == "application/doc"){
    if ($datos['archivo']["size"] <= 2097152){
        $respuesta = $obj->upload($datos);
    }
} else {
    $respuesta = -1;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ejercicio 1 TP3</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>
    <div>

        <div class="m-2">
            <?php
            if ($respuesta == 0) {
                echo 'ERROR: no se pudo cargar el archivo <br />';
            } elseif ($respuesta == 1) {
                echo "El archivo " . $datos['archivo']["name"] . " se ha copiado con Éxito <br />";
            } elseif ($respuesta == -1) {
                echo "ERROR: no se pudo cargar el archivo. Verifique que su archivo sea de la extensión correcta (*.doc o *.pdf) y no exceda el tamaño máximo permitido (2 MB). <br />";
            }
            ?>
        </div>
        <div>
            <?php
            if ($respuesta == 1) {
                echo '<div class="btn-group-vertical m-2" role="group" aria-label="">
                <a name="volver" id="volver" class="btn btn-primary" href="' . '../../Modelo/archivos/' . $datos['archivo']['name'] . '" role="button">Descargue su archivo <span>' . $datos['archivo']["name"] . '</span> subido</a>
            </div>';
            }
            ?>
        </div>
        <div class="btn-group-vertical m-2" role="group" aria-label="">
            <a name="volver" id="volver" class="btn btn-primary" href="../EJ1.php" role="button">Regresar</a>
        </div>
    </div>
</body>

</html>