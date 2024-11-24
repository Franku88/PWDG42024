<?php
include_once "../../../../configuracion.php";

$data = Funciones::data_submitted();

if (isset($data['nombre']) && isset($data['stock']) && isset($data['detalle']) && isset($data['precio'])) {
    $param['pronombre'] = $data['nombre'];
    $param['prodetalle'] = $data['detalle'];
    $param['procantstock'] = $data['stock'];
    $param['proprecio'] = $data['precio'];

    if(isset($data['idvideoyt'])) {
        if ($data['idvideoyt'] != "null") {
            $param['idvideoyt'] = $data['idvideoyt'];
        } else {
            $param['idvideoyt'] = "dQw4w9WgXcQ";
        }
    } else {
        $param['idvideoyt'] = 'dQw4w9WgXcQ';
    }

    if ((new ABMProducto())->alta($param)) {
        echo json_encode(['success' => true, 'message' => 'Producto agregado exitosamente.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al agregar el producto.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos.']);
}
?>
