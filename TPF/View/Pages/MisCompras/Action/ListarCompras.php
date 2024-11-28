<?php
include_once '../../../../configuracion.php';
$data = Funciones::data_submitted();

$resultado = (new ABMCompra())->listarMisCompras($data);

echo json_encode($resultado);
?>