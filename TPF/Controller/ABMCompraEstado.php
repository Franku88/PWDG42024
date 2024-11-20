<?php 

class ABMCompraEstado {
    //['objCompra' => $objCompra, 'objCompraEstadoTipo' => $objCompraEstadoTipo, 'cefechaini' => $cefechaini, 'cefechafin' => $cefechafin]
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden
     * con los nombres de las variables instancias del objeto
     * @param array $param
     * @return CompraEstado
     */

    private function cargarObjeto($param) {
        $obj = null;
        if (array_key_exists('objCompra' , $param) && array_key_exists('objCompraEstadoTipo' , $param) && array_key_exists('cefechaini' , $param) && array_key_exists('cefechafin' , $param)) {
            $idcompraestado = array_key_exists('idcompraestado', $param) ? $param['idcompraestado'] : null;
            $obj = new CompraEstado();
            $obj->cargarDatos($idcompraestado, $param['objCompra'], $param['objCompraEstadoTipo'], $param['cefechaini'], $param['cefechafin']);
        }
        return $obj;
    }

    /**
     * Corrrobora que dentro del arreglo asociativo esten seteados los campos claves
     * @param array $param
     * @return boolean
     */
    private function seteadosCamposClaves($param) {
        $resp = false;
        if (isset($param['idcompraestado'])) {
            $resp = true;
        }
        return $resp;
    }

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden
     * con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return CompraEstado
     */
    private function cargarObjetoConClave($param) {
        $obj = null;
        if ($this->seteadosCamposClaves($param)) {
            $obj = new CompraEstado();
            $obj->cargarDatos($param['idcompraestado']);
        }
        return $obj;
    }

    /**
     * Inserta un compraestado a la BD con atributos del arreglo ingresado
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
     * Elimina un compraestado de la BD con atributos del arreglo ingresado
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
     * Modifica un compraestado de la BD con atributos del arreglo ingresado
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
     * Busca un compraestado en la BD 
     * Si $param es vacio, trae todos los compraestados 
     * @param array $param
     * @return array
     */

    public function buscar($param = null) {
        $where = " true ";
        if ($param != null) {
            if (isset($param['idcompraestado'])) {
                $where .= " and idcompraestado = ".$param['idcompraestado'];
            }
            if (isset($param['idcompra'])) {
                $where .= " and idcompra = ".$param['idcompra'];
            }
            if (isset($param['idcompraestadotipo'])) {
                $where .= " and idcompraestadotipo = ".$param['idcompraestadotipo'];
            }
            if (isset($param['cefechaini'])) {
                $where .= " and cefechaini = ".$param['cefechaini'];
            }
            if (isset($param['cefechafin'])) {
                $where .= " and cefechafin = ".$param['cefechafin'];
            }
        }
        $arreglo = (new CompraEstado())->listar($where);
        return $arreglo;
    }


}