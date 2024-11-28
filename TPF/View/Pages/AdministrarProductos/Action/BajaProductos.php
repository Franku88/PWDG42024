<?php
include_once "../../../../configuracion.php";

$data = Funciones::data_submitted();

$respuesta = (new ABMProducto())->bajaProducto($data);

echo json_encode($respuesta);
?>
