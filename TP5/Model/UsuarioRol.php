<?php 

include_once 'BaseDatos.php';

class UsuarioRol {
    private $idusuario;
    private $idrol;
    private $mensajeOperacion;

    public function __construct($idusuario = null , $idrol = null) {
        $this->idusuario = $idusuario;
        $this->idrol = $idrol;
    }
    // getters
    public function getIdusuario() {
        return $this->idusuario;
    }
    public function getIdRol() { 
        return $this->idrol;
    }
    public function getMensajeOperacion() {
        return $this->mensajeOperacion;
    }
    // setters
    public function setIdUsuario($idUsuario) {
        $this->idusuario = $idUsuario;
    }
    public function setIdRol($idRol) {
        $this->idrol = $idRol;
    }
    public function setMensajeOperacion($mensajeOperacion) {
        $this->mensajeOperacion = $mensajeOperacion;
    }

    // metodos CRUD
    public function cargarDatos($idusuario , $idrol) {
        $this->setIdUsuario( $idusuario );
        $this->setIdRol( $idrol );
    }

    /**
     * Buscar datos de un usuario por su id
     */
    public function buscarDatos($idusuario) {
        $bd = new BaseDatos();
        $resultado = false; 
        if ($bd->Iniciar()) {
            $consulta = "SELECT * FROM usuariorol WHERE idusuario = $idusuario";
            if ($bd->Ejecutar($consulta)) {
                if ($row = $bd->Registro()) {
                    $this->cargarDatos($row['idusuario'], $row['idrol']);
                    $resultado = true;
                }
            }
        }
        return $resultado;
    }

    /**
     * Retorna una coleccion de usuarios y roles donde se cumpla $condicion
     * @param $condicion
     * @return array
     */
    public function listar($condicion = "") {
        $coleccion = [];
        $bd = new BaseDatos();
        if ($bd->Iniciar()) {
            $consulta = "SELECT * FROM usuariorol ";
            if ($condicion != "") {
                $consulta = $consulta . ' WHERE ' . $condicion;
            }
            $consulta .= " ORDER BY idusuario";
            if ($bd->Ejecutar($consulta)) {
                while ($row = $bd->Registro()) {
                    $obj = new UsuarioRol();
                    $obj->cargarDatos($row['idusuario'], $row['idrol']);
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
     * Insertar los datos de un usuario a la bd
     * @return boolean
     */
    public function insertar() {
        $resultado = false;
        $bd = new BaseDatos();
        if ($bd->Iniciar()) {
            $consulta = "INSERT INTO usuariorol(idusuario, idrol) VALUES (" . $this->getIdUsuario() . "," . $this->getIdRol() . ")";
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
     * Modificar los datos de un usuario en la bd
     * @return boolean
     */
    public function modificar() {
        $resultado = false;
        $bd = new BaseDatos();
        if ($bd->Iniciar()) {
            $consulta = "UPDATE usuariorol SET idrol = " . $this->getIdRol() . " WHERE idusuario = " . $this->getIdUsuario();
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
     * Eliminar un usuario de la bd
     * @return boolean
     */
    public function eliminar() {
        $bd = new BaseDatos();
        $resultado = false;
        if ($bd->Iniciar()) {
            $consulta = "DELETE FROM usuariorol WHERE idusuario = " . $this->getIdUsuario();
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
     * Retorna un string con los datos del usuario
     * @return string
     */

     public function __toString()
     {
        return ("idUsuario:" .$this->getIdRol() . "\n" . "idRol:" . $this->getIdRol()); ;
     }
    
}