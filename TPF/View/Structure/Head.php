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

    <body class="d-flex flex-column min-vh-100"> <!-- Comienza body -->
        <header>
            <!-- Barra de navegación -->
            <nav class="navbar navbar-expand-sm contenedor-inactivo-steam justify-content-between">
            <div class="mx-2 my-1">
                <a class="btn btn-primary btn-steam3 mx-2" href="<?php echo BASE_URL; ?>/index.php">Inicio</a> <!-- Index button -->
            </div>
                <div class="mx-3">
                    <a class="btn btn-primary btn-steam my-1" href="<?php echo BASE_URL ;?>/View/Ejercicios/Tienda/Tienda.php"> Tienda </a>
                    <a class="btn btn-primary btn-steam my-1" href="<?php echo BASE_URL ;?>/View/Ejercicios/">Iniciar sesión</a>
                    <a class="btn btn-primary btn-steam my-1" href="<?php echo BASE_URL ;?>/View/Ejercicios/">Registrarse</a>
                </div>
            </nav>

        </header>
