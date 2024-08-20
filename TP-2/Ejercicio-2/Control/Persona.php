<?php

class Persona {
    private $nombre;
    private $apellido;
    private $edad;
    private $direccion;
    private $estudios;
    private $sexo;
    private $deportes;

    public function __construct($nom, $ape, $ed, $dir, $est = null, $se = null, $dep = []) {
        $this->nombre = $nom;
        $this->apellido = $ape;
        $this->edad = $ed;
        $this->direccion = $dir;
        $this->estudios = $est;
        $this->sexo = $se;
        $this->deportes = $dep;
    }

    public function getNombre() {
        return $this->nombre;
    }
    
    public function getApellido() {
        return $this->apellido;
    }

    public function getEdad() {
        return $this->edad;
    }

    public function getDireccion() {
        return $this->direccion;
    }

    public function getEstudios() {
        return $this->estudios;
    }

    public function getSexo() {
        return $this->sexo;
    }

    public function getDeportes() {
        return $this->deportes;
    }

    public function presentarse() {
        return ("Hola, yo soy ".$this->getNombre().", "
        .$this->getApellido()." tengo ".$this->getEdad()." años y vivo en "
        .$this->getDireccion().".");
    }

    public function presentarseEdad() {
        $mensaje = "Hola, yo soy ".$this->getNombre().", "
        .$this->getApellido()." tengo ".$this->getEdad()." años, vivo en "
        .$this->getDireccion()." y ";
        if ($this->getEdad() >= 18) {
            $mensaje = $mensaje. "soy mayor de edad.";
        } else {
            $mensaje = $mensaje. "soy menor de edad.";
        }
        return $mensaje;
    }

    public function presentarseEES() {
        $mensaje = "Hola, yo soy ".$this->getNombre().", "
        .$this->getApellido()." tengo ".$this->getEdad()." años, vivo en "
        .$this->getDireccion();
        if ($this->getEdad() >= 18) {
            $mensaje = $mensaje. " y soy mayor de edad. \n";
        } else {
            $mensaje = $mensaje. " y soy menor de edad. \n";
        }
        $mensaje = $mensaje."Sexo: ".$this->getSexo().".\n";
        $mensaje = $mensaje. "Estudios alcanzados: ".$this->getEstudios().".\n";
        return $mensaje;
    }

    public function presentarseEESD() {
        $mensaje = "Hola, yo soy ".$this->getNombre().", "
        .$this->getApellido()." tengo ".$this->getEdad()." años, vivo en "
        .$this->getDireccion();
        if ($this->getEdad() >= 18) {
            $mensaje = $mensaje. " y soy mayor de edad. \n";
        } else {
            $mensaje = $mensaje. " y soy menor de edad. \n";
        }
        $mensaje = $mensaje."Sexo: ".$this->getSexo().".\n";
        $mensaje = $mensaje. "Estudios alcanzados: ".$this->getEstudios().".\n";
        $mensaje = $mensaje. "Deportes que practico: \n";
        if ($this->getDeportes() != []) {
            foreach($this->getDeportes() as $deporte) {
                $mensaje = $mensaje.$deporte.", ";
            }
            $mensaje = substr($mensaje, 0, -2);
            $mensaje = $mensaje. ".\n";
        } else {
            $mensaje = $mensaje."ninguno.";
        }        
        return $mensaje;
        return $mensaje;
    }

}


?>