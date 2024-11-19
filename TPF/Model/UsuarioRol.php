<?php 

include_once 'BaseDatos.php';

class UsuarioRol {
    private $objUsuario;
    private $objRol;
    private $mensajeOperacion;
    
    public function __construct($objUsuario = null, $objRol = null) {
        $this->objUsuario = $objUsuario;
        $this->objRol = $objRol;
    }
    // getters
    public function getUsuario() {
        return $this->objUsuario;
    }
    public function getRol() {
        return $this->objRol;
    }
    public function getmensajeOperacion() {
        return $this->mensajeOperacion;
    }
    // setters
    public function setUsuario($objUsuario) {
        $this->objUsuario = $objUsuario;
    }
    public function setRol($objRol) {
        $this->objRol = $objRol;
    }
    public function setmensajeOperacion($mensajeOperacion){
        $this->mensajeOperacion = $mensajeOperacion;
    }
    // metodos CRUD
    public function cargarDatos($objUsuario, $objRol) {
        $this->setUsuario($objUsuario);
        $this->setRol($objRol);
    }

    /**
     * Buscar datos de un usuariorol por sus ids
     * @param Usuario $objUsuario
     * @param Rol $objRol
     * @return boolean
     */
    public function buscarDatos($objUsuario, $objRol) {
        $bd = new BaseDatos();
        $resultado = false;
        if ($bd->Iniciar()) {
            $consulta = "SELECT * FROM usuariorol 
            WHERE idusuario = '".$objUsuario->getIdusuario()."' AND idrol = '".$objRol->getIdrol()."'";
            if ($bd->Ejecutar($consulta)) {
                if ($row = $bd->Registro()) {
                    //Busca datos de cada objeto por separado
                    $objUsuario = new Usuario();
                    $objUsuario->buscarDatos($row['idusuario']);
                    $objRol = new Rol();
                    $objRol->buscarDatos($row['idrol']);
                    $this->cargarDatos($objUsuario, $objRol);
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
                    $objUsuario = new Usuario();
                    $objUsuario->buscarDatos($row['idusuario']);

                    $objRol = new Rol();
                    $objRol->buscarDatos($row['idrol']);

                    $obj = new UsuarioRol();
                    $obj->cargarDatos($objUsuario, $objRol);
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
            $consulta = "INSERT INTO usuariorol(idusuario, idrol) VALUES 
            ('".($this->getUsuario())->getIdusuario()."', '".($this->getRol())->getIdrol()."')";
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
            $consulta = "UPDATE usuariorol SET idrol = '".($this->getRol())->getIdrol()."' 
            WHERE idusuario = ".($this->getUsuario())->getIdusuario();
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
            $consulta = "DELETE FROM usuariorol 
            WHERE idusuario = '".($this->getUsuario())->getIdusuario()."' AND idrol = '".($this->getRol())->getIdrol()."'";
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
        return ("usuario: ".$this->getUsuario()." \n Rol: ".$this->getRol());
    }
}
?>