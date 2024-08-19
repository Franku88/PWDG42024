<?php

class Cine {

    /**
     * @param int $edad
     * @param int $estudia (0 o 1)
     */
    public function calcularPrecio($edad, $estudia) {
        $result = 0;
        if ($edad < 12) {
            $result = 160;
        } else {
            if ($estudia) {
                $result = 180;
            } else {
                $result = 300;
            }
        }
        return $result;
    }
}


?>