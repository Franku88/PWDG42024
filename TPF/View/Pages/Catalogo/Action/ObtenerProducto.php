<?php
include_once '../../../../configuracion.php';
$data = Funciones::data_submitted();

$respuesta = (new ABMProducto())->listarProductos($data); //Obtiene array unitario con producto idproducto en $data

echo json_encode($respuesta);
?>