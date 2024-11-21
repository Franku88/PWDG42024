<?php
include_once '../../../configuracion.php';
$session = new Session();
$sessionValida = $session->validar();
if ($sessionValida) {
    $usuarioRolId = $session->getRol()[0]->getIdrol();
} else {
    $usuarioRolId = 0;
}
// $usuarioRolId = $session->getRol()[0]->getIdrol();

// echo '<pre>';
// // print_r($usuarioRolId);
// echo '</pre>';


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



</head>

<body class="d-flex flex-column min-vh-100 bg-steam-darkgreen"> <!-- Comienza body saludos YT!-->
    <header>
        <!-- Barra de navegación -->
        <nav class="navbar navbar-expand-sm bg-steam-lightgreen bdr-steam-nofocus justify-content-between">
            <div class="mx-2 my-1">
                <a class="btn btn-primary btn-steam3 mx-2" href="<?php echo BASE_URL; ?>/index.php">Inicio</a> <!-- Index button -->
            </div>
            <div class="mx-3">
                <a class="btn btn-primary btn-steam my-1" href="<?php echo BASE_URL; ?>/View/Ejercicios/Tienda/Tienda.php"> Tienda </a>
                <?php if ($sessionValida) { ?>
                    <a class="btn btn-primary btn-steam my-1" href="<?php echo BASE_URL; ?>/View/Ejercicios/LogOut/LogOut.php">Logout</a>
                <?php } else { ?>
                    <a class="btn btn-primary btn-steam my-1" href="<?php echo BASE_URL; ?>/View/Ejercicios/Login/Login.php">Login</a>
                    <a class="btn btn-primary btn-steam my-1" href="<?php echo BASE_URL; ?>/View/Ejercicios/Register/Register.php">Register</a>
                <?php } ?>


                <?php if ($usuarioRolId == 1) { ?>
                    <a class="btn btn-primary btn-steam my-1" href="<?php echo BASE_URL; ?>/View/Ejercicios/ABMUsuario/ABMUsuario.php">Carrito</a>
                    <a class="btn btn-primary btn-steam my-1" href="<?php echo BASE_URL; ?>/View/Ejercicios/ABMUsuarioRol/ABMUsuarioRol.php">Perfil?</a>
                <?php } ?>
                <?php if ($usuarioRolId == 2) { ?>
                    <a class="btn btn-primary btn-steam my-1" href="<?php echo BASE_URL; ?>/View/Ejercicios/ABMUsuario/ABMUsuario.php">Deposito</a>
                    <a class="btn btn-primary btn-steam my-1" href="<?php echo BASE_URL; ?>/View/Ejercicios/ABMUsuarioRol/ABMUsuarioRol.php">Perfil?</a>
                <?php } ?>
                <?php if ($usuarioRolId == 3) { ?>
                    <a class="btn btn-primary btn-steam my-1" href="<?php echo BASE_URL; ?>/View/Ejercicios/ABMUsuario/ABMUsuario.php">Administrar Usuarios</a>
                    <a class="btn btn-primary btn-steam my-1" href="<?php echo BASE_URL; ?>/View/Ejercicios/ABMUsuario/ABMUsuario.php">Administrar Compras</a>
                    <a class="btn btn-primary btn-steam my-1" href="<?php echo BASE_URL; ?>/View/Ejercicios/ABMUsuarioRol/ABMUsuarioRol.php">Perfil?</a>
                <?php } ?>

            </div>
        </nav>
    </header>