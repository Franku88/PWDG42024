<?php
include_once 'BaseDatos.php';
include_once 'Persona.php'; // No produce conflictos con el autoloader en todos los ejercicios, pero de hacerlo a futuro se debería poder eliminar sin problema.

/**
 * @var String $Patente
 * @var String $Marca
 * @var int $Modelo
 * @var Persona $persona
 */
Class Auto {
    private $Patente;
    private $Marca;
    private $Modelo;
    private $Duenio;
    private $mensajeDeOperacion;

    /**
     * @param String $pat
     * @param String $mar
     * @param int $mod
     * @param Persona $persona
     */
    public function __construct($pat = null, $mar = null, $mod = null, $persona = null) {
        $this->Patente = $pat;
        $this->Marca = $mar;
        $this->Modelo = $mod;
        $this->Duenio = $persona;
    }
    
    public function setPatente($pat) {
        $this->Patente = $pat;
    }

    /**
     * @return String
     */
    public function getPatente() {
        return $this->Patente;
    }

    public function setMarca($mar) {   
        $this->Marca = $mar;
    }
    
    /**
     * @return String
     */
    public function getMarca() {
        return $this->Marca;
    }

    public function setModelo($mod) {   
        $this->Modelo = $mod;
    }
    
    /**
     * @return int
     */
    public function getModelo() {
        return $this->Modelo;
    }

    public function setDuenio($persona) {   
        $this->Duenio = $persona;
    }
    
    /**
     * @return Persona
     */
    public function getDuenio() {
        return $this->Duenio;
    }

    public function setMensajeDeOperacion($msj) {
        $this->mensajeDeOperacion = $msj;
    }

    public function getMensajeDeOperacion() {
        return $this->mensajeDeOperacion;
    }

    /**
     * Asigna todas las variables de un Auto
     * @param String $pat
     * @param String $mar
     * @param int $mod
     * @param Persona $persona
     */
    public function cargarDatos($pat, $mar = null, $mod = null, $persona = null) {
        $this->setPatente($pat);
        $this->setMarca($mar);
        $this->setModelo($mod);
        $this->setDuenio($persona);
    }

    /**
     * Recupera datos de un Auto segun su id
     * @param String $pat
     * @return boolean en caso de encontrarlo
     */
    public function buscarDatos($pat) {
        $bD = new BaseDatos();
        $resultado = false;
        if ($bD->Iniciar()) {
            $consulta = "SELECT * FROM Auto WHERE Patente = '$pat'";
            if ($bD->Ejecutar($consulta)) {
                if ($row = $bD->Registro()) {
                    $persona = new Persona();
                    $persona->buscarDatos($row['DniDuenio']);
                    $this->cargarDatos($pat, $row['Marca'], $row['Modelo'], $persona);
                    $resultado = true;
                }
            } else {
                $this->setMensajeDeOperacion($bD->getError());
            }
        } else {
            $this->setMensajeDeOperacion($bD->getError());
        }
        return $resultado;
    }

    /**
     * Retorna una coleccion de Autos que cumplan $condicion
     * @param $condicion
     * @return array Autos que cumplieron la $condicion
     */
    public function listar($condicion = "") {
        $coleccion = [];
        $bD = new BaseDatos();
        if ($bD->Iniciar()) {
            $consulta = "SELECT * FROM Auto ";
            if ($condicion != "") {
                $consulta = $consulta.' WHERE '.$condicion;
            }
            $consulta .= " order by Patente ";
            if ($bD->Ejecutar($consulta)) {
                while ($row = $bD->Registro()) {
                    $persona = new Persona();
                    $persona->buscarDatos($row['DniDuenio']);
                    $auto = new Auto();
                    $auto->cargarDatos($row['Patente'], $row['Marca'], $row['Modelo'], $persona);
                    array_push($coleccion, $auto);
                }
            } else {
                $this->setMensajeDeOperacion($bD->getError());
            }
        } else {
            $this->setMensajeDeOperacion($bD->getError());
        }
        return $coleccion;
    }

    /**
     * Inserta los datos del Auto actual a la bd
     * @return boolean
     */
    public function insertar() {
        $resultado = false;
        $bD = new BaseDatos();
        if ($bD->Iniciar()) {
            $consulta = "INSERT INTO Auto(Patente, Marca, Modelo, DniDuenio) 
            VALUES ('".$this->getPatente()."','".$this->getMarca()."','".$this->getModelo()."',
            '".($this->getDuenio())->getNroDni()."')";
            if ($bD->Ejecutar($consulta)) {
                $resultado = true;
            } else {
                $this->setMensajeDeOperacion($bD->getError());
            }
        } else {
            $this->setMensajeDeOperacion($bD->getError());
        }
        return $resultado;
    }

    /**
     * Modifica los datos en la bd con los que tiene el objeto actual
     * @return boolean
     */
    public function modificar() {
        $resultado = false;
        $bD = new BaseDatos();    
        if ($bD->Iniciar()) {
            $consulta = "UPDATE Auto
            SET Marca = '".$this->getMarca()."', Modelo = '".$this->getModelo()."', 
                DniDuenio = '".($this->getDuenio())->getNroDni()."'
            WHERE Patente = '".$this->getPatente()."'";
            if ($bD->Ejecutar($consulta)) {
                $resultado =  true;
            } else {
                $this->setMensajeDeOperacion($bD->getError());
            }
        } else {
            $this->setMensajeDeOperacion($bD->getError());
        }
        return $resultado;
    }

    /**
     * Elimina los datos del auto actual de la bd
     * @return boolean 
     */
    public function eliminar() {
        $bD = new BaseDatos();
        $resultado = false;
        if ($bD->Iniciar()) {
            $consulta = "DELETE FROM Auto WHERE Patente = '".$this->getPatente()."'";
            if ($bD->Ejecutar($consulta)) {
                $resultado =  true;
            } else {
                $this->setMensajeDeOperacion($bD->getError());
            }
        } else {
            $this->setMensajeDeOperacion($bD->getError());
        }
        return $resultado;
    }

    /**
     * Retorna string con datos del auto
     * @return String
     */
    public function __toString() {
        return ("Patente: ".$this->getPatente().
            "\nMarca: ".$this->getMarca(). 
            "\nModelo: ".$this->getModelo()."\n".
            "\n".$this->getDuenio()."\n");
    }

    /**
     * Debugging y testing
     */
    public function toArray() {
        return ([
            'Patente' => ($this->getPatente()),
            'Marca' => ($this->getMarca()),
            'Modelo' => ($this->getModelo()),            
            ]+($this->getDuenio()->toArray())
        );
    }

    /**
     * Debugging y testing
     */
    public function toArrayNyA() {
        $arrDuenio = ($this->getDuenio()->toArray());
        return ([
            'Patente' => ($this->getPatente()),
            'Marca' => ($this->getMarca()),
            'Modelo' => ($this->getModelo()),
            'Nombre' => $arrDuenio['Nombre'],
            'Apellido' => $arrDuenio['Apellido'],
            ]
        );
    }

    /**
     * Debugging y testing
     */
    public function toArraySolo() {
        return ([
            'Patente' => ($this->getPatente()),
            'Marca' => ($this->getMarca()),
            'Modelo' => ($this->getModelo()),            
            ]
        );
    }
}
?>