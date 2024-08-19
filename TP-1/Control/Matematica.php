<?php

class Matematica {

    /**
     * @param array[] $datos
     */
    public function operar($datos) {
        $result = 0;
        switch($datos["operacion"]) {
            case "+":
                $result = (double)($datos["num1"])+(double)($datos["num2"]);
                break;
            case "-":
                $result = (double)($datos["num1"])-(double)($datos["num2"]);
                break;
            case "*":
                $result = (double)($datos["num1"])*(double)($datos["num2"]);
                break;
        }
        return $result;
    }

}


?>