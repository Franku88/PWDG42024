<?php
include_once '../../../../configuracion.php';
$data = Funciones::data_submitted(); 

$respuesta = (new ABMCompra())->cambiarEstado($data); // $data = ['idcompraestado', 'idnuevoestadotipo']

echo json_encode($respuesta);
?>