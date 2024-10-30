<?php 

include_once './TP5/Model/UsuarioRol.php';

class ABMUsuarioRol {
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return UsuarioRol
     */
    private function cargarObjeto($param) {
        $obj = null;
        if (array_key_exists('idusuario', $param) && array_key_exists('idrol', $param)) {
            $obj = new UsuarioRol();
            $obj->cargarDatos($param['idusuario'], $param['idrol']);
        }
        return $obj;
    }

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return UsuarioRol
     */
    private function cargarObjetoConClave($param) {
        $obj = null;
        if ($this->seteadosCamposClaves($param)) {
            $obj = new UsuarioRol();
            $obj->cargarDatos($param['idusuario'], $param['idrol']);
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
        if (isset($param['idusuario']) && isset($param['idrol'])) {
            $resp = true;
        }
        return $resp;
    }

    /**
     * Inserta un usuario-rol a la BD con atributos del arreglo ingresado
     * @param array $param
     * @return boolean
     */
    public function alta($param) {
        $resp = false;
        $ObjUsuarioRol = $this->cargarObjeto($param);
        if ($ObjUsuarioRol != null && $ObjUsuarioRol->insertar()) {
            $resp = true;
        }
        return $resp;
    }

    /**
     * Elimina un usuario-rol de la BD con atributos del arreglo ingresado
     * @param array $param
     * @return boolean
     */
    public function baja($param) {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $ObjUsuarioRol = $this->cargarObjetoConClave($param);
            if ($ObjUsuarioRol != null && $ObjUsuarioRol->eliminar()) {
                $resp = true;
            }
        }
        return $resp;
    }
    
    /**
     * Modifica un usuario-rol de la BD con atributos del arreglo ingresado
     * @param array $param
     * @return boolean
     */
    public function modificacion($param) {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $ObjUsuarioRol = $this->cargarObjeto($param);
            if ($ObjUsuarioRol != null && $ObjUsuarioRol->modificar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    /**
     * Busca un usuario-rol en la BD con atributos del arreglo ingresado
     * @param array $param
     * @return array
     */
    public function buscar($param) {
        $where = " true ";
        if ($param != null) {
            if (isset($param['idusuario'])) {
                $where .= ' and idusuario = ' . $param['idusuario'];
            }
            if (isset($param['idrol'])) {
                $where .= ' and idrol = ' . $param['idrol'];
            }
        }
        $arreglo = (new UsuarioRol())->listar($where);
        return $arreglo;
    }
}