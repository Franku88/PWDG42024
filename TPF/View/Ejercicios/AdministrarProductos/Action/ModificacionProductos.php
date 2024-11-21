<?php
include_once '../../../../configuracion.php';

$data = Funciones::data_submitted();  // Obtener los datos enviados
$salida = [];  // Iniciar salida vacía

// Verificar que todos los campos necesarios están presentes
if (isset($data['idproducto'])) {
    // buscar el producto
    $productos = (new ABMProducto())->buscar(['idproducto' => $data['idproducto']]);
    
    if (!empty($productos)) {
        $product = $productos[0];

        $data['idproducto'] = $product->getIdproducto();
        // if ($data['nombre']) {
        //     $param['pronombre'] = $data['nombre'];
        // } else {
        //     $param['pronombre'] = $product->getPronombre();
        // }
        // if ($data['detalle']) {
        //     $param['prodetalle'] = $data['detalle'];
        // } else {
        //     $param['prodetalle'] = $product->getProdetalle();
        // }
        // if ($data['stock']) {
        //     $param['procantstock'] = $data['stock'];
        // } else {
        //     $param['procantstock'] = $product->getProcantstock();
        // }
        // if ($data['precio']) {
        //     $param['proprecio'] = $data['precio'];
        // } else {
        //     $param['proprecio'] = $product->getProprecio();
        // }
        
        $modificacion = (new ABMProducto())->modificacion($param);
        
        if ($modificacion) {
            echo json_encode(['success' => true, 'message' => 'Producto modificado exitosamente.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al modificar el producto.' , 'data' => $data]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Producto no encontrado.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos.']);
}
