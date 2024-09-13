<?php
class archivo {
    private $dir;

    public function __construct() {
        $this->dir = "../imagesPelis/";
    }

    public function getDir() {
        return $this->dir;
    }

    public function guardarImagen($arrayFiles) {
        $error = null;
        $nombreArchivo = basename($arrayFiles["name"]); // Cambiar a 'name'
        $rutaDestino = $this->getDir() . $nombreArchivo;
        $tipoArchivo = strtolower(pathinfo($rutaDestino, PATHINFO_EXTENSION));

        // Validar tipo de archivo
        if ($tipoArchivo != "jpg" && $tipoArchivo != "jpeg" && $tipoArchivo != "png" && $tipoArchivo != "gif") {
            $error = 1; // El archivo no es una imagen
        }
        else {
            // Intentar mover el archivo subido a su destino final
            if (move_uploaded_file($arrayFiles["tmp_name"], $rutaDestino)) {
                $error = 0; // El archivo se cargó correctamente
            } else {
                $error = -1; // El archivo no se cargó
            }
        }

        return $error;
    }
}

?>