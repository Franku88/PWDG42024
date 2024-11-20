<?php

class ABMCompra {
    
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden 
     * con los nombres de las variables instancias del objeto
     * @param array $param
     * @return Compra
     */
    private function cargarObjeto($param) {
        // ['cofecha' => $cofecha, 'usuario' => $usuario] idcompra es AUTO_INCREMENT
        $obj = null;
        if (array_key_exists('usuario', $param)) {
            $idcompra = array_key_exists('idcompra', $param) ? $param['idcompra'] : null;
            $cofecha = array_key_exists('cofecha', $param) ? $param['cofecha'] : null;
            $obj = new Compra();
            $obj->cargarDatos($idcompra, $cofecha, $param['usuario']);
        }
        return $obj;
    }

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden 
     * con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return Compra
     */
    private function cargarObjetoConClave($param) {
        $obj = null;
        if ($this->seteadosCamposClaves($param)) {
            $obj = new Compra();
            $obj->cargarDatos($param['idcompra']);
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
        if (isset($param['idcompra'])) {
            $resp = true;
        }
        return $resp;
    }

    /**
     * Inserta una compra a la BD con atributos del arreglo ingresado
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
     * Elimina una compra de la BD
     * @param array $param
     * @return boolean
     */
    public function baja($param) {
        $resp = false;
        // buscamos la compra y cargamos los datos
        if ($this->seteadosCamposClaves($param)) {
            $obj = $this->cargarObjetoConClave($param);
            if ($obj != null AND $obj->eliminar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    /**
     * Modifica una compra de la BD
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
     * Busca compras en la BD
     * Si $param es vacío, trae todos las compras
     * @param array $param
     * @return array
     */
    public function buscar($param = null) {
        $where = " true ";
        if ($param != null) {
            if (isset($param['idcompra'])) {
                $where .= " AND idcompra = '".$param['idcompra']."'";
            }
            if (isset($param['cofecha'])) {
                $where .= " AND cofecha = '".$param['cofecha']."'";
            }
            if (isset($param['usuario'])) {
                $where .= " AND idusuario = '".($param['usuario'])->getIdusuario()."'";
            }
        }
        $arreglo = (new Compra())->listar($where);
        return $arreglo;
    }
}