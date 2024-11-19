<?php

include_once '/Applications/XAMPP/xamppfiles/htdocs/PWDG42024/TPF/Model/Menu.php';


class ABMMenu
{
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return Menu
     */
    private function cargarObjeto($param)
    {
        $obj = null;
        if (array_key_exists('menombre', $param)) {
            // Solo asignamos 'idmenu' si está definido y es distinto de null
            $idmenu = array_key_exists('idmenu', $param) ? $param['idmenu'] : null;
            $medeshabilitado = array_key_exists('medeshabilitado', $param) ? $param['medeshabilitado'] : null;
            $obj = new Menu();
            $obj->cargarDatos($idmenu, $param['menombre'], $param['medescripcion'], $param['idpadre'], $medeshabilitado);
        }
        return $obj;
    }

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return Menu
     */
    private function cargarObjetoConClave($param)
    {
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
    private function seteadosCamposClaves($param)
    {
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
    public function alta($param)
    {
        $resp = false;
        if (!array_key_exists('idmenu', $param)) {
            $menu = $this->cargarObjeto($param);
            if ($menu != null && $menu->insertar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    /**
     * Elimina un menu de la BD
     * @param array $param
     * @return boolean
     */
    public function baja($param)
    {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $menu = $this->cargarObjetoConClave($param);
            if ($menu != null and $menu->eliminar()) {
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
    public function modificacion($param)
    {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $menu = $this->cargarObjeto($param);
            if ($menu != null and $menu->modificar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    /**
     * Busca menus en la BD
     * @param array $param
     * @return array
     */

    public function buscar($param = null )
    {
        $where = " true ";
        if ($param != null) {
            if (isset($param["idmenu"])) {
                $where = "idmenu = " . intval($param["idmenu"]);
            }
            if (isset($param["menombre"])) {
                $where = "menombre = " . $param["menombre"];
            }
            if (isset($param["medescripcion"])) {
                $where = "medescripcion = " . $param["medescripcion"];
            }
            if (isset($param["idpadre"])) {
                $where = "idpadre = " . intval($param["idpadre"]);
            }
            if (isset($param["medeshabilitado"])) {
                $where = "medeshabilitado = " . $param["medeshabilitado"] ? 1 : 0;
            }
        }
        $arreglo = (new Menu())->listar($where);
        return $arreglo;
    }
}
