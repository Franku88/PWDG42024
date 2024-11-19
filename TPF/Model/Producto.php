<?php

class producto
{
    private $idproducto;
    private $pronombre;
    private $prodetalle;
    private $proprecio;
    private $procantstock;
    private $prodeshabilitado;
    private $mensajeOperacion;


    public function __construct($idproducto = null, $proprecio = null, $pronombre = null, $prodetalle = null, $procantstock = null, $prodeshabilitado = null)
    {
        $this->idproducto = $idproducto;
        $this->proprecio = $proprecio;
        $this->pronombre = $pronombre;
        $this->prodetalle = $prodetalle;
        $this->procantstock = $procantstock;
        $this->prodeshabilitado = $prodeshabilitado;
    }

    // Getters
    public function getIdproducto()
    {
        return $this->idproducto;
    }

    public function getProprecio()
    {
        return $this->proprecio;
    }


    public function getPronombre()
    {
        return $this->pronombre;
    }

    public function getProdetalle()
    {
        return $this->prodetalle;
    }

    public function getProcantstock()
    {
        return $this->procantstock;
    }

    public function getProdeshabilitado()
    {
        return $this->prodeshabilitado;
    }

    public function getMensajeOperacion()
    {
        return $this->mensajeOperacion;
    }

    // Setters
    public function setIdproducto($idproducto)
    {
        $this->idproducto = $idproducto;
    }

    public function setProprecio($proprecio)
    {
        $this->proprecio = $proprecio;
    }

    public function setPronombre($pronombre)
    {
        $this->pronombre = $pronombre;
    }

    public function setProdetalle($prodetalle)
    {
        $this->prodetalle = $prodetalle;
    }
    public function setProcantstock($procantstock)
    {
        $this->procantstock = $procantstock;
    }

    public function setProdeshabilitado($prodeshabilitado)
    {
        $this->prodeshabilitado = $prodeshabilitado;
    }

    public function setMensajeOperacion($mensajeOperacion)
    {
        $this->mensajeOperacion = $mensajeOperacion;
    }

    // Metodos
    public function setear($idproducto, $proprecio = null, $pronombre = null, $prodetalle = null, $procantstock = null, $prodeshabilitado = null)
    {
        $this->setIdproducto($idproducto);
        $this->setProprecio($proprecio);
        $this->setPronombre($pronombre);
        $this->setProdetalle($prodetalle);
        $this->setProcantstock($procantstock);
        $this->setProdeshabilitado($prodeshabilitado);
    }

    public function cargar()
    {
        $resp = false;
        $base = new BaseDatos();

        $sql = "SELECT * FROM producto WHERE idproducto = '" . $this->getIdproducto() . "'";

        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    $row = $base->Registro();
                    $this->setear($row['idproducto'], $row['proprecio'], $row['pronombre'], $row['prodetalle'], $row['procantstock'], $row['prodeshabilitado']);
                    $resp = true;
                }
            }
        } else {
            $this->setMensajeOperacion("Producto->listar: " . $base->getError());
        }

        return $resp;
    }

    public function insertar()
    {
        $resp = false;
        $base = new BaseDatos();
        if ($base->Iniciar()) {
            $sql = "INSERT INTO producto (proprecio, pronombre, prodetalle, procantstock) 
                    VALUES ('" . $this->getProprecio() . "', '" . $this->getPronombre() . "', '" . $this->getProdetalle() . "', " . $this->getProcantstock() . ")";
            
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion("Producto->insertar: " . $base->getError());
            }
        } else {
            $this->setMensajeOperacion("Producto->insertar: " . $base->getError());
        }
        return $resp;
    }
    


    public function modificar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "UPDATE producto SET 
                    idproducto='" . $this->getIdproducto() . "',
                    proprecio=" . $this->getProprecio() . ", 
                    pronombre='" . $this->getPronombre() . "', 
                    prodetalle='" . $this->getProdetalle() . "', 
                    procantstock=" . $this->getProcantstock() . ", 
                    prodeshabilitado = '0000-00-00 00:00:00' 
                WHERE idproducto='" . $this->getIdproducto() . "'";

        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion("Producto->modificar: " . $base->getError());
            }
        } else {
            $this->setMensajeOperacion("Producto->modificar: " . $base->getError());
        }
        return $resp;
    }


    public function eliminar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "DELETE FROM producto WHERE idproducto='" . $this->getIdproducto() . "'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->setMensajeOperacion("Producto->eliminar: " . $base->getError());
            }
        } else {
            $this->setMensajeOperacion("Producto->eliminar: " . $base->getError());
        }
        return $resp;
    }


    public function listar($condicion = "")
    {
        $coleccion = [];
        $base = new BaseDatos();
        if ($base->iniciar()) {
            $consulta = "SELECT * FROM producto";
            if ($condicion != "") {
                $consulta = $consulta . ' WHERE ' . $condicion;
            }
            if ($base->Ejecutar($consulta)) {
                while ($row2 = $base->Registro()) {
                    $obj = new Producto();
                    $obj->setear($row2['idproducto'], $row2['proprecio'], $row2['pronombre'], $row2['prodetalle'], $row2['procantstock'], $row2['prodeshabilitado']);
                    array_push($coleccion, $obj);
                }
            } else {
                $this->setmensajeOperacion($base->getError());
            }
        }
        return $coleccion;
    }


    public function estado($param = "")
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "UPDATE producto SET prodeshabilitado= '" . $param . "' WHERE idproducto='" . $this->getIdproducto() . "'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion("Producto->estado: " . $base->getError());
            }
        } else {
            $this->setMensajeOperacion("Producto->estado: " . $base->getError());
        }
        return $resp;
    }
}
