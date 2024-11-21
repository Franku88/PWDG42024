<?php 
include_once '../../../../configuracion.php';
$data = Funciones::data_submitted();
$respuesta = false;
if (isset($data['idproducto'])){
        $objProducto = new ABMProducto();
        $respuesta = $objProducto->buscar($data);
        if (!$respuesta){
            $mensaje = "Producto inválido";           
        }
}
$retorno['respuesta'] = $respuesta;
if (isset($mensaje)){    
    $retorno['errorMsg']=$mensaje;    
}
 echo json_encode($retorno);
?>