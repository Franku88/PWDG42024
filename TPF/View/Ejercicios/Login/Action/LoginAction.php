<?php
include_once '../../../../configuracion.php';

$data = Funciones::data_submitted(); 
$respuesta = false;

if (!empty($data)) {
    $respuesta = (new Session())->iniciar($data['user'], $data['password']);
} 

echo json_encode($respuesta);
?>