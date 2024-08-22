<?php
include_once "archivo.php";
class controller {
    public function mostrarDatos($info) {
        $datosPelicula = [];
        $archivoClass = new archivo();
        
        // Cambiar a la clave correcta 'imagen'
        $errorImagen = $archivoClass->guardarImagen($_FILES['imagen']);

        $titulo = $info['titulo'] ?? '';
        $actores = $info['actores'] ?? '';
        $director = $info['director'] ?? '';
        $guion = $info['guion'] ?? '';
        $produccion = $info['produccion'] ?? '';
        $anio = $info['anio'] ?? '';
        $nacionalidad = $info['nacionalidad'] ?? '';
        $genero = $info['genero'] ?? '';
        $duracion = $info['duracion'] ?? '';
        $restricciones = $info['restricciones'] ?? '';
        $sinopsis = $info['sinopsis'] ?? '';
        $imagen = $_FILES['imagen']['name'] ?? '';

        if (!empty($info)) {
            $datosPelicula = [
                'titulo' => $titulo,
                'actores' => $actores,
                'director' => $director,
                'guion' => $guion,
                'produccion' => $produccion,
                'anio' => intval($anio),
                'nacionalidad' => $nacionalidad,
                'genero' => $genero,
                'duracion' => intval($duracion),
                'restricciones' => $restricciones,
                'sinopsis' => $sinopsis,
                'imagen' => $archivoClass->getDir() . $imagen, // Corregido el acceso al archivo
                'errorImagen' => $errorImagen
            ];
        }
        
        return $datosPelicula;
    }
}

    



