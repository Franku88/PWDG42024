<?php
include_once '../../../../configuracion.php';
$data = Funciones::data_submitted();  // Obtener los datos enviados

// actualiza el usdesabilitado del producto a la fecha actual

if (isset($data['idproducto'])) {
    // buscar el producto
    $productos = (new ABMProducto())->buscar(['idproducto' => $data['idproducto']]);

    if (!empty($productos)) {
        $producto = $productos[0];
        $param['idproducto'] = $producto->getIdproducto();
        $param['pronombre'] = $producto->getPronombre();
        $param['prodetalle'] = $producto->getProdetalle();
        $param['procantstock'] = $producto->getProcantstock();
        $param['proprecio'] = $producto->getProprecio();
        $param['prodeshabilitado'] = null;


        $modificacion = (new ABMProducto())->modificacion($param);

        if ($modificacion) {
            echo json_encode(['success' => true, 'message' => 'Producto habilitado exitosamente.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al deshabilitar el producto.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Producto no encontrado.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos.']);
}
