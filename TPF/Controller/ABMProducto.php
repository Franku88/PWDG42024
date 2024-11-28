<?php

Class ABMProducto
{
    private function cargarObjeto($param)
    {
        $obj = null;
        if (array_key_exists('proprecio', $param) && array_key_exists('pronombre', $param) && array_key_exists('prodetalle', $param) && array_key_exists('procantstock', $param) && array_key_exists('idvideoyt', $param)) {
            $idproducto = array_key_exists('idproducto', $param) ? $param['idproducto'] : null;
            $prodeshabilitado = array_key_exists('prodeshabilitado', $param) ? $param['prodeshabilitado'] : null;
            $obj = new Producto();
            $obj->cargarDatos($idproducto, $param['pronombre'], $param['prodetalle'], $param['procantstock'], $param['proprecio'], $prodeshabilitado, $param['idvideoyt']);
        }
    
        return $obj;
    }
    
    private function cargarObjetoConClave($param) {
        $obj = null;

        if ($this->seteadosCamposClaves($param)) {
            $obj = new Producto();
            $obj->cargarDatos($param['idproducto']);
        }
        return $obj;
    }

    private function seteadosCamposClaves($param) {
        $resp = false;
        if (isset($param['idproducto'])) {
            $resp = true;
        }
        return $resp;
    }

    public function alta($param) {
        $resp = false;
        if (!array_key_exists('idproducto', $param)) {
            $producto = $this->cargarObjeto($param);
            if ($producto != null and $producto->insertar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    public function baja($param) {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $elObjtProducto = $this->cargarObjetoConClave($param);
            if ($elObjtProducto != null and $elObjtProducto->eliminar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    public function modificacion($param) {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $elObjtProducto = $this->cargarObjeto($param);
            if ($elObjtProducto != null and $elObjtProducto->modificar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    /**
     * Lista productos con su informacion necesaria para ser mostrados en Catalogo.
     * Retorna un array de productos (en forma de array) que cumplan $param
     * @param array $param ['idproducto', 'proprecio', 'pronombre', 'prodetalle', 'procantstock', 'deshabilitado', 'idvideoyt']
     */
    public function listarProductos($param = null) {
        $respuesta = [];
        $productos = (new ABMProducto())->buscar($param); //Recupera productos
        foreach($productos as $producto) {
            if ($producto->getProdeshabilitado() == null) { //Convierte en forma de array los que estan habilitados
                $prod['icon'] = BASE_URL."/View/Media/Product/".$producto->getIdproducto()."/icon.png";
                $prod['idproducto'] = $producto->getIdproducto();
                $prod['pronombre'] = $producto->getPronombre();
                $prod['prodetalle'] = $producto->getProdetalle();
                $prod['procantstock'] = $producto->getProcantstock();
                $prod['proprecio'] = $producto->getProprecio();
                $prod['prodeshabilitado'] = $producto->getProdeshabilitado();
                $prod['idvideoyt'] = $producto->getIdvideoyt();
                array_push($respuesta, $prod);
            }
        }
        return $respuesta;
    }

    public function buscar($param = null) {
        $where = " true ";
        if ($param != null) {
            if (isset($param['idproducto'])) {
                $where .= " AND idproducto = ".$param['idproducto'];
            }
            if (isset($param['proprecio'])) {
                $where .= " AND proprecio = ".$param['proprecio'];
            }
            if (isset($param['pronombre'])) {
                $where .= " AND pronombre = '".$param['pronombre']."'";
            }
            if (isset($param['prodetalle'])) {
                $where .= " AND prodetalle = '".$param['prodetalle']."'";
            }
            if (isset($param['procantstock'])) {
                $where .= " AND procantstock = ".$param['procantstock'];
            }
            if (isset($param['deshabilitado'])) {
                $where .= " AND prodeshabilitado = '".$param['prodeshabilitado']."'";
            }
            if (isset($param['idvideoyt'])) {
                $where .= " AND idvideoyt = '".$param['idvideoyt']."'";
            }
        }
        $arreglo = (new Producto())->listar($where);
        return $arreglo;
    }
}