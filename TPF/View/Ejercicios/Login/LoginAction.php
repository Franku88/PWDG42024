<?php
include_once '../../../configuracion.php';

$abmUsuarios = new ABMUsuario();
$session = new Session();
$data = Funciones::data_submitted(); 

if (isset($data['user']) && isset($data['password'])) {
    $param['usnombre'] = $data['user'];
    $param['uspass'] = $data['password'];
    $resultado = $abmUsuarios->buscar($param);
    if (count($resultado) > 0) {
        $usuario = $resultado[0];
        $session->iniciar($usuario->getUsnombre(), $usuario->getUspass());
        echo 'success';
    } else {
        echo 'Usuario o contraseña incorrectos'; 
    }
} 
