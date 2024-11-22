<?php
include_once '../../../../configuracion.php';

$data = Funciones::data_submitted();
$salida = false;
if (!empty($data)) {
    var_dump($data);
    $param = [];
    $abmUsuario = new ABMUsuario();
    $usuarios = $abmUsuario->buscar(['idusuario' => intval($data['idusuario'])]);

    $datetime = new DateTime('now');
    $datetime->setTime(0, 0, 0); 
    $param['cofecha'] = $datetime->format('Y-m-d H:i:s');
    $param['usuario'] = $usuarios;

    $compra = (new ABMCompra())->alta($param);
    if ($compra) {
        $salida = true;
    }
}

echo json_encode($salida);
