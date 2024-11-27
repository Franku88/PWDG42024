<?php
include_once '../../../../configuracion.php';

$data = Funciones::data_submitted(); 

$abmCompra = new ABMCompra();
if ($data['accion'] == 'enviar') {
    $respuesta = $abmCompra->cambiarEstado(['idcompraestado'=>$data['idcompraestado'], 'idnuevoestadotipo' => 3]); // si el deposito le da a enviar
} else {
    $respuesta = $abmCompra->cambiarEstado(['idcompraestado'=>$data['idcompraestado'], 'idnuevoestadotipo' => 4]); // si el deposito le da a cancelar
}
echo json_encode($respuesta);



?>
