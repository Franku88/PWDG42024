<?php 
//Implementar funcion para obtener info de formularios
function data_submitted() 
{
	$data = array();
    if (!empty($_POST)) { //Chequea que metodo se utilizo
    	$data = $_POST;
    } else {
		if(!empty($_GET)) { 
            $data = $_GET;
		}
    }
	if (!empty($data)) {
		foreach ($data as $indice => $valor) {
			if ($valor == "") {
				$data[$indice] = null;
			}
		}
	}
	return $data;
}
?>