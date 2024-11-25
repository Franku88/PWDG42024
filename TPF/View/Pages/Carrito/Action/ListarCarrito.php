<?php 
include_once '../../../../configuracion.php';
$data = Funciones::data_submitted();
$respuesta = false;


echo json_encode(['success'=> $respuesta]);
?>