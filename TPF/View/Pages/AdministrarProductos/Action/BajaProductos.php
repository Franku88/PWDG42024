<?php
include_once "../../../../configuracion.php";

$data = Funciones::data_submitted();

if (isset($data['idproducto'])) {
    $idproducto = $data['idproducto'];
    $abmProducto = new ABMProducto();
    $baja = $abmProducto->baja(['idproducto' => $idproducto]);
    if ($baja) {
        echo json_encode(['success' => true, 'message' => 'Producto dado de baja correctamente.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al dar de baja el producto.']);
    }

}
?>
