<?php 
include_once 'BaseDatos.php';

class CompraEstadoTipo {
    private $idcompraestadotipo;
    private $cetdescripcion;
    private $cetdetalle;
    private $mensajeOperacion;
    
    public function __construct($idcompraestadotipo = null, $cetdescripcion = null, $cetdetalle = null) {
        $this->idcompraestadotipo = $idcompraestadotipo;
        $this->cetdescripcion = $cetdescripcion;
        $this->cetdetalle = $cetdetalle;
    }

    // getters
    public function getIdcompraestadotipo() {
        return $this->idcompraestadotipo;
    }

    public function getCetdescripcion() {
        return $this->cetdescripcion;
    }

    public function getCetdetalle() {
        return $this->cetdetalle;
    }

    public function getMensajeOperacion() {
        return $this->mensajeOperacion;
    }

    // setters
    public function setIdcompraestadotipo($idcompraestadotipo) {
        $this->idcompraestadotipo = $idcompraestadotipo;
    }

    public function setCetdescripcion($cetdescripcion) {
        $this->cetdescripcion = $cetdescripcion;
    }

    public function setCetdetalle($cetdetalle) {
        $this->cetdetalle = $cetdetalle;
    }

    public function setMensajeOperacion($mensajeOperacion){
        $this->mensajeOperacion = $mensajeOperacion;
    }
    
    // metodos CRUD
    public function cargarDatos($idcompraestadotipo = null, $cetdescripcion = null, $cetdetalle = null) {
        $this->setIdcompraestadotipo($idcompraestadotipo);
        $this->setCetdescripcion($cetdescripcion);
        $this->setCetdetalle($cetdetalle);
    }

    /**
     * Buscar datos de un compraestadotipo por su id
     * @param int $id
     * @return boolean
     */
    public function buscarDatos($idcompraestadotipo) {
        $bd = new BaseDatos();
        $resultado = false;
        if ($bd->Iniciar()) {
            $consulta = "SELECT * FROM compraestadotipo WHERE idcompraestadotipo = $idcompraestadotipo";
            if ($bd->Ejecutar($consulta)) {
                if ($row = $bd->Registro()) {
                    $this->cargarDatos($idcompraestadotipo, $row['cetdescripcion'], $row['cetdetalle']);
                    $resultado = true;
                }
            }
        }
        return $resultado;
    }
    
    /**
     * Retorna una coleccion de compraestadotipos que cumplan $condicion
     * @param $condicion // WHERE de sql
     * @return array // compraestadotipos que cumplieron la condicion
     */
    public function listar($condicion = "") {
        $coleccion = [];
        $bd = new BaseDatos();
        if ($bd->Iniciar()) {
            $consulta = "SELECT * FROM compraestadotipo";
            if ($condicion != "") {
                $consulta = $consulta.' WHERE '.$condicion;
            }
            $consulta .= " ORDER BY idcompraestadotipo ";
            if ($bd->Ejecutar($consulta)) {
                while ($row = $bd->Registro()) {
                    $obj = new CompraEstadoTipo();
                    $obj->cargarDatos($row['idcompraestadotipo'], $row['cetdescripcion'], $row['cetdetalle']);
                    array_push($coleccion, $obj);
                }
            } else {
                $this->setMensajeOperacion($bd->getError());
            }
        } else {
            $this->setMensajeOperacion($bd->getError());
        }
        return $coleccion;
    }

    /**
     * Insertar los datos de un compraestadotipo a la bd
     * @return boolean
     */
    public function insertar() {
        $resultado = false;
        $bd = new BaseDatos();
        if ($bd->Iniciar()) {
            $consulta = "INSERT INTO compraestadotipo(cetdescripcion, cetdetalle) VALUES 
            ('".$this->getCetdescripcion()."', '".$this->getCetdetalle()."')";
            if ($bd->Ejecutar($consulta)) {
                $resultado = true;
            } else {
                $this->setMensajeOperacion($bd->getError());
            }
        } else {
            $this->setMensajeOperacion($bd->getError());
        }
        return $resultado;
    }

    /**
     * Modificar los datos de un compraestadotipo con los que tiene el objeto actual 
     * @return boolean
     */
    public function modificar() {
        $bd = new BaseDatos();
        $resultado = false;
        if ($bd->Iniciar()) {
            $consulta = "UPDATE compraestadotipo 
                            SET cetdescripcion = '".$this->getCetdescripcion()."', 
                                cetdetalle = '".$this->getCetdetalle()."', 
                            WHERE idcompraestadotipo = ".$this->getIdcompraestadotipo();
            if ($bd->Ejecutar($consulta)) {
                $resultado = true;
            } else {
                $this->setMensajeOperacion($bd->getError());
            }
        } else {
            $this->setMensajeOperacion($bd->getError());
        }
        return $resultado;
    }
    
    /**
     * Eliminar un compraestadotipo de la bd
     * @return boolean
     */
    public function eliminar() {
        $bd = new BaseDatos();
        $resultado = false;
        if ($bd->Iniciar()) {
            $consulta = "DELETE FROM compraestadotipo WHERE idcompraestadotipo = ".$this->getIdcompraestadotipo();
            if ($bd->Ejecutar($consulta)) {
                $resultado = true;
            } else {
                $this->setMensajeOperacion($bd->getError());
            }
        } else {
            $this->setMensajeOperacion($bd->getError());
        }
        return $resultado;
    }
    /**
     * Retorna un string con los datos del compraestadotipo
     * @return string
     */
    public function __toString() {
        return ("idcompraestadotipo: ".$this->getIdcompraestadotipo()." \n 
        cetdescripcion: ".$this->getCetdescripcion()."\n 
        cetdetalle: ".$this->getCetdetalle());
    }
}
?>