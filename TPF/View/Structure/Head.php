<?php
    //Verificacion de sesion valida (para mostrar pagina segura)
    $sesion = new Session();
    $sesionValida = $sesion->validar();
    $menues = []; //Array con menues permitidos para rol actual
    $compraEstado = null;

    if ($sesionValida) {
        $usuario = $sesion->getUsuario(); //Se usara en scripts que llamen a este head
        $compraEstado = $sesion->crearCarrito(); //Obtiene compraEstado del carrito actual (si no lo tiene, lo crea)
        $menues = $sesion->getMenues(); //Obtiene menues para el usuario actual
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

