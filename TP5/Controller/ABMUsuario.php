<?php 

include_once "./TP5/Model/Usuario.php";

class ABMUsuario {
    
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return Usuario
     */

     private function cargarObjeto($param) {
        $obj = null;
        if (array_key_exists('usnombre', $param) && array_key_exists('uspass', $param) && array_key_exists('usmail', $param)) {
            // Solo asignamos 'idusuario' si está definido y es distinto de null
            $idusuario = array_key_exists('idusuario', $param) ? $param['idusuario'] : null;
            $usdeshabilitado = array_key_exists('usdeshabilitado', $param) ? $param['usdeshabilitado'] : null;
    
            $obj = new Usuario();
            $obj->cargarDatos($idusuario, $param['usnombre'], $param['uspass'], $param['usmail'], $usdeshabilitado);
        }
        return $obj;
    }
    

     /**
      * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves
      * @param array $param
      * @return Usuario
      */
    private function cargarObjetoConClave($param) {
        $obj = null;
        if ($this->seteadosCamposClaves($param)) {
            $obj = new Usuario();
            $obj->cargarDatos($param['idusuario']);
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
        if (isset($param['idusuario'])) {
            $resp = true;
        }
        return $resp;
    }

    /**
     * Inserta un usuario a la BD con atributos del arreglo ingresado
     * @param array $param
     * @return boolean
     */
    public function alta($param) {
        $resp = false;
    
        if (!array_key_exists('idusuario', $param)) {
            $usuario = $this->cargarObjeto($param);
            if ($usuario != null && $usuario->insertar()) {
                $resp = true;
            }
        }
        return $resp;
    }
    

    /**
     * Elimina un usuario de la BD
     * @param array $param
     * @return boolean
     */
    public function baja($param) {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $usuario = $this->cargarObjetoConClave($param);
            if ($usuario != null and $usuario->eliminar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    /**
     * Modificar un usuario de la BD
     * @param array $param
     * @return boolean
     */
    public function modificacion($param) {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $usuario = $this->cargarObjeto($param);
            if ($usuario != null and $usuario->modificar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    /**
     * Busca usuarios en la BD
     * si $param == null, trae todos los usuarios
     * @param array $param
     * @return array
     */
    public function buscar($param = null) {
        $where = " true ";
        if ($param != null) {
            if (isset($param['idusuario'])) {
                $where = "idusuario = " . intval($param['idusuario']); 
            }
            if (isset($param['usnombre'])) {
                $where = "usnombre = '" . $param['usnombre'] . "'"; 
            }
            if (isset($param['uspass'])) {
                $where = "uspass = '" . $param['uspass'] . "'"; 
            }
            if (isset($param['usmail'])) {
                $where = "usmail = '" . $param['usmail'] . "'"; 
            }
            if (isset($param['usdeshabilitado'])) {
                $where = "usdeshabilitado = " . ($param['usdeshabilitado'] ? 1 : 0); // Usamos ternario para convertir booleano a entero
            }
        }
        $arreglo = (new Usuario())->listar($where);
        return $arreglo;
    }
    
}