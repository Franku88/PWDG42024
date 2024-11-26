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
    public function getRoles() {
        $arreglo = [];
        if ($this->validar()) {
            $usuarios = (new ABMUsuario())->buscar(['idusuario' => $_SESSION['idusuario']]);
            if (count($usuarios) > 0) {
                $resultado = (new ABMUsuarioRol())->buscar(['usuario' => $usuarios[0]]);
                if (count($resultado) > 0) {
                    foreach($resultado as $unUsuarioRol) {
                        array_push($arreglo, $unUsuarioRol->getObjRol());
                    }
                }
            }
        } 
        return $arreglo;
    }

    /**
     * Devuelve verdadero si un usuario es cliente (VERIFICAR QUE ID TIENE EL ROL CLIENTE EN LA BD)
     */
    public function esCliente() {
        $roles = $this->getRoles();
        $i = 0;
        $encontrado = false;;
        while (!$encontrado && $i < count($roles)) {
            $encontrado = $roles[$i]->getIdrol() == 3; //En este caso 3 es el id del rol cliente
            $i++;
        }
        return $encontrado;
    }

    /**
     * Crea carrito (compra con estado tipo 1) si fuese el caso
     * retorna $compraEstado del carrito
     */
    public function crearCarrito() {
        $compraEstado = null;
        if ($this->validar()) {
            // Crea compra en estadotipo 1 (carrito) si no lo tiene, (SOLO PARA CLIENTES)
            if ($this->esCliente()) { //Si es cliente (idrol = 3)
                $usuario = $this->getUsuario();
                $compras = (new ABMCompra())->buscar(['usuario'=> $usuario]);
                $compraEstadoTipos = (new ABMCompraEstadoTipo())->buscar(['idcompraestadotipo' => 1]); //Busca estadotipo 1 (carrito)

                $encontrado = false;
                $i = 0;
                while (!$encontrado && $i < count($compras)) {
                    $compraEstados = (new ABMCompraEstado())->buscar(['objCompra'=> $compras[$i], 'objCompraEstadoTipo' => $compraEstadoTipos[0], 'cefechafin' => "null"]); //compraEstado de la compra (carrito)
                    $encontrado = !empty($compraEstados);
                    $i++;
                }

                if ($encontrado) {
                    $compraEstado = $compraEstados[0];
                }
                
                if ($compraEstado == null) {
                    $param['cofecha'] = (new DateTime('now', (new DateTimeZone('-03:00'))))->format('Y-m-d H:i:s');
                    $param['usuario'] = $usuario;
        
                    if ((new ABMCompra())->alta($param)) {
                        $compras = (new ABMCompra())->buscar(['usuario'=> $usuario, 'cofecha' => $param['cofecha']]);
                        $compraEstado = (new ABMCompraEstado())->buscar(['objCompra'=> $compras[0], 'cefechafin' => "null"]); //Toda compraEstado de la bd
                    }
                }
            }
        }
        return $compraEstado;
    }

    /**
     * Obtiene todos los menues para el usuario actual segun su rol
     * Retorna un array
     */
    public function getMenues() {
        $menues = [];
        if ($this->validar()) {
            $objRol = $this->getRoles()[0];
            $menuRoles = (new ABMMenuRol())->buscar(['rol'=> $objRol]); // [objMenuRol($objmenu, $objrol),objMenuRol($objmenu2, $objrol),...]

            // Obtiene menues para dicho rol
            foreach($menuRoles as $menuRol) {
                array_push($menues, ($menuRol->getObjMenu()));
            }
            foreach($menues as $menu) { //Busca menues hijos y los agrega al array de menues
                $hijos = (new ABMMenu())->buscar(['padre' => $menu]);
                $menues = array_merge($menues, $hijos);
            }
        }
        return $menues;
    }

    /**
     * Verifica si la pagina actual puede ser mostrada
     * Retorna un booleano
     */
    public function validarPagina($menues = []) {
        // Verifica que pagina actual este permitida por menues obtenidos (DIFERENCIA CON Head.php)
        $menuesFiltrados = array_filter($menues, function ($menu) {
            return (BASE_URL.$menu->getMeurl()) == CURRENT_URL;
        });
        //Si no esta vacio, entonces encontro la pagina actual en sus posibles menues
        return !empty($menuesFiltrados);
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