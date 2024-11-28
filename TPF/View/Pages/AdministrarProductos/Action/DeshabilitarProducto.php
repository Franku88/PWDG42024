<?php
include_once '../../../../configuracion.php';
$data = Funciones::data_submitted();  // Obtener los datos enviados

$respuesta = (new ABMProducto())->deshabilitarProducto($data);

echo json_encode($respuesta);

?>