<?php
include_once '../../../../configuracion.php';
$data = Funciones::data_submitted();

$salida = [];
if (!empty($data)) {
    $usuario = (new ABMUsuario())->buscar(['idusuario' => $data['usuarioid']])[0];
    // 1. Buscamos las compras del usuario
    $compras = (new ABMCompra())->buscar(['usuario' => $usuario]);

    // Si no hay compras, devolvemos un mensaje adecuado
    if (empty($compras)) {
        $salida = ['mensaje' => 'No hay compras disponibles'];
    } else {
        // 2. Iteramos sobre las compras y generamos la respuesta
        foreach ($compras as $compra) {
            $compraItems = (new ABMCompraItem())->buscar(['compra' => $compra]);
            foreach ($compraItems as $compraItem) {
                $producto = (new ABMProducto())->buscar(['idproducto' => $compraItem->getObjProducto()])[0];
                $compraEstado = (new ABMCompraEstado())->buscar(['compra' => $compra])[0];
                
                $salida[] = [
                    'producto' => $producto->getPronombre(),
                    'fecha' => $compra->getCofecha(),
                    'cantidad' => $compraItem->getCicantidad(),
                    'estado' => $compraEstado->getObjCompraEstadoTipo()->getCetdescripcion()
                ];
            }
        }
    }
}

header('Content-Type: application/json');
echo json_encode($salida);

?>
