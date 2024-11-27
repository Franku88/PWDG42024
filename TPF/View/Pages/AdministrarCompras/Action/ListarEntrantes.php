<?php
include_once '../../../../configuracion.php';

$data = Funciones::data_submitted(); 
$salida = [];
if (!empty($data)) {
    $objCompraEstadoTipo = (new ABMCompraEstadoTipo())->buscar(['idcompraestadotipo' => 2])[0];
    $compras = (new ABMCompraEstado())->buscar([ 'objCompraEstadoTipo' => $objCompraEstadoTipo , 'cefechafin' => 'null']);
    foreach($compras as $compra) {
        $nuevoElem['idcompra'] = $compra->getObjCompra()->getIdcompra();
        $nuevoElem['estado'] = $compra->getObjCompraEstadoTipo()->getCetdescripcion();
        $nuevoElem['fechaInicio'] = $compra->getCefechaini();
        $nuevoElem['fechaFin'] = $compra->getCefechafin();
        $nuevoElem['usuario'] = $compra->getObjCompra()->getObjUsuario()->getUsnombre();
        $nuevoElem['idcompraEstado'] = $compra->getIdcompraestado();
        array_push($salida, $nuevoElem);
    }
} 

echo json_encode($salida);
?>
