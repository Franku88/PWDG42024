<?php 
include_once '../../../../configuracion.php';
$data = Funciones::data_submitted();

$respuesta = (new ABMCompraItem())->quitarCompraItem($data);

echo json_encode($respuesta);
?>