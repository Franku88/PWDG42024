<?php 

include_once 'BaseDatos.php';

class Usuario {
    private $idusuario;
    private $usnombre;
    private $uspass;
    private $usmail;
    private $usdesabilitado;
    private $mensajeOperacion;
    
    public function __construct($idusuario = null, $usnombre = null, $uspass = null, $usmail = null, $usdesabilitado = null) {
        $this->idusuario = $idusuario;
        $this->usnombre = $usnombre;
        $this->uspass = $uspass;
        $this->usmail = $usmail;
        $this->usdesabilitado = $usdesabilitado;
    }
    // getters
    public function getIdusuario() {
        return $this->idusuario;
    }
    public function getUsNombre() {
        return $this->usnombre;
    }
    public function getUsMail() {
        return $this->usmail;
    }
    public function getUsPass() {
        return $this->uspass;
    }
    public function getUsdesabilitado() {
        return $this->usdesabilitado;
    }
    public function getmensajeOperacion() {
        return $this->mensajeOperacion;
    }
    // setters
    public function setIdusuario($idusuario) {
        $this->idusuario = $idusuario;
    }
    public function setUsNombre($usNombre) {
        $this->usnombre = $usNombre;
    }
    public function setUsPass($usPass) {
        $this->uspass = $usPass;
    }
    public function setUsMail($usMail) {
        $this->usmail = $usMail;
    }
    public function setUsdesabilitado($usdesabilitado) {
        $this->usdesabilitado = $usdesabilitado;
    }
    public function setmensajeOperacion($mensajeOperacion){
        $this->mensajeOperacion=$mensajeOperacion;
    }
    // metodos CRUD
    public function cargarDatos($idusuario, $usnombre = null , $uspass = null , $usmail = null , $usdesabilitado = null) {
        $this->setIdusuario($idusuario);
        $this->setUsNombre($usnombre);
        $this->setUsPass($uspass);
        $this->setUsMail($usmail);
        $this->setUsdesabilitado($usdesabilitado);
    }

    /**
     * Buscar datos de un usuario por su id
     * @param int $id
     * @return boolean
     */
    public function buscarDatos($idusuario) {
        $bd = new BaseDatos();
        $resultado = false;
        if ($bd->Iniciar()) {
            $consulta = "SELECT * FROM usuario WHERE idusuario = $idusuario";
            if ($bd->Ejecutar($consulta)) {
                if ($row = $bd->Registro()) {
                    $this->cargarDatos($idusuario, $row['usnombre'], $row['uspass'], $row['usmail'], $row['usdesabilitado']);
                    $resultado = true;
                }
            }

        }
        
        return $resultado;
    }
    
    /**
     * Retorna una coleccion de usuarios donde se cumpla $condicion
     * @param $condicion // WHERE de sql
     * @return array // usuarios que cumplieron la condicion
     */
    public function listar($condicion = "") {
        $coleccion = [];
        $bd = new BaseDatos();
        if ($bd->Iniciar()) {
            $consulta = "SELECT * FROM usuario";
            if ($condicion != "") {
                $consulta = $consulta.' WHERE '.$condicion;
            }
            $consulta .= " ORDER BY idusuario ";
            if ($bd->Ejecutar($consulta)) {
                while ($row = $bd->Registro()) {
                    $obj = new Usuario();
                    $obj->cargarDatos($row['idusuario'], $row['usnombre'], $row['uspass'], $row['usmail'], $row['usdesabilitado']);
                    array_push($coleccion, $obj);
                }
            } else {
                $this->setmensajeOperacion($bd->getError());
            }
        } else {
            $this->setmensajeOperacion($bd->getError());
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
            $consulta = "INSERT INTO usuario(usnombre, uspass, usmail) VALUES ('".$this->getUsNombre()."', '".$this->getUsPass()."', '".$this->getUsMail()."' )";
            if ($bd->Ejecutar($consulta)) {
                $resultado = true;
            } else {
                $this->setmensajeOperacion($bd->getError());
            }
        } else {
            $this->setmensajeOperacion($bd->getError());
        }
        return $resultado;
    }

    /**
     * Modificar los datos de un usuario con los que tiene el objeto actual 
     * @return boolean
     */
    public function modificar() {
        $bd = new BaseDatos();
        $resultado = false;
        if ($bd->Iniciar()) {
            $consulta = "UPDATE usuario SET usnombre = '".$this->getUsNombre()."', uspass = '".$this->getUsPass()."', usmail = '".$this->getUsMail()."' WHERE idusuario = ".$this->getIdusuario();
            if ($bd->Ejecutar($consulta)) {
                $resultado = true;
            } else {
                $this->setmensajeOperacion($bd->getError());
            }
        } else {
            $this->setmensajeOperacion($bd->getError());
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
            $consulta = "DELETE FROM usuario WHERE idusuario = ".$this->getIdusuario();
            if ($bd->Ejecutar($consulta)) {
                $resultado = true;
            } else {
                $this->setmensajeOperacion($bd->getError());
            }
        } else {
            $this->setmensajeOperacion($bd->getError());
        }
        return $resultado;
    }
    /**
     * Retorna un string con los datos del usuario
     * @return string
     */
    public function __tostring() {
        return ("idusuario: ".$this->getIdusuario()." \n usnombre: ".$this->getUsNombre()."\n uspass: ".$this->getUsPass()."\n usmail: ".$this->getUsMail()." \n usdesabilitado: ".$this->getUsdesabilitado());
    }

}