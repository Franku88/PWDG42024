<?php
include_once '../../../../configuracion.php';

$data = Funciones::data_submitted();
$salida = false;
if (!empty($data)) {
    $param = [];
    $datetime = new DateTime('now');
    $datetime->setTime(0, 0, 0); // Hora: 00:11:12
    $param['cofecha'] = $datetime->format('Y-m-d H:i:s');
    $param['usuario'] = $data;
    $productos = (new ABMCompra())->alta($param);
    if ($productos) {
        $salida = true;
    }
}

echo json_encode($salida);
