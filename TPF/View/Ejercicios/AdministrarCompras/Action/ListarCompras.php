<?php
include_once '../../../../configuracion.php';

$data = Funciones::data_submitted(); 
$salida = [];
if (!empty($data)) {
    $compras = (new ABMCompraEstado())->buscar();
    foreach($compras as $compra) {
        $nuevoElem['idcompra'] = $compra->getObjCompra()->getIdcompra();
        $nuevoElem['estado'] = $compra->getObjCompraEstadoTipo()->getCetdescripcion();
        $nuevoElem['fechaInicio'] = $compra->getCefechaini();
        $nuevoElem['fechaFin'] = $compra->getCefechafin();
        $nuevoElem['usuario'] = $compra->getObjCompra()->getObjUsuario()->getUsnombre();
        array_push($salida, $nuevoElem);
    }
} 

echo json_encode($salida);
?>
