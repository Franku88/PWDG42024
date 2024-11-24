<?php
include_once 'BaseDatos.php';

class Menu {
    private $idmenu;
    private $menombre;
    private $medescripcion;
    private $meurl;
    private $objPadre;
    private $medeshabilitado;
    private $mensajeOperacion;

    public function __construct($idmenu = null, $menombre = null, $medescripcion = null, $meurl = null, $objPadre = null, $medeshabilitado = null) {
        $this->idmenu = $idmenu;
        $this->menombre = $menombre;
        $this->medescripcion = $medescripcion;
        $this->meurl = $meurl;
        $this->objPadre = $objPadre;
        $this->medeshabilitado = $medeshabilitado;
    }

    // getters
    public function getIdmenu() {
        return $this->idmenu;
    }

    public function getMenombre() {
        return $this->menombre;
    }

    public function getMedescripcion() {
        return $this->medescripcion;
    }

    public function getMeurl() {
        return $this->meurl;
    }

    public function getPadre() {
        return $this->objPadre;
    }

    public function getMedeshabilitado() {
        return $this->medeshabilitado;
    }

    public function getmensajeOperacion() {
        return $this->mensajeOperacion;
    }

    // setters
    public function setIdmenu($idmenu) {
        $this->idmenu = $idmenu;
    }

    public function setMenombre($menombre) {
        $this->menombre = $menombre;
    }

    public function setMedescripcion($medescripcion) {
        $this->medescripcion = $medescripcion;
    }

    public function setMeurl($meurl) {
        $this->meurl = $meurl;
    }

    public function setPadre($objPadre) {
        $this->objPadre = $objPadre;
    }

    public function setMedeshabilitado($medeshabilitado) {
        $this->medeshabilitado = $medeshabilitado;
    }

    public function setmensajeOperacion($mensajeOperacion) {
        $this->mensajeOperacion = $mensajeOperacion;
    }
    
    // metodos CRUD
    public function cargarDatos($idmenu, $menombre = null, $medescripcion = null, $meurl = null, $objPadre = null, $medeshabilitado = null) {
        $this->setIdmenu($idmenu);
        $this->setMenombre($menombre);
        $this->setMedescripcion($medescripcion);
        $this->setMeurl($meurl);
        $this->setPadre($objPadre);
        $this->setMedeshabilitado($medeshabilitado);
    }

    /**
     * Buscar datos de un menu por su id
     * @param int $idmenu
     * @return boolean
     */
    public function buscarDatos($idmenu) {
        $bd = new BaseDatos();
        $resultado = false;
        if ($bd->Iniciar()) {
            $consulta = "SELECT * FROM menu WHERE idmenu = $idmenu";
            if ($bd->Ejecutar($consulta)) {
                if ($row = $bd->Registro()) {    
                    $objPadre = null;
                    if($row['idpadre'] != null) {
                        $objPadre = new Menu();
                        $objPadre->buscarDatos($row['idpadre']);
                    }
                    $this->cargarDatos($idmenu, $row['menombre'], $row['medescripcion'], $row['meurl'], $objPadre, $row['medeshabilitado']);
                    $resultado = true;
                }
            }
        }
        return $resultado;
    }

    /**
     * Retorna una coleccion de menus donde se cumpla $condicion
     * @param $condicion // WHERE de sql
     * @return array // menus que cumplieron la condicion
     */
    public function listar($condicion = "") {
        $coleccion = [];
        $bd = new BaseDatos();
        if ($bd->Iniciar()) {
            $consulta = "SELECT * FROM menu";
            if ($condicion != "") {
                $consulta = $consulta . ' WHERE ' . $condicion;
            }
            $consulta .= " ORDER BY idmenu ";
            if ($bd->Ejecutar($consulta)) {
                while ($row = $bd->Registro()) {
                    $objPadre = null;
                    if($row['idpadre'] != null) {
                        $objPadre = new Menu();
                        $objPadre->buscarDatos($row['idpadre']);
                    }
                    $obj = new Menu();
                    $obj->cargarDatos($row['idmenu'], $row['menombre'], $row['medescripcion'], $row['meurl'], $objPadre, $row['medeshabilitado']);
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
     * Insertar los datos de un menu a la bd
     * @return boolean
     */
    public function insertar() {
        $resultado = false;
        $bd = new BaseDatos();
        if ($bd->Iniciar()) {
            $idpadre = 'null';
            if ($this->getPadre() != null) {
                $idpadre = ($this->getPadre())->getIdmenu();
            }

            $consulta = "INSERT INTO menu(menombre, medescripcion, meurl, idpadre) VALUES 
            ('".$this->getMenombre()."', '".$this->getMedescripcion()."', '".$this->getMeurl()."', $idpadre)" ;
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
     * Modificar los datos de un menu con los que tiene el objeto actual
     * @return boolean
     */
    public function modificar() {
        $bd = new BaseDatos();
        $resultado = false;
        if ($bd->Iniciar()) {
            $idpadre = 'null';
            if ($this->getPadre() != null) {
                $idpadre = ($this->getPadre())->getIdmenu();
            }
            $consulta = "UPDATE menu 
                        SET menombre = '".$this->getMenombre()."',
                        medescripcion = '".$this->getMedescripcion()."' ,
                        meurl = '".$this->getMeurl()."',
                        idpadre = $idpadre,
                        medeshabilitado = '".$this->getMedeshabilitado()."'
                        WHERE idmenu = ".$this->getIdmenu();
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
     * Eliminar un menu de la bd
     * @return boolean
     */
    public function eliminar() {
        $bd = new BaseDatos();
        $resultado = false;
        if ($bd->Iniciar()) {
            $consulta = "DELETE FROM menu WHERE idmenu = '".$this->getIdmenu()."'";
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
     * Retorna un string con los datos del menu
     * @return string
     */
    public function __toString() {
        return ("idmenu: " . $this->getIdmenu() . " \n 
        menombre: " . $this->getMenombre() . " \n 
        medescripcion: " . $this->getMedescripcion() . " \n 
        meurl: " . $this->getMeurl() . " \n 
        idpadre: " . $this->getPadre() . " \n 
        medeshabilitado: " . $this->getMedeshabilitado());
    }
}
?>