<?php
include_once '../../../../configuracion.php';
$data = Funciones::data_submitted();  // Obtener los datos enviados

if (isset($data['accion'], $data['idcompra'])) {
    $compras = (new ABMCompraEstado())->buscar(['idcompra' => $data['idcompra']]);
    
    if (empty($compras)) {
        echo json_encode(['success' => false, 'message' => 'Compra no encontrada.']);
        exit();
    }

    $compra = $compras[0];
    $param['idcompraestado'] = $data['idcompra'];
    $param['idcompra'] = $data['idcompra'];
    $param['idcompraestadotipo'] = $compra->getObjCompraEstadoTipo()->getIdcompraestadotipo();
    $param['cefechaini'] = $compra->getCefechaini();
    $param['cefechafin'] = $compra->getCefechafin();

    switch ($data['accion']) {
        case 'aprobar':
            $param['idcompraestadotipo'] = 2; // Estado: aprobado
            break;
        case 'enviar':
            $param['idcompraestadotipo'] = 3; // Estado: enviado
            $param['cefechafin'] = date('Y-m-d H:i:s'); // Fecha de cierre
            break;
        case 'cancelar':
            $param['idcompraestadotipo'] = 4; // Estado: cancelado
            $param['cefechafin'] = date('Y-m-d H:i:s');
            break;
        default:
            echo json_encode(['success' => false, 'message' => 'Acción no válida.']);
            exit();
    }

    // Realizar la modificación
    $modificacion = (new ABMCompraEstado())->modificacion($param);
    if ($modificacion) {
        echo json_encode(['success' => true, 'message' => 'Acción realizada exitosamente.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'No se pudo realizar la acción.' , 'param' => $param , 'accion' => $data['accion']]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos.']);
}
?>
