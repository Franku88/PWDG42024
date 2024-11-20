<?php

// include_once "/Applications/XAMPP/xamppfiles/htdocs/PWDG42024/TPF/Model/CompraItem.php"; Lo carga el autoloader.php

//idcompraitem(bigint) idproducto(obj) idcompra(obj) cicantidad(int)

class ABMCompraItem {
    
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden 
     * con los nombres de las variables instancias del objeto
     * @param array $param
     * @return CompraItem
     */
    private function cargarObjeto($param) {
        $obj = null;
        if (array_key_exists('idproducto', $param) AND array_key_exists('idcompra', $param) AND array_key_exists('cicantidad', $param)) {
            // Solo asignamos 'idcompraitem' si está definido y es distinto de null
            $idcompraitem = array_key_exists('idcompraitem', $param) ? $param['idcompraitem'] : null;
            $obj = new CompraItem();
            $obj->cargarDatos($idcompraitem, $param['idproducto'], $param['idcompra'], $param['cicantidad']);
        }
        return $obj;
    }

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden 
     * con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return CompraItem
     */
    private function cargarObjetoConClave($param) {
        $obj = null;
        if ($this->seteadosCamposClaves($param)) {
            $obj = new CompraItem();
            $obj->cargarDatos($param['idcompraitem']);
        }
        return $obj;
    }

    /**
     * Corrobora que dentro del arreglo asociativo estan seteados los campos claves
     * @param array $param
     * @return boolean
     */
    private function seteadosCamposClaves($param) {
        $resp = false;
        if (isset($param['idcompraitem'])) {
            $resp = true;
        }
        return $resp;
    }

    /**
     * Inserta un compraItem a la BD con atributos del arreglo ingresado
     * @param array $param
     * @return boolean
     */
    public function alta($param) {
        $resp = false;
        $obj = $this->cargarObjeto($param);
        if ($obj != null && $obj->insertar()) {
            $resp = true;
        }
        return $resp;
    }

    /**
     * Elimina un compraItem de la BD
     * @param array $param
     * @return boolean
     */
    public function baja($param) {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $obj = $this->cargarObjetoConClave($param);
            if ($obj != null && $obj->eliminar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    /**
     * Modifica un compraItem de la BD
     * @param array $param
     * @return boolean
     */
    public function modificacion($param) {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $obj = $this->cargarObjeto($param);
            if ($obj != null && $obj->modificar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    /**
     * Busca compraItem en la BD
     * Si $param es vacío, trae todos los compraItem
     * @param array $param
     * @return array
     */
    public function buscar ($param = null) {
        $where = " true ";
        if ($param != null) {
            if (isset($param['idcompraitem'])) {
                $where .= " AND idcompraitem = ".$param['idcompraitem'];
            }
            if (isset($param['idproducto'])) {
                $where .= " AND idproducto = '".$param['idproducto']."'";
            }
            if (isset($param['idcompra'])) {
                $where .= " AND idcompra = '".$param['idcompra']."'";
            }
            if (isset($param['cicantidad'])) {
                $where .= " AND cicantidad = '".$param['cicantidad']."'";
            }
        }
        $arreglo = (new CompraItem())->listar($where);
        return $arreglo;
    }
}
?>