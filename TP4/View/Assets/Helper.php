<?php
class Helper {
    
    /**
     * Ingresa un array de arrays (No de objetos, Persona y Auto deben estar como arrays)
     * @param array $array
     */
    public static function arrayToHtmlTable($array) {
        // Verifica si el array está vacío
        $tablaHtml = "El array está vacio, no es posible generar tabla";

        if (!empty($array)) {
            // Inicializa la variable para almacenar el HTML de la tabla
            $tablaHtml = '<table class="table table-striped table-hover table-bordered shadow table-rounded">';
            
            // Agrega la fila de encabezado (utiliza las claves del primer elemento del array)
            $tablaHtml .= '<thead><tr>';
            foreach (array_keys($array[0]) as $header) {
                $tablaHtml .= '<th>' . htmlspecialchars($header) . '</th>';
            }
            $tablaHtml .= '</tr></thead>';
            
            // Agrega las filas del cuerpo de la tabla
            $tablaHtml .= '<tbody>';
            foreach ($array as $row) { //Por cada objeto en array de objetos
                $tablaHtml .= '<tr>';
                foreach ($row as $cell) { //Convierto cada posicion del array
                    $tablaHtml .= '<td>' . htmlspecialchars($cell) . '</td>';
                }
                $tablaHtml .= '</tr>';
            }
            $tablaHtml .= '</tbody>';
            // Cierra la tabla
            $tablaHtml .= '</table>';
        }
        
        return $tablaHtml;
    }
}
