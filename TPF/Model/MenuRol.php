<?php

include_once 'BaseDatos.php';

class MenuRol   {
    private $objMenu;
    private $objRol;
    private $mensajeOperacion;

    public function __construct()
    {
        $this->objMenu = null;
        $this->objRol = null;
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
    public function setear($menu, $rol)
    {
        $this->setObjMenu($menu);
        $this->setObjRol($rol);
    }

    public function cargar()
    {
        $resp = false;
        $base = new BaseDatos();
        $idmenu = $this->getObjMenu()->getIdmenu();
        $idRol = $this->getObjRol()->getIdrol();
        $sql = "SELECT * FROM menurol WHERE idmenu= " . $idmenu . " AND idrol= " . $idRol;

        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    $objRol = null;
                    $objMenu = null;
                    $row = $base->Registro();

                    if ($row['idrol'] != null) {
                        $objRol = new Rol();
                        $objRol->setId($row['idrol']);
                        $objRol->cargar();
                    }

                    if ($row['idmenu'] != null) {

                        $objMenu = new Menu();
                        $objMenu->setIdmenu($row['idmenu']);
                        $objMenu->cargar();
                    }
                    $this->setear($objMenu, $objRol);
                }
            }
        } else {
            $this->setMensajeOperacion("menuRol->cargar: " . $base->getError());
        }

        return $resp;
    }

    public function insertar()
    {
        $resp = false;
        $base = new BaseDatos();
        $objMenu = $this->getObjMenu();
        $objRol = $this->getObjRol();
        $idmenu = $objMenu->getIdmenu();
        $idRol = $objRol->getId();
        $sql = "INSERT INTO menurol(idmenu,idrol)  VALUES(" . $idmenu . "," . $idRol . ")";

        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("Menurol->insertar: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion("Menurol->insertar: " . $base->getError());
        }

        return $resp;
    }

    public function modificar()
    {
        $resp = false;
        $base = new BaseDatos();
        $idmenu = $this->getObjMenu()->getIdmenu();
        $idRol = $this->getObjRol()->getId();
        $sql = " UPDATE menurol SET ";
        $sql .= " idrol = " . $idRol;
        $sql .= " WHERE idmenu =" . $idmenu;

        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion("Menurol->modificar 1: " . $base->getError());
            }
        } else {
            $this->setMensajeOperacion("Menurol->modificar 2: " . $base->getError());
        }

        return $resp;
    }


    public function eliminar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "DELETE FROM menurol WHERE idmenu=" . $this->getObjMenu()->getIdmenu() . " and idrol= " . $this->getObjRol()->getId();

        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion("Menurol->eliminar: " . $base->getError());
            }
        } else {
            $this->setMensajeOperacion("Menurol->eliminar: " . $base->getError());
        }

        return $resp;
    }


    public function listar($condicion = "") {
        $coleccion = [];
        $base = new BaseDatos();
        
        // Verificamos si la conexión a la base de datos fue exitosa
        if ($base->Iniciar()) {
            // Armamos la consulta SQL
            $sql = "SELECT * FROM menurol ";
            
            // Si hay alguna condición, la agregamos a la consulta
            if ($condicion != "") {
                $sql .= 'WHERE ' . $condicion;
            }
            
            // Ejecutamos la consulta
            if ($base->Ejecutar($sql)) {
                // Recorremos los resultados
                while ($row = $base->Registro()) {
                    // Creamos un nuevo objeto MenuRol
                    $objMenuRol = new MenuRol();
                    
                    // Creamos los objetos Menu y Rol correspondientes
                    $objMenu = new Menu();
                    $objRol = new Rol();
                    
                    // Cargamos los datos del menú y el rol basados en los datos de la base de datos
                    $objMenu->setIdmenu($row['idmenu']);
                    $objMenu->cargar(); // Cargar detalles del menú
                    
                    $objRol->setId($row['idrol']);
                    $objRol->cargar(); // Cargar detalles del rol
                    
                    // Configuramos el objeto MenuRol con el menú y rol correspondientes
                    $objMenuRol->setear($objMenu, $objRol);
                    
                    // Añadimos el objeto a la colección
                    array_push($coleccion, $objMenuRol);
                }
            }
        } else {
            $this->setMensajeOperacion("MenuRol->listar: " . $base->getError());
        }
    
        return $coleccion; // Devolvemos la colección de resultados
    }

    public function __tostring()
    {
        return "Menu: " . $this->getObjMenu() . " \n Rol: " . $this->getObjRol();
    }
    

}