<?php
function darDatosSubmitted()
{
    $datos = [];
    //piso el array de datos con los datos que vienen por POST para darles prioridad
    
    if (!empty($_FILES)) {
         foreach ($_FILES as $key => $value) {
             $datos[$key] = $value;
         }
         //Array ( [archivo] => Array ( [name] => file.pdf [full_path] => file.pdf [type] => application/pdf [tmp_name] => E:\XAMPP\xampp\tmp\php6D04.tmp [error] => 0 [size] => 476966 ) )
         
         //Array ( [archivo] => Array ( [name] => Hola.txt [full_path] => Hola.txt [type] => text/plain [tmp_name] => E:\XAMPP\xampp\tmp\php8D16.tmp [error] => 0 [size] => 6 ) )
    }

    if (empty($_FILES)) {
        foreach ($_GET as $key => $value) {
            $datos[$key] = $value;
        }
        foreach ($_POST as $key => $value) {
            $datos[$key] = $value;
        }
    }

    return $datos;
}
