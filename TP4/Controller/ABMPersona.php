<?php
// include ROOT_PATH.'/Model/Persona.php'; Lo carga el autoloader.php

class ABMPersona{
    
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden 
     * con los nombres de las variables instancias del objeto
     * @param array $param
     * @return Persona
     */
    private function cargarObjeto($param) {
        $obj = null;
        if(array_key_exists('NroDni', $param) AND array_key_exists('Apellido', $param) AND
            array_key_exists('Nombre', $param) AND array_key_exists('fechaNac', $param) AND
            array_key_exists('Telefono', $param) AND array_key_exists('Domicilio', $param)) {
                $obj = new Persona();
                $obj->cargarDatos($param['NroDni'], $param['Apellido'], $param['Nombre'], $param['fechaNac'], $param['Telefono'], $param['Domicilio']);
        }
        return $obj;
    }
    
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden
     * con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return Persona
     */
    private function cargarObjetoConClave($param) {
        $obj = null;
        if($this->seteadosCamposClaves($param)) {
            $obj = new Persona();
            $obj->cargarDatos($param['NroDni']);
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
        if (isset($param['NroDni'])) {
            $resp = true;
        }
        return $resp;
    }
    
    /**
     * Inserta una persona a la BD con atributos del arreglo ingresado
     * @param array $param
     * @return boolean
     */
    public function alta($param) {
        $resp = false;
        //$param['NroDni'] = null; //Necesario si tiene ID autoincremental?
        $persona = $this->cargarObjeto($param);
        //verEstructura($persona);
        if ($persona != null AND $persona->insertar()) {
            $resp = true;
        }
        return $resp;
        
    }
    
    /**
     * Elimina persona de la BD 
     * @param array $param
     * @return boolean
     */
    public function baja($param) {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $persona = $this->cargarObjetoConClave($param);
            if ($persona != null AND $persona->eliminar()) {
                $resp = true;
            }
        }
        return $resp;
    }
    
    /**
     * Modificar una persona de la BD
     * @param array $param
     * @return boolean
     */
    public function modificacion($param) {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $persona = $this->cargarObjeto($param);
            if($persona != null AND $persona->modificar()) {
                $resp = true;
            }
        }
        return $resp;
    }
    
    /**
     * Busca personas con atributos de $param, retorna un arreglo
     * Si $param == null, retorna toda persona en la BD
     * @param array $param
     * @return array
     */
    public function buscar($param = null){
        $where = " true ";
        if ($param != null) {
            if  (isset($param['NroDni'])) {
                $where .= " AND NroDni ='".$param['NroDni']."'";
            }   
            if  (isset($param['Apellido'])) {
                $where .= " AND Apellido ='".$param['Apellido']."'";
            }
            if  (isset($param['Nombre'])) {
                $where .= " AND Nombre ='".$param['Nombre']."'";
            }
            if  (isset($param['fechaNac'])) {
                $where .= " AND fechaNac ='".$param['fechaNac']."'";
            }
            if  (isset($param['Telefono'])) {
                $where .= " AND Telefono ='".$param['Telefono']."'";
            }
            if  (isset($param['Domicilio'])) {
                $where .= " AND Domicilio ='".$param['Domicilio']."'";
            }
        }
        $arreglo = (new Persona())->listar($where);
        return $arreglo;
    }
}
?>