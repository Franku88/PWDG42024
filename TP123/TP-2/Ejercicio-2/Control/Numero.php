<?php
class Numero 
{
    public function verSigno($datos) {
        $numero = $datos["numero"];
        $res = "invalido";
        if ($numero != null) {
            switch(true) {
                case ($numero == 0):
                    $res="cero";
                    break;
                case ($numero > 0):
                    $res="positivo";
                    break;
                case ($numero < 0):
                    $res="negativo";
                    break;
            }
        }
        return $res;
    }
}
?>