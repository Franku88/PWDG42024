<?php
// include ROOT_PATH.'/Model/Auto.php'; Lo carga el autoloader.php

class ABMAuto{
    
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden 
     * con los nombres de las variables instancias del objeto
     * @param array $param
     * @return Auto
     */
    private function cargarObjeto($param) {
        $obj = null;
        if(array_key_exists('Patente', $param) AND array_key_exists('Marca', $param) AND
            array_key_exists('Modelo', $param) AND array_key_exists('Duenio', $param)) {
                $obj = new Auto();
                $obj->cargarDatos($param['Patente'], $param['Marca'], $param['Modelo'], $param['Duenio']);
        }
        return $obj;
    }
    
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden
     * con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return Auto
     */
    private function cargarObjetoConClave($param) {
        $obj = null;
        if($this->seteadosCamposClaves($param)) {
            $obj = new Auto();
            $obj->cargarDatos($param['Patente']);
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
        if (isset($param['Patente'])) {
            $resp = true;
        }
        return $resp;
    }
    
    /**
     * Inserta un auto a la BD con atributos del arreglo ingresado
     * @param array $param
     * @return boolean
     */
    public function alta($param) {
        $resp = false;
        //$param['Patente'] = null; //Necesario si tiene ID autoincremental?
        $auto = $this->cargarObjeto($param);
        //verEstructura($persona);
        if ($auto != null AND $auto->insertar()) {
            $resp = true;
        }
        return $resp;
        
    }
    
    /**
     * Elimina auto de la BD 
     * @param array $param
     * @return boolean
     */
    public function baja($param) {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $auto = $this->cargarObjetoConClave($param);
            if ($auto != null AND $auto->eliminar()) {
                $resp = true;
            }
        }
        return $resp;
    }
    
    /**
     * Modificar un auto de la BD
     * @param array $param
     * @return boolean
     */
    public function modificacion($param) {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $auto = $this->cargarObjeto($param);
            if($auto != null AND $auto->modificar()) {
                $resp = true;
            }
        }
        return $resp;
    }
    
    /**
     * Busca autos con atributos de $param, retorna un arreglo
     * Si $param == null, retorna todo auto en la BD
     * @param array $param
     * @return array
     */
    public function buscar($param = null){
        $where = " true ";
        if ($param != null){
            if  (isset($param['Patente'])) {
                $where .= " AND Patente ='".$param['Patente']."'";
            }   
            if  (isset($param['Marca'])) {
                $where .= " AND Marca ='".$param['Marca']."'";
            }
            if  (isset($param['Modelo'])) {
                $where .= " AND Modelo =".$param['Modelo'];
            }
            if  (isset($param['Duenio'])) {
                $where .= " AND DniDuenio ='".($param['Duenio'])->getNroDni()."'";
            }
        }
        $arreglo = (new Auto())->listar($where);
        return $arreglo;
    }

    public function generarVehiculo() {
        $customFaker = new CustomFaker();
        $vehiculo = $customFaker->vehiculo();
        return $vehiculo;
    }
}
?>