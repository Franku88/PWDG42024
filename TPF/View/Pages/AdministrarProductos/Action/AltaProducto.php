<?php
include_once "../../../../configuracion.php";

$data = Funciones::data_submitted();

$respuesta = (new ABMProducto())->altaProducto($data);

echo json_encode($respuesta);
?>
