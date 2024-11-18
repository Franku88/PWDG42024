<?php 

include_once 'BaseDatos.php';

class Usuario {
    private $idusuario;
    private $idrol;
    private $mensajeOperacion;
    
    public function __construct($idusuario = null, $idrol = null, $usdesabilitado = null) {
        $this->idusuario = $idusuario;
        $this->idrol = $idrol;
        $this->usdesabilitado = $usdesabilitado;
    }
    // getters
    public function getIdusuario() {
        return $this->idusuario;
    }
    public function getIdrol() {
        return $this->idrol;
    }
    public function getmensajeOperacion() {
        return $this->mensajeOperacion;
    }
    // setters
    public function setIdusuario($idusuario) {
        $this->idusuario = $idusuario;
    }
    public function setIdrol($idrol) {
        $this->idrol = $idrol;
    }
    public function setmensajeOperacion($mensajeOperacion){
        $this->mensajeOperacion=$mensajeOperacion;
    }
    // metodos CRUD
    public function cargarDatos($idusuario, $idrol) {
        $this->setIdusuario($idusuario);
        $this->setIdrol($idrol);
    }

    /**
     * Buscar datos de un usuariorol por sus ids
     * @param int $idusuario
     * @param int $idrol
     * @return boolean
     */
    public function buscarDatos($idusuario, $idrol) {
        $bd = new BaseDatos();
        $resultado = false;
        if ($bd->Iniciar()) {
            $consulta = "SELECT * FROM usuariorol WHERE idusuario = $idusuario AND idrol = $idrol";
            if ($bd->Ejecutar($consulta)) {
                if ($row = $bd->Registro()) {
                    $this->cargarDatos($idusuario, $idrol);
                    $resultado = true;
                }
            }
        }
        return $resultado;
    }
    
    /**
     * Retorna una coleccion de usuariorol donde se cumpla $condicion
     * @param $condicion // WHERE de sql
     * @return array // usuariorol que cumplieron la condicion
     */
    public function listar($condicion = "") {
        $coleccion = [];
        $bd = new BaseDatos();
        if ($bd->Iniciar()) {
            $consulta = "SELECT * FROM usuariorol";
            if ($condicion != "") {
                $consulta = $consulta.' WHERE '.$condicion;
            }
            $consulta .= " ORDER BY idusuario ";
            if ($bd->Ejecutar($consulta)) {
                while ($row = $bd->Registro()) {
                    $obj = new UsuarioRol();
                    $obj->cargarDatos($row['idusuario'], $row['idrol']);
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
     * Insertar los datos de un usuariorol a la bd
     * @return boolean
     */
    public function insertar() {
        $resultado = false;
        $bd = new BaseDatos();
        if ($bd->Iniciar()) {
            $consulta = "INSERT INTO usuariorol(idusuario, idrol) VALUES ('".$this->getIdusuario()."', '".$this->getIdrol()."')";
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
     * Modificar los datos de un usuariorol con los que tiene el objeto actual 
     * (Ambos y unicos atributos son clave, nunca se utilizaria este metodo. En dicho caso,
     * se realizara el alta de otro usuariorol y luego la baja del que no es necesario)
     * @return boolean
     */
    public function modificar() {
        $bd = new BaseDatos();
        $resultado = false;
        if ($bd->Iniciar()) {
            $consulta = "UPDATE usuariorol SET idrol = '".$this->getIdrol()."' WHERE idusuario = ".$this->getIdusuario();
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
     * Eliminar un usuariorol de la bd
     * @return boolean
     */
    public function eliminar() {
        $bd = new BaseDatos();
        $resultado = false;
        if ($bd->Iniciar()) {
            $consulta = "DELETE FROM usuariorol WHERE idusuario = '".$this->getIdusuario()."' AND idrol = '".$this->getIdrol()."'";
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
     * Retorna un string con los datos del usuariorol
     * @return string
     */
    public function __toString() {
        return ("idusuario: ".$this->getIdusuario()." \n idrol: ".$this->getIdrol());
    }
}
?>