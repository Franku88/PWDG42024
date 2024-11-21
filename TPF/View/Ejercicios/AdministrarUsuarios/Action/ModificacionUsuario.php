<?php
include_once "../../../../configuracion.php";

$data = Funciones::data_submitted();

if (isset($data['accion']) && $data['accion'] === 'modifica' && isset($data['idusuario']) && isset($data['rol'])) {
    $idUsuario = $data['idusuario'];
    $rolDescripcion = $data['rol'];

    // Crear instancias de  ABMUsuarioRol
    $abmUsuarioRol = new ABMUsuarioRol();
    $abmRol = new ABMRol();


}
?>
