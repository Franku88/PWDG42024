<?php
include_once '../../../../configuracion.php';
$data = Funciones::data_submitted();  // Obtener los datos enviados

// Verificar que todos los campos necesarios están presentes
if (isset($data['idproducto'])) {
    // buscar el producto
    $productos = (new ABMProducto())->buscar(['idproducto' => $data['idproducto']]);
    
    if (!empty($productos)) {
        $producto = $productos[0];
        $param['idproducto'] = $producto->getIdproducto();
        if (isset($data['nombre'])) {
            $param['pronombre'] = $data['nombre'];
        } else {
            $param['pronombre'] = $producto->getPronombre();
        }
        if (isset($data['detalle'])) {
            $param['prodetalle'] = $data['detalle'];
        } else {
            $param['prodetalle'] = $producto->getProdetalle();
        }
        if (isset($data['stock'])) {
            $param['procantstock'] = $data['stock'];
        } else {
            $param['procantstock'] = $producto->getProcantstock();
        }
        if (isset($data['precio'])) {
            $param['proprecio'] = $data['precio'];
        } else {
            $param['proprecio'] = $producto->getProprecio();
        }
        if(isset($data['idvideoyt'])) {
            $param['idvideoyt'] = $data['idvideoyt'];
        } else {
            $param['idvideoyt'] = $producto->getIdvideoyt();
        }
        
        $modificacion = (new ABMProducto())->modificacion($param);
        
        if ($modificacion) {
            echo json_encode(['success' => true, 'message' => 'Producto modificado exitosamente.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al modificar el producto.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Producto no encontrado.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos.']);
}
