<?php
class Funciones
{

    /**
     * Funcion para obtener info de formularios de manera transparente (No discrimina el metodo utilizado)
     * @return array
     */
    public static function data_submitted()
    {
        $data = array();

        if (!empty($_POST)) { //Chequea que metodo se utilizo
            foreach ($_POST as $key => $value) { //Lo copia para no referenciar a $_POST
                $data[$key] = $value;
            }
        } else if (!empty($_GET)) {
            foreach ($_GET as $key => $value) { //Lo copia para no referenciar a $_GET
                $data[$key] = $value;
            }
        }

        if (!empty($_FILES)) {
            foreach ($_FILES as $key => $value) { //Lo copia para no referenciar a $_FILES
                $data[$key] = $value;
            }
        }

        if (!empty($data)) {
            foreach ($data as $indice => $valor) {
                if ($valor == "") { //Reemplaza cada cadena vacia a null
                    $data[$indice] = "null";
                }
            }
        }
        return $data;
    }
}
