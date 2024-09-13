<?php

class controller {
    public function mostrarDatos($info) {
        $datosPelicula = [];
        // Verificar si los campos están definidos en el array $info
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


        // Solo procesar si hay datos
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
                'sinopsis' => $sinopsis
            ];
          
        }
        
        return $datosPelicula;
    }
}
