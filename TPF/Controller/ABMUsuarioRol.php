<?php 

include_once "/Applications/XAMPP/xamppfiles/htdocs/PWDG42024/TPF/Model/UsuarioRol.php";

class ABMUsuarioRol {

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden
     * con los nombres de las variables instancias del objeto
     * @param array $param
     * @return UsuarioRol
     */
    private function cargarObjeto($param) {
        $obj = null;
        if (array_key_exists('usuario', $param) AND array_key_exists('rol', $param)) {
            $obj = new UsuarioRol();
            $obj->cargarDatos($param['usuario'], $param['rol']);
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
        if (isset($param['idusuario'], $param['idrol'])) {
           $resp = true;
        }
        return $resp;
    }

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden
     * con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return UsuarioRol
     */
    public function cargarObjetoConClave($param) {
        $obj = null;
        if ($this->seteadosCamposClaves($param)) {
            $obj = new UsuarioRol();
            $obj->cargarDatos($param['idusuario'], $param['idrol']);
        }
        return $obj;
    }

    /**
     * Inserta un UsuarioRol a la BD con atributos del arreglo ingresado
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
     * Elimina un UsuarioRol de la BD con atributos del arreglo ingresado
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
     * modifica un UsuarioRol de la BD con atributos del arreglo ingresado
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
     * Busca un UsuarioRol en la BD
     * Si $param es vacío, trae todos los UsuarioRol
     * @param array $param
     * @return array
     */
    public function buscar ($param = null) {
        $where = " true ";
        if ($param != null) {
            if (isset($param['idusuario'])) {
                $where .= " and idusuario = ".$param['idusuario'];
            }
            if (isset($param['idrol'])) {
                $where .= " and idrol = ".$param['idrol'];
            }
        }
        $arreglo = (new UsuarioRol())->listar($where);
        return $arreglo;
    }

}   