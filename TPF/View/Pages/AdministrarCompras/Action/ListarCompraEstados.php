<?php
include_once '../../../../configuracion.php';
$data = Funciones::data_submitted();

$salida = (new ABMCompraEstado())->listarCompraEstados($data); //['idcompraestadotipo']

echo json_encode($salida);
?>