<?php
include_once '../../../../configuracion.php';

$data = Funciones::data_submitted(); 
$salida = [];
if (!empty($data)) {
    $productos = (new ABMProducto())->buscar();
    foreach($productos as $producto) {
        $nuevoElem['idproducto'] = $producto->getIdproducto();
        $nuevoElem['pronombre'] = $producto->getPronombre();
        $nuevoElem['prodetalle'] = $producto->getProdetalle();
        $nuevoElem['procantstock'] = $producto->getProcantstock();
        $nuevoElem['proprecio'] = $producto->getProprecio();
        $nuevoElem['prodeshabilitado'] = $producto->getProdeshabilitado();
        array_push($salida, $nuevoElem);
    }
} 

echo json_encode($salida);
?>
