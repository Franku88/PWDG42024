<?php
    //Verificacion de sesion valida (para mostrar pagina segura)
    $sesion = new Session();
    $sesionValida = $sesion->validar();
    $menues = []; //Array con menues permitidos para rol actual

    if ($sesionValida) {
        $objRol = $sesion->getRoles()[0];
        $menuRoles = (new ABMMenuRol())->buscar(['rol'=> $objRol]); // [objMenuRol($objmenu, $objrol),objMenuRol($objmenu2, $objrol),...]

        foreach($menuRoles as $menuRol) {
            array_push($menues, ($menuRol->getObjMenu()));
        }
        foreach($menues as $menu) { //Busca menues hijos y los agrega al array de menues
            $hijos = (new ABMMenu())->buscar(['padre' => $menu]);
            $menues = array_merge($menues, $hijos);
        }

        // Crea compra en estadotipo 1 (carrito) si no lo tiene, (SOLO PARA CLIENTES)
        if ($sesion->esCliente()) { //Si es cliente (idrol = 3)
            $usuario = $sesion->getUsuario();
    
            $compras = (new ABMCompra())->buscar(['usuario'=> $usuario]);
            $compraEstados = (new ABMCompraEstado)->buscar(['idcompraestadotipo' => 1, 'cefechafin' => null]); //Toda compraEstado de la bd
            
            $i = 0;
            $j = 0;
            $encontrado = false;
            $compraEstado = null;
            while (!$encontrado && ($i < count($compraEstados))) {
                while (!$encontrado && ($j < count($compras))) {
                    $encontrado = ($compraEstados[$i]->getObjCompra()->getIdcompra()) == ($compras[$j]->getIdcompra());
                    if ($encontrado) {
                        $compraEstado = $compraEstados[$i];
                    }
                    $j++;
                }
                $j = 0;
                $i++;
            }
            
            if ($compraEstado == null) {
                $param1['cofecha'] = (new DateTime('now', (new DateTimeZone('-03:00'))))->format('Y-m-d H:i:s');
                $param1['usuario'] = $sesion->getUsuario();
                $altaCompra = (new ABMCompra())->alta($param1);
    
                if ($altaCompra) {
                    $compras = (new ABMCompra)->buscar(['usuario'=> $param1['usuario'], 'cofecha' => $param1['cofecha']]);
                    $compraEstadoTipos = (new ABMCompraEstadoTipo())->buscar(['idcompraestadotipo'=> 1]);
    
                    $altaCompraEstado = (new ABMCompraEstado())->alta([
                        'objCompra'=> $compras[0], 
                        'objCompraEstadoTipo'=> $compraEstadoTipos[0], 
                        'cefechaini' => $compras[0]->getCofecha()]
                    );
    
                    $compraEstado = (new ABMCompraEstado)->buscar(['objCompra'=> $compras[0], 'idcompraestadotipo' => 1, 'cefechafin' => null]); //Toda compraEstado de la bd
                }
            }   
        }
    }

    // Opciones a mostrar en header (dinamicamente)
    $menuHtml = "<div class='mx-3'>
        <a class='btn btn-primary btn-steam my-1' href='".BASE_URL."/View/Pages/Catalogo/Catalogo.php'> Catalogo </a>";
    
    foreach ($menues as $cadaMenu) {
        if ($cadaMenu->getPadre() != null) {
            $menuHtml .= "<a class='btn btn-primary btn-steam my-1' href='".BASE_URL.$cadaMenu->getMeurl()."'> ".$cadaMenu->getMenombre()." </a>";
        }
    }

    $menuHtml .= "</div>
        <div class='mx-3'>";

    if ($sesionValida) { 
        $menuHtml .=  "<a class='btn btn-primary btn-steam my-1' href='".BASE_URL."/View/Pages/Perfil/Perfil.php'>Perfil</a>
        <a class='btn btn-primary btn-steam my-1' href='".BASE_URL."/View/Pages/Logout/Logout.php'>Logout</a>";
    } else { 
        $menuHtml .= "<a class='btn btn-primary btn-steam my-1' href='".BASE_URL."/View/Pages/Login/Login.php'>Login</a>
        <a class='btn btn-primary btn-steam my-1' href='".BASE_URL."/View/Pages/Register/Register.php'>Register</a>";
    }
    $menuHtml .= "</div>";
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Programacion Web Dinamica 2024</title>
    <!-- Links a librerias -->

    <!-- CSS -->
    <!-- Bootstrap -->
    <link href="<?php echo BASE_URL; ?>/View/Assets/css/bootstrap/bootstrap.min.css" rel="stylesheet">

    <!-- EasyUI -->
    <link href="<?php echo BASE_URL; ?>/View/Assets/js/jquery-easyui-1.11.0/themes/bootstrap/easyui.css" rel="stylesheet">

    <!-- Estilos propios -->
    <link href="<?php echo BASE_URL; ?>/View/Assets/css/styles.css" rel="stylesheet">

    <!-- JS -->
    <!-- Bootstrap -->
    <script src="<?php echo BASE_URL; ?>/View/Assets/js/bootstrap/bootstrap.min.js"></script>
    <script src="<?php echo BASE_URL; ?>/View/Assets/js/bootstrap/bootstrap.bundle.js"></script>

    <!-- jQuery -->
    <script src="<?php echo BASE_URL; ?>/View/Assets/js/jquery-3.7.1.min.js"></script>

    <!-- EasyUI -->
    <script src="<?php echo BASE_URL; ?>/View/Assets/js/jquery-easyui-1.11.0/jquery.easyui.min.js"></script>

    <!-- js-md5 -->
    <script src="<?php echo BASE_URL; ?>/View/Assets/js/md5.min.js"></script>

</head>

<body class="d-flex flex-column min-vh-100 bg-steam-darkgreen"> <!-- Comienza body -->
    <header>
        <!-- Barra de navegación -->
        <nav class="navbar navbar-expand-sm bg-steam-lightgreen bdr-steam-nofocus justify-content-between">

            <div class="d-flex mx-1">
                <a class=" text-decoration-none" href="<?php echo BASE_URL; ?>/index.php"> <!-- Index button -->
                    <div class='d-flex'>
                        <img src="<?php echo(BASE_URL);?>/View/Media/Site/logo.png" height="50" width="50"> </img>
                        <h5 class='text-black my-auto mx-2 b'> <strong> Black Mesa&reg;</strong></h6>
                    </div>
                </a>
            </div>
            
            <?php echo $menuHtml?>
            
        </nav>
    </header>

