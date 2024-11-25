<?php
    //Verificacion de sesion valida (para mostrar pagina segura)
    $sesion = new Session();
    $sesionValida = $sesion->validar();
    $menues = []; //Array con menues permitidos para rol actual
    $compraEstado = null;

    if ($sesionValida) {
        $usuario = $sesion->getUsuario();
        $objRol = $sesion->getRoles()[0];
        $menuRoles = (new ABMMenuRol())->buscar(['rol'=> $objRol]); // [objMenuRol($objmenu, $objrol),objMenuRol($objmenu2, $objrol),...]

        // Obtiene menues para dicho rol
        foreach($menuRoles as $menuRol) {
            array_push($menues, ($menuRol->getObjMenu()));
        }
        foreach($menues as $menu) { //Busca menues hijos y los agrega al array de menues
            $hijos = (new ABMMenu())->buscar(['padre' => $menu]);
            $menues = array_merge($menues, $hijos);
        }

        // Verifica que pagina actual este permitida por menues obtenidos (DIFERENCIA CON Head.php)
        $menuesFiltrados = array_filter($menues, function ($menu) {
            return (BASE_URL.$menu->getMeurl()) == CURRENT_URL;
        });
    
        if (empty($menuesFiltrados)) {
            // Si no tiene menu permitido, redirige
            header("Location: ".BASE_URL."/View/Pages/SesionInvalida/SesionInvalida.php");
            exit();
        }

        // Crea compra en estadotipo 1 (carrito) si no lo tiene, (SOLO PARA CLIENTES)
        if ($sesion->esCliente()) { //Si es cliente (idrol = 3)
            $compras = (new ABMCompra())->buscar(['usuario'=> $usuario]);
            $compraEstadoTipos = (new ABMCompraEstadoTipo())->buscar(['idcompraestadotipo' => 1]); //Busca estadotipo 1 (carrito)

            $encontrado = false;
            $i = 0;
            while (!$encontrado && $i < count($compras)) {
                $compraEstados = (new ABMCompraEstado())->buscar(['objCompra'=> $compras[$i], 'objCompraEstadoTipo' => $compraEstadoTipos[0], 'cefechafin' => null]); //compraEstado de la compra (carrito)
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
                    $compraEstado = (new ABMCompraEstado())->buscar(['objCompra'=> $compras[0], 'cefechafin' => null]); //Toda compraEstado de la bd
                }
            }
        }
    } else { //Redirige a pagina no segura (DIFERENCIA CON Head.php)
        header("Location: ".BASE_URL."/View/Pages/SesionInvalida/SesionInvalida.php");
        exit();
    }

    

    // Opciones a mostrar en header (dinamicamente)
    $menuHtml = "<div class='mx-3'>
        <a class='btn btn-primary btn-steam m-1' href='".BASE_URL."/View/Pages/Catalogo/Catalogo.php'> Catalogo </a>";
    
    foreach ($menues as $cadaMenu) {
        if ($cadaMenu->getPadre() != null) {
            $menuHtml .= "<a class='btn btn-primary btn-steam m-1' href='".BASE_URL.$cadaMenu->getMeurl()."'> ".$cadaMenu->getMenombre()." </a>";
        }
    }

    $menuHtml .= "</div>
        <div class='mx-3'>";

    if ($sesionValida) { 
        $menuHtml .=  "<a class='btn btn-primary btn-steam my-1' href='".BASE_URL."/View/Pages/Perfil/Perfil.php'>".$usuario->getUsnombre()."</a>
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
