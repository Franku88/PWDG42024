<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Ejercicio 1 TP3</title>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>
  <nav aria-label="breadcrumb">
          <ol class="breadcrumb m-2">
              <li class="breadcrumb-item"><a href="../../../menu.html">Menú</a></li>
              <li class="breadcrumb-item active" aria-current="page">Ejercicio 1</li>
          </ol>
  </nav>
  <form action="./Action/actionEJ1.php" method="post" enctype="multipart/form-data" id="form">
    <div class="m-3 w-25" id="formulario">
      <label for="" class="form-label">Seleccione un archivo para subir</label>
      <input type="file" class="form-control" name="archivo" id="archivo" placeholder="" aria-describedby="fileHelpId" />
      <div id="fileHelpId" class="form-text">Formatos aceptados: *.doc y *.pdf</div>
      <div id="fileHelpId" class="form-text">Tamaño máximo: 2 MB</div>
      <input type="submit" class="btn btn-primary mt-2" name="enviar" value="Enviar" />
    </div>
  </form>

  <script type="text/javascript" src="./Assets/formulario_jquery.js"></script>
</body>

</html>