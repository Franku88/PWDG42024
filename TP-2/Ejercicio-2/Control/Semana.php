<?php

class Semana {
    public function horasTotal($horasSemana) {
        $total = 0;
        foreach($horasSemana as $hora) {
            $total = $total + ((double) $hora);
        }
        return $total;
    }
}

?>