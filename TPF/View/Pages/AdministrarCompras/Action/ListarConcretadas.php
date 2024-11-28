<?php
include_once '../../../../configuracion.php';

$data = Funciones::data_submitted();

$salida = (new ABMCompraEstadoTipo())->listarConcretadas();

echo json_encode($salida);
?>
