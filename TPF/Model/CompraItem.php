<?php

include_once 'BaseDatos.php';

// idCompraItem objProducto idcompra cicantidad
include_once 'BaseDatos.php';

class CompraItem
{
    private $idCompraItem;
    private $objProducto;
    private $objCompra;
    private $cICantidad;
    private $mensajeOperacion;

    public function __construct($objProducto = null, $objCompra = null, $cICantidad = null)
    {
        $this->objProducto = $objProducto;
        $this->objCompra = $objCompra;
        $this->cICantidad = $cICantidad;
    }

    // Getters
    public function getIdCompraItem()
    {
        return $this->idCompraItem;
    }

    public function getObjProducto()
    {
        return $this->objProducto;
    }

    public function getObjCompra()
    {
        return $this->objCompra;
    }

    public function getCICantidad()
    {
        return $this->cICantidad;
    }

    public function getMensajeOperacion()
    {
        return $this->mensajeOperacion;
    }

    // Setters
    public function setIdCompraItem($idCompraItem)
    {
        $this->idCompraItem = $idCompraItem;
    }

    public function setObjProducto($objProducto)
    {
        $this->objProducto = $objProducto;
    }

    public function setObjCompra($objCompra)
    {
        $this->objCompra = $objCompra;
    }

    public function setCICantidad($cICantidad)
    {
        $this->cICantidad = $cICantidad;
    }

    public function setMensajeOperacion($mensajeOperacion)
    {
        $this->mensajeOperacion = $mensajeOperacion;
    }

    // Métodos CRUD

    public function cargarDatos($idCompraItem, $objProducto = null, $objCompra = null, $cICantidad = null)
    {
        $this->setIdCompraItem($idCompraItem);
        $this->setObjProducto($objProducto);
        $this->setObjCompra($objCompra);
        $this->setCICantidad($cICantidad);
    }



    /**
     * Buscar datos de un usuario por su id
     * @param int $id
     * @return boolean
     */
    public function buscarDatos($id)
    {
        $bd = new BaseDatos();
        $resultado = false;
        if ($bd->Iniciar()) {
            $consulta = "SELECT * FROM compraitem WHERE idcompraitem = $id";
            if ($bd->Ejecutar($consulta)) {
                if ($row = $bd->Registro()) {
                    $this->cargarDatos($row['idcompraitem'], $row['idproducto'], $row['idcompra'], $row['cicantidad']);
                    $resultado = true;
                }
            }
        }
        return $resultado;
    }


    public function cargar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "SELECT * FROM compraitem WHERE idcompraitem = " . $this->getIdCompraItem();

        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    $row = $base->Registro();
                    $this->cargarDatos(
                        $row['idcompraitem'],
                        $row['idprocuto'],
                        $row['idcompra'],
                        $row['cicantidad']

                    );
                }
            }
        } else {
            $this->setMensajeOperacion("Tabla->listar: " . $base->getError());
        }

        return $resp;
    }

    /**
     * Retorna una coleccion de items de compra donde se cumpla $condicion
     * @param $condicion // WHERE de sql
     * @return array // items de compra que cumplieron la condicion
     */
    public function listar($condicion = "")
    {
        $coleccion = [];
        $bd = new BaseDatos();
        if ($bd->Iniciar()) {
            $consulta = "SELECT * FROM compraitem";
            if ($condicion != "") {
                $consulta = $consulta . ' WHERE ' . $condicion;
            }
            $consulta .= " order by idcompraitem";
            if ($bd->Ejecutar($consulta)) {
                while ($row = $bd->Registro()) {
                    $compraItem = new CompraItem();
                    $compraItem->cargarDatos($row['idcompraitem'], $row['idproducto'], $row['idcompra'], $row['cicantidad']);
                    array_push($coleccion, $compraItem);
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
     * Insertar los datos de un item de compra a la bd
     * @return boolean
     */
    public function insertar()
    {
        $resultado = false;
        $bd = new BaseDatos();
        if ($bd->Iniciar()) {
            $consulta = "INSERT INTO compraitem(idproducto, idcompra, cicantidad) VALUES ('" . ($this->getObjProducto())->getIdproducto() . "','" . ($this->getObjCompra())->getIdcompra() . "','" . $this->getCICantidad() . "')";
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
     * Modificar los datos de un item de compra en la bd
     * @return boolean
     */
    public function modificar()
    {
        $resultado = false;
        $bd = new BaseDatos();
        if ($bd->Iniciar()) {
            $consulta = "UPDATE compraitem SET idproducto = '" . ($this->getObjProducto())->getIdproducto() . "', 
            idcompra = '" . ($this->getObjCompra())->getIdcompra() . "', 
            cicantidad = '" . $this->getCICantidad() . "', 
            '
        WHERE idcompraitem = " . $this->getIdCompraItem();
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
     * Eliminar un item de compra de la bd
     * @return boolean
     */
    public function eliminar()
    {
        $bd = new BaseDatos();
        $resultado = false;
        if ($bd->Iniciar()) {
            $consulta = "DELETE FROM compraitem WHERE idcompraitem = " . $this->getIdCompraItem();
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
     * Retorna un string con los datos del item de compra
     * @return string
     */
    public function __tostring()
    {
        return ("Id: " . $this->getIdCompraItem() . "\nProductos: " . $this->getObjProducto() . "\nCompra: " . $this->getObjCompra() . "\nCantidad: " . $this->getCICantidad());
    }
}
