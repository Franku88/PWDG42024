<?php 


include_once './TP5/Model/Rol.php';

class ABMRol {
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return Rol
     */
    private function cargarObjeto($param) {
        $obj = null;
        if (array_key_exists('roldescripcion', $param)) {
            // Solo asignamos 'idrol' si está definido y es distinto de null
            $idrol = array_key_exists('idrol', $param) ? $param['idrol'] : null;
            $obj = new Rol();
            $obj->cargarDatos($idrol, $param['roldescripcion']);
        }
        return $obj;
    }

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return Rol
     */
    private function cargarObjetoConClave($param) {
        $obj = null;
        if ($this->seteadosCamposClaves($param)) {
            $obj = new Rol();
            $obj->cargarDatos($param['idrol']);
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
        if (isset($param['idrol'])) {
            $resp = true;
        }
        return $resp;
    }

    /**
     * Inserta un rol a la BD con atributos del arreglo ingresado
     * @param array $param
     * @return boolean
     */
    public function alta($param) {
        $resp = false;
        $ObjRol = $this->cargarObjeto($param);
        if ($ObjRol != null && $ObjRol->insertar()) {
            $resp = true;
        }
        return $resp;
    }

    /**
     * Elimina un rol de la BD
     * @param array $param
     * @return boolean
     */
    public function baja($param) {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $ObjRol = $this->cargarObjetoConClave($param);
            if ($ObjRol != null && $ObjRol->eliminar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    /**
     * Modifica un rol de la BD
     * @param array $param
     * @return boolean
     */
    public function modificacion($param) {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $ObjRol = $this->cargarObjeto($param);
            if ($ObjRol != null && $ObjRol->modificar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    /**
     * Busca un rol en la BD
     * Si $param es vacío, trae todos los roles
     * @param array $param
     * @return array
     */
    public function buscar ($param = null) {
        $where = " true ";
        if ($param != null) {
            if (isset($param['idrol'])) {
                $where = "idrol = ".$param['idrol'];
            }
            if (isset($param['roldescripcion'])) {
                $where = "roldescripcion = '".$param['roldescripcion']."'";
            }
        }
        $arreglo = (new Rol())->listar($where);
        return $arreglo;
    }
}
