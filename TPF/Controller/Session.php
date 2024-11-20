<?php 


include_once '/Applications/XAMPP/xamppfiles/htdocs/PWDG42024/TPF/Controller/ABMUsuario.php';
include_once '/Applications/XAMPP/xamppfiles/htdocs/PWDG42024/TPF/Controller/ABMUsuarioRol.php';
include_once '/Applications/XAMPP/xamppfiles/htdocs/PWDG42024/TPF/Controller/ABMRol.php';


class Session {

    public function __construct()
    {
        session_start();
    }

    /**
     * Actualiza las variables de sesión con los valores ingresados.
     * @param string $nombreUsuario
     * @param string $psw
     * @return bool
     */
    public function iniciar($nombreusuario, $psw) {
        $resp = false;
        $obj = new ABMUsuario();
        $param['usnombre'] = $nombreusuario;
        // buscamos el usuario en la base de datos (por $nombreusuario)
        $resultado = $obj->buscar($param);
        if (count($resultado) > 0) {
            $usuario = $resultado[0];
            $_SESSION['idusuario'] = $usuario->getIdusuario();
            $resp = true;
        } else {
            $this->cerrar();
        }
        return $resp;
    }
    /**
     * Cierra la session.
     */
    public function cerrar() {
        $resp = false;
        if ($this->activa()) {
            session_destroy();
            $resp = true;
        }
        return $resp;
    }
    /**
     * Devuelve true o false si la sesión está activa o no
     */
    public function activa() {
        $resp = false;
        if (version_compare(phpversion(), '5.4.0', '>=')) {
            $resp = session_status() === PHP_SESSION_ACTIVE ? true : false;
        } else {
            $resp = session_id() !== '' ? true : false;
        }
        return $resp;
    }

    /**
     * Valida si la sesión actual tiene usuario y psw válidos. Devuelve true o false.
     */
    public function validar() {
        $resp = false;
        if ($this->activa() && isset($_SESSION['idusuario'])) {
            $resp = true;
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
            $param['idusuario'] = $_SESSION['idusuario']; // iguala el idusuario de la session con el idusuario 
            $resultado = $obj->buscar($param);
            if (count($resultado) > 0) {
                $usuario = $resultado[0];
            }
        }
        return $usuario;
    }

    /**
     * Devuelve el rol del usuario logeado.
     */
    public function getRol() {
        $lista_rol = null;
        if ($this->validar()) {
            $usuarioRol = new ABMUsuarioRol();
            $param['idusuario'] = $_SESSION['idusuario'];
            $resultado = $usuarioRol->buscar($param); // [0] => UsuarioRol Object que contiene [$objUsuario, $objRol]
            if (count($resultado) > 0) {
                // recuperamos el id del rol
                $idrol = $resultado[0]->getObjRol()->getIdrol();
                $rol = new ABMRol();
                $param['idrol'] = $idrol;
                $resultado = $rol->buscar($param);
                if (count($resultado) > 0) {
                    $lista_rol = $resultado[0];
                }
            }
        }
        return $lista_rol;
    }
}