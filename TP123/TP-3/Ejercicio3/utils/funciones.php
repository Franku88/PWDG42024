<?php
function darDatosSubmitted() {
    $datos = [];

    // Obtener datos de POST
    foreach ($_POST as $key => $value) {
        $datos[$key] = $value;
    }

    // Incluir archivos recibidos en $_FILES, si los hay
    if (!empty($_FILES)) {
        foreach ($_FILES as $key => $value) {
            $datos[$key] = $value;
        }
    }

    return $datos;
}
