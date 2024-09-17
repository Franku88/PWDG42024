<?php
class BaseDatos extends PDO {
  
    private $engine;
    private $host;
    private $database;
    private $user;
    private $pass;
  	private $debug;
  	private $conected;
  	private $indice;
  	private $resultado;
    private $error;
    private $sql;
    
    public function __construct() {
        $this->engine = 'mysql';
        $this->host = 'localhost';
        $this->database = 'infoautos';
        $this->user = 'root';
        $this->pass = '';
        
        $this->debug = true;
        $this->error = "";
        $this->sql = "";
        $this->indice = 0;
        $this->conected = false;
        
        $dns = $this->engine.':dbname='.$this->database.";host=".$this->host;
        try {
            parent::__construct($dns, $this->user, $this->pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
            $this->conected = true;
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
        }
    }
    
    /**
     * Solo llama al metodo $this->getConected()
     * Metodo implementado para mantener transparencia con clase BaseDatos que no extiende PDO
     */
    public function Iniciar() {
        return $this->getConected();
    }

    public function getConected() {
        return $this->conected;
    }
    
    public function setDebug($debug) {
        $this->debug = $debug;
    }
    
    public function getDebug() {
        return $this->debug;
    }
  
    public function setError($e) {
        $this->error = $e;
    }
        
    public function getError() {
        return "\n".$this->error; 
    }
    
    public function setSQL($e) {
        return "\n".$this->sql = $e;
    }
    
    public function getSQL() {
        return "\n".$this->sql;
    }

    private function setIndice($valor) {
        $this->indice = $valor;
    }
    
    private function getIndice() {
        return $this->indice;   
    }
 
    private function setResultado($valor) {
        $this->resultado = $valor;    
    }
 
    private function getResultado() {
        return $this->resultado;
    }
    
    /**
     * Realiza la consulta $sql por parametro a la bd
     * @return integer 
     */
    public function Ejecutar($sql) {
        $this->setError("");
        $this->setSQL($sql); //Para mantener ultimo sql ejecutado
        if (stristr($sql, "insert")) { // se desea INSERT ? 
            $resp =  $this->EjecutarInsert($sql);
        }
        if (stristr($sql, "update") OR stristr($sql,"delete")) { // se desea UPDATE o DELETE ? 
            $resp =  $this->EjecutarDeleteUpdate($sql);
        }
        if (stristr($sql, "select")) { // se desea SELECT
            $resp =  $this->EjecutarSelect($sql);
        }
        return $resp;
   }
   
    /**
     * Si se inserta en una tabla que tiene una columna autoincrement se retorna el id con el que se inserto el registro
     * caso contrario se retorna -1
    */   
    private function EjecutarInsert($sql) {
        $resultado = parent::query($sql);
        if (!$resultado) {
            $this->analizarDebug();
            $id = 0;
        } else {
            $id = $this->lastInsertId(); 
            if ($id == 0) {
                $id = -1;
            }
        }
        return $id;
    }
   
    /**
     * Retorna cantidad de filas afectadas por ejecucion SQL. Si es <0 no se pudo realizar la operacion
     * @return integer 
    */
    private function EjecutarDeleteUpdate($sql) {
        $cantFilas = -1;
        $resultado = parent::query($sql);
        if (!$resultado) {
            $this->analizarDebug();
        } else {
            $cantFilas = $resultado->rowCount();
        }
        return $cantFilas;
    }
   
    /**
     * Retorna cantidad de registros de una consulta select
     * @return integer
    */   
    private function EjecutarSelect($sql) {
        $cant = -1;
        $resultado = parent::query($sql);
        if (!$resultado) {
            $this->analizarDebug();
        } else {
            $this->setResultado($resultado->fetchAll());
            $this->setIndice(0);
            $cant = count($this->getResultado());
        }
        //echo " La cantidad de registros es ".$cant; //Debug
        return $cant;
   }
   
   /**
    * Devuelve un registro retornado por la ejecucion de una consulta
    * el puntero se despleza al siguiente registro de la consulta
    * @return array
    */ 
    public function Registro() {
        $filaActual = false;
        $indiceActual = $this->getIndice();
        if ($indiceActual >= 0) {
            $filas = $this->getResultado();
            if($indiceActual < count($filas)) {
                $filaActual = $filas[$indiceActual]; 
                $this->setIndice(($indiceActual+1));
            } else {
                $this->setIndice(-1);
            }  
        }
        //echo " El valor de fila actual es:"; //Debug
        //print_r($filaActual); //Debug
        return $filaActual;
   }
   
    /**
     * Visualiza el debug si esta seteado la variable instancia $this->debug 
    */
    private function analizarDebug() {
        $e = $this->errorInfo();
        $this->setError($e);
        if($this->getDebug()) {
            echo "<pre>";
            print_r($e);
            echo "</pre>";
        }
    }
}