<?php
include_once '../../../configuracion.php';
$abmUsuario = new ABMUsuario();
$abmUsuarioRol = new ABMUsuarioRol();
$abmRol = new ABMRol();
$rol = $abmRol->buscar(['idrol' => 1]); // Devuelve el objRol de Cliente

$data = Funciones::data_submitted();

if (isset($data['user']) && isset($data['password']) && isset($data['email'])) {
    $param['usnombre'] = $data['user'];
    $param['usmail'] = $data['email'];

    $resultadoUsuario = $abmUsuario->buscar(['usnombre' => $data['user']]);
    if (count($resultadoUsuario) > 0) {
        echo 'Este usuario ya se encuentra en uso';
        exit; 
    }
    $resultadoEmail = $abmUsuario->buscar(['usmail' => $data['email']]);
    if (count($resultadoEmail) > 0) {
        echo 'Este email ya se encuentra en uso';
        exit; 
    }
    $param['uspass'] = $data['password'];

    $alta = $abmUsuario->alta($param);
    if ($alta) {
        $usuario = $abmUsuario->buscar(['usnombre' => $data['user']])[0];
        $altaUsuarioRol = $abmUsuarioRol->alta(['usuario' => $usuario, 'rol' => $rol[0]]);
        if ($altaUsuarioRol) {
            echo 'success';
        } else {
            echo 'Error en la asignación del rol al usuario';
        }
    } else {
        echo 'Error al registrar el usuario';
    }
} else {
    echo 'Datos incompletos';
}

