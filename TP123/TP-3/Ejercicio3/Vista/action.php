<?php 
include_once "../Control/controller.php";
include_once "../utils/funciones.php";
// Inicializa una variable para los datos de la película
$peliculaDatos = [];

// Procesar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $datos = darDatosSubmitted();
    $obj = new controller();
    $peliculaDatos = $obj->mostrarDatos($datos);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/bootstrap-5.3.2-dist/css/bootstrap.min.css">
    <title>Document</title>
</head>
<body class="bg-success-subtle">
    
    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($peliculaDatos)): ?>
       <div class="mt-1 p-4 border rounded text-center mb-4">
           <h2>La película introducida es:</h2>
           <p><strong>Título:</strong> <?= htmlspecialchars($peliculaDatos['titulo']) ?></p>
           <p><strong>Actores:</strong> <?= htmlspecialchars($peliculaDatos['actores']) ?></p>
           <p><strong>Director:</strong> <?= htmlspecialchars($peliculaDatos['director']) ?></p>
           <p><strong>Guion:</strong> <?= htmlspecialchars($peliculaDatos['guion']) ?></p>
           <p><strong>Producción:</strong> <?= htmlspecialchars($peliculaDatos['produccion']) ?></p>
           <p><strong>Año:</strong> <?= htmlspecialchars($peliculaDatos['anio']) ?></p>
           <p><strong>Nacionalidad:</strong> <?= htmlspecialchars($peliculaDatos['nacionalidad']) ?></p>
           <p><strong>Género:</strong> <?= htmlspecialchars($peliculaDatos['genero']) ?></p>
           <p><strong>Duración:</strong> <?= htmlspecialchars($peliculaDatos['duracion']) ?> minutos</p>
           <p><strong>Restricciones:</strong> <?= htmlspecialchars($peliculaDatos['restricciones']) ?></p>
           <p><strong>Sinopsis:</strong> <?= htmlspecialchars($peliculaDatos['sinopsis']) ?></p>
           <?php if (!empty($peliculaDatos['imagen']) || $peliculaDatos['errorImagen'] == 0): ?>
           <p><strong>Imagen:</strong></p>
           <img src="<?= htmlspecialchars($peliculaDatos['imagen']) ?>" alt="Imagen de la película" class="img-fluid">
           <?php endif; ?>
       </div>
       <div class="text-center">
           <a href="index.php" class="btn btn-success mb-4">Volver</a> 
       </div>
    <?php endif; ?>
</body>
</html>
