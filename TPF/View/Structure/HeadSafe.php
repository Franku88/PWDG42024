<?php
    //Verificacion de sesion valida (para mostrar pagina segura)
    $session = new Session();
    $sessionValida = $session->validar();
    if ($sessionValida) {
        $objRol = $session->getRol()[0];
        $usuarioRolId = $objRol->getIdrol();
        
        $menuRoles = (new ABMMenuRol())->buscar(['rol'=> $objRol]); // [objMenuRol($objmenu, $objrol),objMenuRol($objmenu2, $objrol),...]

        $menues = []; //Array con menues permitidos para dicho rol
        foreach($menuRoles as $menuRol) {
            array_push($menues, ($menuRol->getObjMenu()));
        }

        foreach($menues as $menu) { //Busca menues hijos y los agrega al array de menues
            $hijos = (new ABMMenu())->buscar(['padre' => $menu]);
            $menues = array_merge($menues, $hijos);
        }
    }
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

<body class="d-flex flex-column min-vh-100 bg-steam-darkgreen"> <!-- Comienza body !-->
    <header>
        <!-- Barra de navegación -->
        <nav class="navbar navbar-expand-sm bg-steam-lightgreen bdr-steam-nofocus justify-content-between">
            <div class="mx-2 my-1">
                <a class="btn btn-primary btn-steam3 mx-2" href="<?php echo BASE_URL; ?>/index.php">Inicio</a> <!-- Index button -->
            </div>
            
            <div class="mx-3">
                <a class="btn btn-primary btn-steam my-1" href="<?php echo BASE_URL; ?>/View/Ejercicios/Tienda/Tienda.php"> Tienda </a>
                
                <?php if ($usuarioRolId == 1) { ?>
                    <a class="btn btn-primary btn-steam my-1" href="<?php echo BASE_URL; ?>/View/Ejercicios/AdministrarUsuarios/AdministrarUsuarios.php">Administrar Usuarios</a>
                <?php } ?>

                <?php if ($usuarioRolId == 2) { ?>
                    <a class="btn btn-primary btn-steam my-1" href="<?php echo BASE_URL; ?>/View/Ejercicios/AdministrarProductos/AdministrarProductos.php">Administrar Productos</a>
                    <a class="btn btn-primary btn-steam my-1" href="<?php echo BASE_URL; ?>/View/Ejercicios/AdministrarCompras/AdministrarCompras.php">Administrar Compras</a>
                <?php } ?>

                <?php if ($usuarioRolId == 3) { ?>
                    <a class="btn btn-primary btn-steam my-1" href="<?php echo BASE_URL; ?>/View/Ejercicios/Carrito/Carrito.php">Carrito</a>
                <?php } ?>
            </div>

            <div class="mx-3">
                <?php if ($sessionValida) { ?>
                    <a class="btn btn-primary btn-steam my-1" href="<?php echo BASE_URL; ?>/View/Ejercicios/Perfil/Perfil.php">Perfil?</a>
                    <a class="btn btn-primary btn-steam my-1" href="<?php echo BASE_URL; ?>/View/Ejercicios/Logout/Logout.php">Logout</a>
                <?php } else { ?>
                    <a class="btn btn-primary btn-steam my-1" href="<?php echo BASE_URL; ?>/View/Ejercicios/Login/Login.php">Login</a>
                    <a class="btn btn-primary btn-steam my-1" href="<?php echo BASE_URL; ?>/View/Ejercicios/Register/Register.php">Register</a>
                <?php } ?>
            </div>
            
        </nav>
    </header>
    <?php  
        if (!$sessionValida) {
            echo "Sesión inválida";
            //header("Location: ".ROOT_PATH."/index.php");
            exit();
        }
    ?>