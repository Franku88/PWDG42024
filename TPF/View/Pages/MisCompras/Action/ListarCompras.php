<?php
include_once '../../../../configuracion.php';
$data = Funciones::data_submitted();

print_r($data);


// $salida = (new ABMCompra())->listarMisCompras($data);
// echo json_encode($salida);


?>

<!-- $comp = [
                'idcompra' => $compra->getIdcompra(),
                'cofecha' => $compra->getCofecha(),
                'items' => $items,
                'estado' => $compraEstados->getObjCompraEstadoTipo()->getCetdescripcion()
]; -->
