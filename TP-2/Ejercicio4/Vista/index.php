<!--Diseñar un formulario que permita cargar las películas de la empresa Cinem@s. La lista géneros 
tiene los siguientes datos: Comedia, Drama, Terror, Románticas, Suspenso, Otras.  
Aplicar Bootstrap y validar los siguiente: 
-  El  año  debe  ser  un  campo  que  debe  permitir  ingresar  como  máximo  4  caracteres  y  solo 
aceptar números. 
- El campo duración debe permitir un máximo de 3 números. 
- Todos los datos son obligatorios 
- Al  hacer  click  en el botón “Enviar”, se deberán mostrar todos los datos ingresados en el 
formulario.  
- El botón “Borrar” debe limpiar el formulario.  -->
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
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../utils/bootstrap-5.3.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Cinem@s</title>
    <script src="../utils/jquery/jquery-3.7.1.min.js"></script>
</head>

<body>
    <div class="container mt-5 p-1">
        <h1 class="text-left mb-4 title-customized">CINEM@S</h1>
        <form id="peliculaForm" action="index.php" method="post" novalidate>
            <!-- Título y Actores -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="titulo" class="form-label">Título</label>
                    <input type="text" name="titulo" id="titulo" class="form-control border-customized" required>
                    <div class="invalid-feedback">
                        Por favor, ingrese el título.
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="actores" class="form-label">Actores</label>
                    <input type="text" name="actores" id="actores" class="form-control border-customized" required>
                    <div class="invalid-feedback">
                        Por favor, ingrese los actores.
                    </div>
                </div>
            </div>

            <!-- Director y Guión -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="director" class="form-label">Director</label>
                    <input type="text" name="director" id="director" class="form-control border-customized" required>
                    <div class="invalid-feedback">
                        Por favor, ingrese el director.
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="guion" class="form-label">Guión</label>
                    <input type="text" name="guion" id="guion" class="form-control border-customized" required>
                    <div class="invalid-feedback">
                        Por favor, ingrese el guión.
                    </div>
                </div>
            </div>

            <!-- Producción y Año -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="produccion" class="form-label">Producción</label>
                    <input type="text" name="produccion" id="produccion" class="form-control border-customized" required>
                    <div class="invalid-feedback">
                        Por favor, ingrese la producción.
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="anio" class="form-label">Año</label>
                    <input type="number" name="anio" id="anio" class="form-control border-customized" required>
                    <div class="invalid-feedback">
                        Ingrese un año válido (4 dígitos).
                    </div>
                </div>
            </div>

            <!-- Nacionalidad y Género -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="nacionalidad" class="form-label">Nacionalidad</label>
                    <input type="text" name="nacionalidad" id="nacionalidad" class="form-control border-customized" required>
                    <div class="invalid-feedback">
                        Por favor, ingrese la nacionalidad.
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="genero" class="form-label">Género</label>
                    <select name="genero" id="genero" class="form-select" required>
                        <option value="">Seleccione un género</option>
                        <option value="Comedia">Comedia</option>
                        <option value="Drama">Drama</option>
                        <option value="Terror">Terror</option>
                        <option value="Romántica">Romántica</option>
                        <option value="Suspenso">Suspenso</option>
                        <option value="Otras">Otras</option>
                    </select>
                    <div class="invalid-feedback">
                        Por favor, seleccione un género.
                    </div>
                </div>
            </div>

            <!-- Duración y Restricciones de edad -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="duracion" class="form-label">Duración</label>
                    <input type="number" name="duracion" id="duracion" class="form-control border-customized" required>
                    <div class="invalid-feedback">
                        Ingrese la duración en minutos (máximo 3 dígitos).
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="restricciones" class="form-label">Restricciones de edad</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input border-customized" type="radio" name="restricciones" id="mayores" value="mayores" required>
                        <label class="form-check-label" for="mayores">Mayores de 18</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input border-customized" type="radio" name="restricciones" id="menores" value="menores">
                        <label class="form-check-label" for="menores">Mayores de 7</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input border-customized" type="radio" name="restricciones" id="ninguna" value="ninguna">
                        <label class="form-check-label" for="ninguna">Todos los públicos</label>
                    </div>
                    <div class="invalid-feedback">
                        Por favor, seleccione una opción de restricción de edad.
                    </div>
                </div>
            </div>

            <!-- Sinopsis -->
            <div class="row mb-3">
                <div class="col">
                    <label for="sinopsis" class="form-label">Sinopsis</label>
                    <textarea name="sinopsis" id="sinopsis" class="form-control border-customized" rows="4" required></textarea>
                    <div class="invalid-feedback">
                        Por favor, ingrese una sinopsis.
                    </div>
                </div>
            </div>

            <!-- Botones -->
            <div class="d-flex justify-content-end m-3">
                <button type="submit" class="btn btn-primary m-1">Enviar</button>
                <button type="reset" class="btn btn-secondary m-1">Borrar</button>
            </div>
        </form>

    <!-- Mostrar los datos ingresados si se envió el formulario -->
    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($peliculaDatos)): ?>
            <div class="mt-4 p-4 border rounded bg-light">
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
            </div>
        <?php endif; ?>
    </div>

    

    <script src="validation.js"></script>
</body>

</html>
