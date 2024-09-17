<?php
include_once 'BaseDatos.php';

/**
 * @var String $NroDni
 * @var String $Apellido
 * @var String $Nombre
 * @var String $fechaNac
 * @var String $Telefono
 * @var String $Domicilio
 */
Class Persona{
    private $NroDni;
    private $Apellido;
    private $Nombre;
    private $fechaNac;
    private $Telefono;
    private $Domicilio;
    private $mensajeDeOperacion;

    /**
     * @param String $dni
     * @param String $ape
     * @param String $nom
     * @param String $fecha
     * @param String $tel
     * @param String $dom
     */
    public function __construct($dni = null, $ape = null, $nom = null, $fecha = null, $tel = null, $dom = null) {
        $this->NroDni = $dni;
        $this->Apellido = $ape;
        $this->Nombre = $nom;
        $this->fechaNac = $fecha;
        $this->Telefono = $tel;
        $this->Domicilio = $dom;
    }
    
    public function setNroDni($dni) {
        $this->NroDni = $dni;
    }

    /**
     * @return String
     */
    public function getNroDni() {
        return $this->NroDni;
    }

    public function setApellido($ape) {   
        $this->Apellido = $ape;
    }
    
    /**
     * @return String
     */
    public function getApellido() {
        return $this->Apellido;
    }

    public function setNombre($nom) {   
        $this->Nombre = $nom;
    }
    
    /**
     * @return String
     */
    public function getNombre() {
        return $this->Nombre;
    }

    public function setFechaNac($fecha) {   
        $this->fechaNac = $fecha;
    }
    
    /**
     * @return String
     */
    public function getFechaNac() {
        return $this->fechaNac;
    }

    public function setTelefono($tel) {   
        $this->Telefono = $tel;
    }
    
    /**
     * @return String
     */
    public function getTelefono() {
        return $this->Telefono;
    }

    public function setDomicilio($dom) {   
        $this->Domicilio = $dom;
    }
    
    /**
     * @return String
     */
    public function getDomicilio() {
        return $this->Domicilio;
    }

    public function setMensajeDeOperacion($msj) {
        $this->mensajeDeOperacion = $msj;
    }

    public function getMensajeDeOperacion() {
        return $this->mensajeDeOperacion;
    }

    /**
     * Asigna todas las variables de una Persona
     * @param String $dni
     * @param String $ape
     * @param String $nom
     * @param String $fecha
     * @param String $tel
     * @param String $dom
     */
    public function cargarDatos($dni, $ape = null, $nom = null, $fecha = null, $tel = null, $dom = null) {
        $this->setNroDni($dni);
        $this->setApellido($ape);
        $this->setNombre($nom);
        $this->setFechaNac($fecha);
        $this->setTelefono($tel);
        $this->setDomicilio($dom);
    }

    /**
     * Recupera datos de una Persona segun su id
     * @param String $dni
     * @return boolean en caso de encontrarlo
     */
    public function buscarDatos($dni) {
        $bD = new BaseDatos();
        $resultado = false;
        if ($bD->Iniciar()) {
            $consulta = "SELECT * FROM Persona WHERE NroDni = '$dni'";
            if ($bD->Ejecutar($consulta)) {
                if ($row = $bD->Registro()) {
                    $this->cargarDatos($dni, $row['Apellido'], $row['Nombre'], $row['fechaNac'], $row['Telefono'], $row['Domicilio']);
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
     * Retorna una coleccion de Personas donde se cumpla $condicion
     * @param $condicion //WHERE de sql
     * @return array Personas que cumplieron la $condicion
     */
    public function listar($condicion = "") {
        $coleccion = [];
        $bD = new BaseDatos();
        if ($bD->Iniciar()) {
            $consulta = "SELECT * FROM Persona ";
            if ($condicion != "") {
                $consulta = $consulta.' WHERE '.$condicion;
            }
            $consulta .= " order by NroDni ";
            if ($bD->Ejecutar($consulta)) {
                while ($row = $bD->Registro()) {
                    $persona = new Persona();
                    $persona->cargarDatos($row['NroDni'], $row['Apellido'], $row['Nombre'], $row['fechaNac'], $row['Telefono'], $row['Domicilio']);
                    array_push($coleccion, $persona);
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
     * Inserta los datos de la Persona actual a la bd
     * @return boolean
     */
    public function insertar() {
        $resultado = false;
        $bD = new BaseDatos();
        if ($bD->Iniciar()) {
            $consulta = "INSERT INTO Persona(NroDni, Apellido, Nombre, fechaNac, Telefono, Domicilio) 
            VALUES ('".$this->getNroDni()."','".$this->getApellido()."','".$this->getNombre()."',
            '".$this->getFechaNac()."','".$this->getTelefono()."','".$this->getDomicilio()."')";
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
            $consulta = "UPDATE Persona
            SET Apellido = '".$this->getApellido()."', Nombre = '".$this->getNombre()."', 
                fechaNac = '".$this->getFechaNac()."', Telefono = '".$this->getTelefono()."', 
                Domicilio = '".$this->getDomicilio()."'
            WHERE NroDni = '".$this->getNroDni()."'";
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
     * Elimina los datos de la persona actual de la bd
     * @return boolean 
     */
    public function eliminar() {
        $bD = new BaseDatos();
        $resultado = false;
        if ($bD->Iniciar()) {
            $consulta = "DELETE FROM Persona WHERE NroDni = '".$this->getNroDni()."'";
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
     * Retorna string con datos de la persona
     * @return String
     */
    public function __toString() {
        return ("DNI: ".$this->getNroDni().
            "\nApellido: ".$this->getApellido(). 
            "\nNombre: ".$this->getNombre().
            "\nNacimiento: ".$this->getFechaNac().
            "\nTelefono: ".$this->getTelefono().
            "\nDomicilio: ".$this->getDomicilio()."\n");
    }

    /**
     * Debugging y testing
     */
    public function toArray() {
        return ([
            'NroDni' => ($this->getNroDni()),
            'Apellido' => ($this->getApellido()),
            'Nombre' => ($this->getNombre()),
            'fechaNac' => ($this->getFechaNac()),
            'Telefono' => ($this->getTelefono()),
            'Domicilio' => ($this->getDomicilio())
        ]);
    }
}
?>