<?php 
include_once '../../../../configuracion.php';
$data = Funciones::data_submitted();
$respuesta = false;

$idproducto = $data['idproducto'];
$idcompra = $data['idcompra'];
$cicantidad = $data['cicantidad']; // 1

$producto = (new ABMProducto)->buscar(['idproducto' => $idproducto])[0];
$compra = (new ABMCompra)->buscar(['idcompra' => $idcompra])[0];

// 1. Verificamos que compraItem con el $idcompra tenga el producto cargado
// 1.2 Seria verificar que el arrito posee previamente el producto 
$compraItems = (new ABMCompraItem())->buscar(['producto'=> $producto, 'compra' => $compra]);

if(empty($compraItems)) {  //Si dicho producto no esta en el carro, agrega CompraItem
    $respuesta = (new ABMCompraItem)->alta(['producto'=> $producto, 'compra' => $compra, 'cicantidad' => $cicantidad]);
} else { //Si dicho producto ya esta en el carro, modifica CompraItem
    // modificamos CompraItem, recuperando su valor actual += 1
    $compraItem = $compraItems[0];
    $respuesta = (new ABMCompraItem)->modificacion(['idcompraitem' => $compraItem->getIdcompraitem(), 'producto'=> $producto, 'compra' => $compra, 'cicantidad' => ($compraItems[0]->getCicantidad() + $cicantidad)]);
}

echo json_encode(['success'=> $respuesta]);
?>