<?php
include_once '../../../../configuracion.php';
$data = Funciones::data_submitted(); 

$respuesta = (new ABMProducto())->listarProductos();

echo json_encode($respuesta);
?>