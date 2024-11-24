<?php
include_once "../../../../configuracion.php";

$data = Funciones::data_submitted();

if (isset($data['idusuario']) && isset($data['rol'])) {
    $idUsuario = $data['idusuario'];
    $rolDescripcion = $data['rol'];

    // Crear instancias de ABMUsuario y ABMUsuarioRol
    $abmUsuario = new ABMUsuario();
    $abmUsuarioRol = new ABMUsuarioRol();
    $abmRol = new ABMRol();

    // Buscar el usuario a dar de baja
    $usuario = $abmUsuario->buscar(['idusuario' => $idUsuario]); // recuperamos el array con el obj
    $usuarioObj = $usuario[0]; // Obtener el objeto usuario

    // Buscar el rol correspondiente
    $rol = $abmRol->buscar(['rodescripcion' => $rolDescripcion]); // recuperamos el array con el obj
    $rolObj = $rol[0]; // Obtener el objeto rol

    // Intentar dar de baja el rol y el usuario
    $bajaUsuarioRol = $abmUsuarioRol->baja(['usuario' => $usuarioObj, 'rol' => $rolObj]); // pasamos el obj
    $bajaUsuario = $abmUsuario->baja(['idusuario' => $idUsuario]); // pasamos el id

    // Verificar si las bajas fueron exitosas
    if ($bajaUsuarioRol && $bajaUsuario) {
        echo json_encode(['success' => true, 'message' => 'Usuario dado de baja correctamente.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al dar de baja el usuario.']);
    }
}
?>
