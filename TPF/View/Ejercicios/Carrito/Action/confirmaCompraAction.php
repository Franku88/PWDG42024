<?php
include_once '../../../../configuracion.php';

$data = Funciones::data_submitted();
$salida = false;

if (!empty($data['idusuario'])) {
    $idUsuario = $data['idusuario'];
    $param = [];
    $abmUsuario = new ABMUsuario();
    $usuario = $abmUsuario->buscar(['idusuario' => $idUsuario]);
    $usuarioObj = $usuario[0];
    $datetime = new DateTime('now');
    $datetime->setTime(0, 0, 0); 
    $param['cofecha'] = $datetime->format('Y-m-d H:i:s');
    $param['usuario'] = $usuarioObj;

    $compra = (new ABMCompra())->alta($param);
    if ($compra) {
        $salida = true;
    }
}

echo json_encode($salida);
