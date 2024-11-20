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
    public function cargarDatos($idproducto, $proprecio = null, $pronombre = null, $prodetalle = null, $procantstock = null, $prodeshabilitado = null)
    {
        $this->setIdproducto($idproducto);
        $this->setProprecio($proprecio);
        $this->setPronombre($pronombre);
        $this->setProdetalle($prodetalle);
        $this->setProcantstock($procantstock);
        $this->setProdeshabilitado($prodeshabilitado);
    }

    /**
     * Buscar datos de un producto por su id
     * @param int $idproducto
     * @return boolean
     */
    public function buscarDatos($idproducto) {
        $bd = new BaseDatos();
        $resultado = false;
        if ($bd->Iniciar()) {
            $consulta = "SELECT * FROM producto WHERE idproducto = $idproducto";
            if ($bd->Ejecutar($consulta)) {
                if ($row = $bd->Registro()) {
                    $this->cargarDatos($row['idproducto'], $row['proprecio'], $row['pronombre'], $row['prodetalle'], $row['procantstock'], $row['prodeshabilitado']);
                    $resultado = true;
                }
            } else {
                $this->setMensajeOperacion("Producto->buscarDatos: " . $bd->getError());
            }
        }
        return $resultado;
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
                    $obj->cargarDatos($row2['idproducto'], $row2['proprecio'], $row2['pronombre'], $row2['prodetalle'], $row2['procantstock'], $row2['prodeshabilitado']);
                    array_push($coleccion, $obj);
                }
            } else {
                $this->setmensajeOperacion($base->getError());
            }
        }
        return $coleccion;
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
        if ($base->Iniciar()) {
            $consulta = "UPDATE producto SET proprecio = '" . $this->getProprecio() . "', pronombre = '" . $this->getPronombre() . "', prodetalle = '" . $this->getProdetalle() . "', procantstock = " . $this->getProcantstock() . " WHERE idproducto = " . $this->getIdproducto();
            if ($base->Ejecutar($consulta)) {
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
        if ($base->Iniciar()) {
            $consulta = "DELETE FROM producto WHERE idproducto = " . $this->getIdproducto();
            if ($base->Ejecutar($consulta)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion($base->getError());
            }
        } else {
            $this->setMensajeOperacion($base->getError());
        }
        return $resp;
    }

    // public function estado($param = "")
    // {
    //     $resp = false;
    //     $base = new BaseDatos();
    //     $sql = "UPDATE producto SET prodeshabilitado= '" . $param . "' WHERE idproducto='" . $this->getIdproducto() . "'";
    //     if ($base->Iniciar()) {
    //         if ($base->Ejecutar($sql)) {
    //             $resp = true;
    //         } else {
    //             $this->setMensajeOperacion("Producto->estado: " . $base->getError());
    //         }
    //     } else {
    //         $this->setMensajeOperacion("Producto->estado: " . $base->getError());
    //     }
    //     return $resp;
    // }

    public function __toString()
    {
        return (
            "ID del Producto: " . $this->getIdproducto() . "\n" .
            "Nombre del Producto: " . $this->getPronombre() . "\n" .
            "Precio del Producto: " . $this->getProprecio() . "\n" .
            "Detalle del Producto: " . $this->getProdetalle() . "\n" .
            "Cantidad en Stock: " . $this->getProcantstock() . "\n" .
            "Producto Deshabilitado: " . $this->getProdeshabilitado() . "\n"
        );
    }
}
