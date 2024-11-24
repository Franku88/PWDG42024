<?php
include_once '../../../../configuracion.php';
$roles = (new ABMRol())->buscar(['idrol' => 3]); // Devuelve el objRol de Cliente
$abmUsuario = new ABMUsuario();
$data = Funciones::data_submitted();

if (isset($data['user']) && isset($data['password']) && isset($data['email'])) {
    $param['usnombre'] = $data['user'];
    $param['usmail'] = $data['email'];

    $resultadoUsuario = $abmUsuario->buscar(['usnombre' => $data['user']]);
    if (count($resultadoUsuario) > 0) {
        echo 'Este nombre usuario ya se encuentra en uso';
        exit; 
    }

    $resultadoEmail = $abmUsuario->buscar(['usmail' => $data['email']]);
    if (count($resultadoEmail) > 0) {
        echo 'Este email ya se encuentra en uso';
        exit; 
    }

    $param['uspass'] = $data['password'];

    if ($abmUsuario->alta($param)) { //Intenta dar de alta el usuario
        $usuario = $abmUsuario->buscar(['usnombre' => $data['user']])[0]; //Obtiene usuario dado de alta para darle rol
        if ((new ABMUsuarioRol())->alta(['usuario' => $usuario, 'rol' => $roles[0]])) { //Intenta asignar rol
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
?>