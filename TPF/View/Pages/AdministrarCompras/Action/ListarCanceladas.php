<?php
include_once '../../../../configuracion.php';

$data = Funciones::data_submitted();

$salida = (new ABMCompraEstadoTipo())->listarCanceladas();

echo json_encode($salida);
