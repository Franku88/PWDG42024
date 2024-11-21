<?php
include_once "../../../../configuracion.php";

$data = Funciones::data_submitted(); 
$salida = [];

// Obtener los usuarios con su rol
$rolUsuario = (new ABMUsuarioRol())->buscar($data);

if (!empty($rolUsuario)) {
    foreach ($rolUsuario as $usuario) {
        // Obtener los detalles del usuario y su rol
        $nuevoElem['idusuario'] = $usuario->getObjUsuario()->getIdusuario();
        $nuevoElem['usnombre'] = $usuario->getObjUsuario()->getUsnombre();
        $nuevoElem['usmail'] = $usuario->getObjUsuario()->getUsmail();
        
        $desa =  ($usuario->getObjUsuario())->getUsdeshabilitado(); // NULL = Habilitado, fecha = Deshabilitado

        if ($desa == NULL) {
            $nuevoElem['usdeshabilitado'] = 'Habilitado';
        } else {
            $nuevoElem['usdeshabilitado'] = 'Deshabilitado';
        }


        $nuevoElem['rol'] = $usuario->getObjRol()->getRodescripcion(); 
        array_push($salida, $nuevoElem);
    }
}

// Retornar los resultados en formato JSON
echo json_encode($salida);
?>
