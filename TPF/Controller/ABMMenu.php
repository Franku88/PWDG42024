<?php

// include_once '/Applications/XAMPP/xamppfiles/htdocs/PWDG42024/TPF/Model/Menu.php'; //Autoloader

class ABMMenu {

    /**
     * Espera como parametro un arreglo asociativo donde 
     * las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return Menu
     */
    private function cargarObjeto($param) {
        $obj = null;
        if (array_key_exists('menombre', $param) AND array_key_exists('medescripcion', $param)) {
            // Solo asignamos 'idmenu' si está definido y es distinto de null
            $idmenu = array_key_exists('idmenu', $param) ? $param['idmenu'] : null;
            $objPadre = array_key_exists('padre', $param) ? $param['padre'] : null;
            $medeshabilitado = array_key_exists('medeshabilitado', $param) ? $param['medeshabilitado'] : '0000-00-00 00:00:00';
            $obj = new Menu();
            $obj->cargarDatos($idmenu, $param['menombre'], $param['medescripcion'], $objPadre, $medeshabilitado);
        }
        return $obj;
    }

    /**
     * Espera como parametro un arreglo asociativo donde 
     * las claves coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return Menu
     */
    private function cargarObjetoConClave($param) {
        $obj = null;
        if ($this->seteadosCamposClaves($param)) {
            $obj = new Menu();
            $obj->cargarDatos($param['idmenu']);
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
        if (isset($param['idmenu'])) {
            $resp = true;
        }
        return $resp;
    }

    /**
     * Inserta un menu a la BD con atributos del arreglo ingresado
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
     * Elimina un menu de la BD
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
     * Modifica un menu de la BD
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
     * Busca menus en la BD
     * Si $param es vacio, trae todos los menues
     * @param array $param
     * @return array
     */
    public function buscar($param = null ) {
        $where = " true ";
        if ($param != null) {
            if (isset($param["idmenu"])) {
                $where .= " AND idmenu = ".intval($param["idmenu"]);
            }
            if (isset($param["menombre"])) {
                $where .= " AND menombre = ".$param["menombre"];
            }
            if (isset($param["medescripcion"])) {
                $where .= " AND medescripcion = ".$param["medescripcion"];
            }
            if (isset($param["idpadre"])) {
                $where .= " AND idpadre = ".intval($param["idpadre"]);
            }
            if (isset($param["medeshabilitado"])) {
                $where .= " AND medeshabilitado ='".$param['medeshabilitado']."'";
            }
        }
        $arreglo = (new Menu())->listar($where);
        return $arreglo;
    }
}
