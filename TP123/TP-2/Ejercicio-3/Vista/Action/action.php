<?php 

require_once '../../Controlador/controlador.php';
require_once '../../Utils/funciones.php';

$usuarios = [
    ['user' => 'Juanceto01', 'password' => 'admin1234'],
    ['user' => 'Marcelo01', 'password' => 'admin2345'],
    ['user' => 'Agustin01', 'password' => 'admin3567'],
    ['user' => 'carlos01', 'password' => 'admin4'],
    ['user' => 'Julian01', 'password' => 'admin5'],
];

$data = datosSubmitted();

$controlador = new Controlador();
$usuario = $controlador->validarUsuario($data, $usuarios);
$usuarioValido = false;

if ($usuario[0]) {
    $usuarioValido = 'Bienvenido';
} else {
    $usuarioValido = 'Usuario o contraseña incorrectos';
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Action</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="d-flex justify-content-center align-items-center vh-100">
    <div class="text-center">
        <h1><?php echo $usuarioValido; ?></h1>
        <a href="../index.php" class="btn btn-success mt-3">Volver</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
