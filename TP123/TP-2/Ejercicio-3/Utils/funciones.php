<?php 


// funcion que recibe los datos enviados por el formulario
// y los devuelve en un array asociativo -> ['nombre' => 'valor'] 
function datosSubmitted(){
    $datos =  [];

    foreach ($_GET as $key => $value) {
        $datos[$key] = $value;
    }

    foreach ($_POST as $key => $value) {
        $datos[$key] = $value;
    }
    return $datos;
    
} 
