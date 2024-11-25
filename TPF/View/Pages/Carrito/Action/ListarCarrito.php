<?php
include_once '../../../../configuracion.php';

$data = Funciones::data_submitted(); 
$salida = [];
if (!empty($data)) {
    $compraEstado = (new ABMCompraEstado())->buscar($data)[0];
    $compraItems = (new ABMCompraItem())->buscar(['compra'=> $compraEstado->getObjCompra()]);

    foreach($compraItems as $compraItem) {
        $producto = $compraItem->getObjProducto();
        //$objCompra = $compraItem->getObjCompra(); // No se usa, pero puede ser obtenido
        $nuevoElem['idcompraitem'] = $compraItem->getIdcompraitem();
        $nuevoElem['cicantidad'] = $compraItem->getCicantidad();
        $nuevoElem['icon'] = BASE_URL."/View/Media/Product/".$producto->getIdproducto()."/icon.png";
        $nuevoElem['idproducto'] = $producto->getIdproducto();
        $nuevoElem['pronombre'] = $producto->getPronombre();
        $nuevoElem['prodetalle'] = $producto->getProdetalle();
        $nuevoElem['procantstock'] = $producto->getProcantstock();
        $nuevoElem['proprecio'] = $producto->getProprecio();
        $nuevoElem['prodeshabilitado'] = $producto->getProdeshabilitado();
        $nuevoElem['idvideoyt'] = $producto->getIdvideoyt();
        array_push($salida, $nuevoElem);
    }
} 
echo json_encode($salida);
?>