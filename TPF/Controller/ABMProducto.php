<?php

include_once "/Applications/XAMPP/xamppfiles/htdocs/PWDG42024/TPF/Model/Producto.php";

Class ABMProducto
{
    private function cargarObjeto($param)
    {
        $obj = null;
        if (array_key_exists('proprecio', $param) && array_key_exists('pronombre', $param) && array_key_exists('prodetalle', $param) && array_key_exists('procantstock', $param)) {
            $obj = new Producto();
            $idproducto = array_key_exists('idproducto', $param) ? $param['idproducto'] : null;
            $prodeshabilitado = array_key_exists('prodeshabilitado', $param) ? $param['prodeshabilitado'] : null;
            $obj->cargarDatos($idproducto, $param['proprecio'], $param['pronombre'], $param['prodetalle'], $param['procantstock'], $prodeshabilitado);
        }

        return $obj;
    }

    private function cargarObjetoConClave($param)
    {
        $obj = null;

        if (isset($param['idproducto'])) {
            $obj = new Producto();
            $obj->cargarDatos($param['idproducto']);
        }
        return $obj;
    }

    private function seteadosCamposClaves($param)
    {
        $resp = false;
        if (isset($param['idproducto'])) {
            $resp = true;
        }
        return $resp;
    }

    public function alta($param)
    {
        $resp = false;
        if (!array_key_exists('idproducto', $param)) {
            $producto = $this->cargarObjeto($param);
            if ($producto != null and $producto->insertar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    public function baja($param)
    {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $elObjtProducto = $this->cargarObjetoConClave($param);
            if ($elObjtProducto != null and $elObjtProducto->eliminar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    public function modificacion($param)
    {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $elObjtProducto = $this->cargarObjeto($param);
            if ($elObjtProducto != null and $elObjtProducto->modificar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    // public function deshabilitarProd($param)
    // {
    //     $resp = false;
    //     $objProducto = $this->cargarObjetoConClave($param);
    //     $listadoProductos = $objProducto->listar("idproducto='" . $param['idproducto'] . "'");
    //     if (count($listadoProductos) > 0) {
    //         $estadoProducto = $listadoProductos[0]->getProdeshabilitado();
    //         if ($estadoProducto == '0000-00-00 00:00:00') {
    //             if ($objProducto->estado(date("Y-m-d H:i:s"))) {
    //                 $resp = true;
    //             }
    //         } else {
    //             if ($objProducto->estado()) {
    //                 $resp = true;
    //             }
    //         }
    //     }
    //     return $resp;
    // }


    public function buscar($param = null)
    {
        $where = " true ";
        if ($param != null) {
            if (isset($param['idproducto']))
                $where .= " and idproducto ='" . $param['idproducto'] . "'";
            if (isset($param['proprecio']))
                $where .= " and proprecio =" . $param['proprecio'];
            if (isset($param['pronombre']))
                $where .= " and pronombre ='" . $param['pronombre'] . "'";
            if (isset($param['prodetalle']))
                $where .= " and prodetalle ='" . $param['prodetalle'] . "'";
            if (isset($param['procantstock']))
                $where .= " and procantstock >=" . $param['procantstock'];
            if (isset($param['deshabilitado']))
                $where .= " and prodeshabilitado ='" . $param['prodeshabilitado'] . "'";

        }
        $arreglo = (new Producto())->listar($where);
        return $arreglo;
    }
}