<?php
class Session
{

    public function __construct()
    {
        session_start();
    }

    /**
     * Actualiza las variables de sesión con los valores ingresados.
     */
    public function iniciar($nombreUsuario, $psw)
    {
        $resp = false;
        $obj = new ABMUsuario();
        $param['usnombre'] = $nombreUsuario;
        $param['uspass'] = $psw;
        $param['usdeshabilitado'] = null;

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
     * Valida si la sesión actual tiene usuario y psw válidos. Devuelve true o false.
     */
    public function validar()
    {
        $resp = false;
        if ($this->activa() && isset($_SESSION['idusuario']))
            $resp = true;
        return $resp;
    }

    /**
     *Devuelve true o false si la sesión está activa o no.
     */
    public function activa()
    {
        $resp = false;
        if (version_compare(phpversion(), '5.4.0', '>=')) {
            $resp = session_status() === PHP_SESSION_ACTIVE ? true : false;
        } else {
            $resp = session_id() !== '' ? true : false;
        }
        return $resp;
    }


    /**
     * Devuelve el usuario logeado.
     */
    public function getUsuario()
    {
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
     * Devuelve el rol del usuario logeado.
     */
    public function getRol(){
        $list_rol = null;
        if ($this->validar()) {
            $usuarioRol = new ABMUsuarioRol();
            $param['idusuario'] = $_SESSION['idusuario'];
            $resultado = $usuarioRol->buscar($param);
            if (count($resultado) > 0) {
                $rol = $resultado[0]->getIdrol();
                $rolObj = new Rol();
                $idrol = $rolObj->listar("idrol = $rol");
                $list_rol = $idrol[0]->getRolDescripcion();
            }
        }
        return $list_rol;
    }
    /**
     *Cierra la sesión actual.
     */
    public function cerrar()
    {
        $resp = true;
        session_destroy();
        // $_SESSION['idusuario']=null;
        return $resp;
    }
}
