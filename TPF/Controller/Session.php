<?php

class Session {

    /*
    * Constructor que inicia la sesión.
    */
    public function __construct() {
        session_start();
    }

    /**
     * Actualiza las variables de sesión con los valores ingresados.
     */
    public function iniciar($username, $pass) {
        $resp = false;

        $obj = new ABMUsuario();
        $param['usnombre'] = $username;
        $param['uspass'] = $pass;
        $param['usdeshabilitado'] = null;

        $resultado = $obj->buscar($param);
        if (count($resultado) > 0) {
            $usuario = $resultado[0];
            $_SESSION['idusuario'] = $usuario->getIdusuario(); //Usado en validar, necesario pues session_start() no realiza esta asignacion
            $resp = true;
        } else {
            $this->cerrar();
        }
        return $resp;
    }

    /**
     * Valida si la sesión actual tiene username y pass válidos. Devuelve true o false.
     */
    public function validar() {
        $resp = $this->activa() && isset($_SESSION['idusuario']);
        return $resp;
    }

    /**
     * Devuelve true o false si la sesión está activa o no.
     */
    public function activa() {
        $resp = false;
        if (version_compare(phpversion(), '5.4.0', '>=')) { //No necesario (minimo ser compatible con phpver usado)
            $resp = session_status() === PHP_SESSION_ACTIVE ? true : false;
        } else {
            $resp = session_id() !== '' ? true : false;
        }
        return $resp;
    }

    /**
     * Devuelve el usuario logeado.
     */
    public function getUsuario() {
        $usuario = null;
        if ($this->validar()) {
            $obj = new ABMUsuario();
            $param['idusuario'] = $_SESSION['idusuario'];
            $resultado = $obj->buscar($param);
            if (count($resultado) > 0) {
                $usuario = $resultado[0];
            }
        }
        return $usuario;
    }

    /**
     * Devuelve lista de roles del usuario logeado. Necesario en session por seguridad.
     */
    public function getRol() {
        $list_rol = null;
        if ($this->validar()) {
            $usuarioRol = new ABMUsuarioRol();
            $param['idusuario'] = $_SESSION['idusuario'];
            $resultado = $usuarioRol->buscar($param);
            if (count($resultado) > 0) {
                $i = 0;
                foreach($resultado as $aRol) {
                    $idrol = $aRol->getIdRol();
                    $obj = new Rol();
                    $rol = $obj->listar("idrol = $idrol");
                    $list_rol[$i] = $rol[0];
                    $i++;
                }
            }
        }
        return $list_rol;
    }

    /**
     * Cierra la sesión actual.
     */
    public function cerrar() {
        $resp = session_destroy();
        // $_SESSION['idusuario']=null; //No necesario, anterior sentencia destruye SESSION
        return $resp;
    }
}
?>