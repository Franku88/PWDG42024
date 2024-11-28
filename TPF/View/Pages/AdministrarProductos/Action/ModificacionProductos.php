<?php
include_once '../../../../configuracion.php';
$data = Funciones::data_submitted();  // Obtener los datos enviados

$respuesta = (new ABMProducto())->modificarProductos($data);

echo json_encode($respuesta);
?>
