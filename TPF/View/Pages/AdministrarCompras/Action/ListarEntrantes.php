<?php
include_once '../../../../configuracion.php';

$data = Funciones::data_submitted();

$salida = (new ABMCompraEstadoTipo())->listarEntrantes();

echo json_encode($salida);
?>
