<?php 

include_once 'BaseDatos.php';

Class Rol {
    private $id;
    private $roDescripcion;
    private $mensajeOperacion;

    public function __construct($roDescripcion = null) {
        $this->roDescripcion = $roDescripcion;
    }
    // getters 
    public function getId() {
        return $this->id;
    }
    public function getRoDescripcion() {
        return $this->roDescripcion;
    }
    public function getMensajeOperacion() {
        return $this->mensajeOperacion;
    }
    // setters
    public function setId ($id) {
        $this->id = $id;
    }
    public function setRoDescripcion($rolDesc) {
        $this->roDescripcion = $rolDesc;
    }
    public function setMensajeOperacion($mensajeOperacion) {
        $this->mensajeOperacion = $mensajeOperacion;
    }
    // metodos CRUD

    public function cargarDatos($idrol , $rolDescripcion = null) {
        $this->setRoDescripcion($rolDescripcion);
        $this->setId($idrol);
    }


    /**
     * Buscar datos de un usuario por su id
     * @param int $id
     * @return boolean
     */
    public function buscarDatos($id) {
        $bd = new BaseDatos();
        $resultado = false; 
        if ($bd->Iniciar()) {
            $consulta = "SELECT * FROM rol WHERE idrol = $id";
            if ($bd->Ejecutar($consulta)) {
                if ($row = $bd->Registro()) {
                    $this->cargarDatos($row['idrol'], $row['rodescripcion']);
                    $resultado = true;
                }
            }
        }
        return $resultado;
    }

    /**
     * Retorna una coleccion de roles donde se cumpla $condicion
     * @param $condicion // WHERE de sql
     * @return array // roles que cumplieron la condicion
     */
    public function listar ($condicion = "") {
        $coleccion = [];
        $bd = new BaseDatos();
        if ($bd->Iniciar()) {
            $consulta = "SELECT * FROM rol";
            if ($condicion != "") {
                $consulta = $consulta.' WHERE '.$condicion;
            }
            $consulta .= " order by idrol";
            if ($bd->Ejecutar($consulta)) {
                while ($row = $bd->Registro()) {
                    $rol = new Rol();
                    $rol->cargarDatos($row['idrol'], $row['rodescripcion']);
                    array_push($coleccion, $rol);
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
     * Insertar los datos de un rol a la bd
     * @return boolean
     */
    public function insertar() {
        $resultado = false;
        $bd = new BaseDatos();
        if ($bd->Iniciar()) {
            $consulta = "INSERT INTO rol(rodescripcion) VALUES ('".$this->getRolDescripcion()."')";
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
     * Modificar los datos de un rol en la bd
     * @return boolean
     */
    public function modificar() {
        $resultado = false;
        $bd = new BaseDatos();
        if ($bd->Iniciar()) {
            $consulta = "UPDATE rol SET rodescripcion = '".$this->getRolDescripcion()."' WHERE idrol = ".$this->getId();
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
     * Eliminar un rol de la bd
     * @return boolean
     */
    public function eliminar() {
        $bd = new BaseDatos();
        $resultado = false;
        if ($bd->Iniciar()) {
            $consulta = "DELETE FROM rol WHERE idrol = ".$this->getId();
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
     * Retorna un string con los datos del rol
     * @return string
     */
    public function __tostring() {
        return ("Id: ".$this->getId()."\nDescripcion: ".$this->getRolDescripcion());
    }
    
}