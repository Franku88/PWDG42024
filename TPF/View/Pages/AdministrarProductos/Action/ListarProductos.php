<?php
include_once '../../../../configuracion.php';

$data = Funciones::data_submitted(); 

$respuesta = (new ABMProducto())->listarProductosAdministrar();

echo json_encode($respuesta);
?>
