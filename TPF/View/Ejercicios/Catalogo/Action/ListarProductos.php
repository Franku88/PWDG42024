<?php
include_once '../../../../configuracion.php';

$data = Funciones::data_submitted(); 
$salida = [];
if (!empty($data)) {
    $productos = (new ABMProducto())->buscar();
    foreach($productos as $producto) {
        if ($producto->getProdeshabilitado() == null) {
            $nuevoElem['icon'] = "../../Media/Product/".$producto->getIdproducto()."/icon.png";
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
} 
echo json_encode($salida);
?>