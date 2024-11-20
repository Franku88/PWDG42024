<?php

include_once 'BaseDatos.php';

class MenuRol
{
    private $objMenu;
    private $objRol;
    private $mensajeOperacion;

    public function __construct($objMenu = null, $objRol = null)
    {
        $this->objMenu = $objMenu;
        $this->objRol = $objRol;
    }
    public function getObjMenu()
    {
        return $this->objMenu;
    }

    public function getObjRol()
    {
        return $this->objRol;
    }

    public function getMensajeOperacion()
    {
        return $this->mensajeOperacion;
    }

    public function setObjMenu($objMenu)
    {
        $this->objMenu = $objMenu;
    }

    public function setObjRol($objRol)
    {
        $this->objRol = $objRol;
    }

    public function setMensajeOperacion($mensajeOperacion)
    {
        $this->mensajeOperacion = $mensajeOperacion;
    }

    // Metodos
    public function cargarDatos($objMenu, $objRol)
    {
        $this->setObjMenu($objMenu);
        $this->setObjRol($objRol);
    }

    public function buscarDatos($objMenu, $objRol)
    {
        $bd = new BaseDatos();
        $resultado = false;
        if ($bd->Iniciar()) {
            $consulta = "SELECT * FROM menurol WHERE idmenu = '" . $objMenu->getIdmenu() . "' AND idrol = '" . $objRol->getId() . "'";
            if ($bd->Ejecutar($consulta)) {
                if ($row = $bd->Registro()) {
                    $objMenu = new Menu();
                    $objMenu->buscarDatos($row['idmenu']);
                    $objRol = new Rol();
                    $objRol->buscarDatos($row['idrol']);
                    $this->cargarDatos($objMenu, $objRol);
                    $resultado = true;
                }
            } else {
                $this->setMensajeOperacion("MenuRol->buscarDatos: " . $bd->getError());
            }
        } else {
            $this->setMensajeOperacion("MenuRol->buscarDatos: " . $bd->getError());
        }
        return $resultado;
    }

    public function insertar()
    {
        $resultado = false;
        $bd = new BaseDatos();
        if ($bd->Iniciar()) {
            $consulta = "INSERT INTO menurol(idmenu, idrol) VALUES ('" . $this->getObjMenu()->getIdmenu() . "','" . $this->getObjRol()->getId() . "')";
            if ($bd->Ejecutar($consulta)) {
                $resultado = true;
            } else {
                $this->setMensajeOperacion("MenuRol->insertar: " . $bd->getError());
            }
        } else {
            $this->setMensajeOperacion($bd->getError());
        }
        return $resultado;
    }

    public function modificar()
    {
        $bd = new BaseDatos();
        $resultado = false;
        if ($bd->Iniciar()) {
            $consulta = "UPDATE menurol SET idmenu = '" . $this->getObjMenu()->getIdmenu() . "', idrol = '" . $this->getObjRol()->getId() . "' WHERE idmenu = '" . $this->getObjMenu()->getIdmenu() . "' AND idrol = '" . $this->getObjRol()->getId() . "'";
            if ($bd->Ejecutar($consulta)) {
                $resultado = true;
            } else {
                $this->setMensajeOperacion("MenuRol->modificar: " . $bd->getError());
            }
        } else {
            $this->setMensajeOperacion($bd->getError());
        }
        return $resultado;
    }


    public function eliminar()
    {
        $base = new BaseDatos();
        $resp = false;
        if ($base->Iniciar()) {
            $consulta = "DELETE FROM menurol WHERE idmenu = '" . $this->getObjMenu()->getIdmenu() . "' AND idrol = '" . $this->getObjRol()->getId() . "'";
            if ($base->Ejecutar($consulta)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion("MenuRol->eliminar: " . $base->getError());
            }
        } else {
            $this->setMensajeOperacion($base->getError());
        }
        return $resp;
    }


    public function listar($condicion = "")
    {
        $coleccion = [];
        $bd = new BaseDatos();
        if ($bd->Iniciar()) {
            $consulta = "SELECT * FROM menurol";
            if ($consulta != "") {
                $consulta = $consulta . " WHERE " . $condicion;
            }
            $consulta .= " ORDER BY idmenu";

            if ($bd->Ejecutar($consulta)) {
                while ($row = $bd->Registro()) {
                    $objMenu = new Menu();
                    $objMenu->buscarDatos($row['idmenu']);
                    $objRol = new Rol();
                    $objRol->buscarDatos($row['idrol']);
                    $obj = new MenuRol();
                    $obj->cargarDatos($objMenu, $objRol);
                    array_push($coleccion, $obj);
                }
            } else {
                $this->setMensajeOperacion('MenuRol->listar: ' . $bd->getError());
            }
        } else {
            $this->setMensajeOperacion('MenuRol->listar: ' . $bd->getError());
        }
        return $coleccion;
    }

    public function __tostring()
    {
        return "Menu: " . $this->getObjMenu() . " \n Rol: " . $this->getObjRol();
    }
}
