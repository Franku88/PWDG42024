<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title> Ejercicio 3 Validado </title>
</head>

<body>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb m-2">
            <li class="breadcrumb-item"><a href="../../../menu.html">Menú</a></li>
            <li class="breadcrumb-item active" aria-current="page">Ejercicio 2 (Ejercicio 3 TP1)</li>
        </ol>
    </nav>
    <div>
        <h1 class="position-relative border p-4"> Ejercicio 3 Validado </h1>
    </div>
    <div class="modal position-relative d-block p-5 py-md-5">
        <div class="rounded-4 shadow border p-3">
            <p class="fs-5"> Crear una página php que contenga un formulario HTML como el que se indica en la
                imagen (darle formato con CSS), enviar estos datos por el método Post a otra página php
                que los reciba y muestre por pantalla un mensaje como el siguiente: “Hola, yo soy
                nombre , apellido tengo edad años y vivo en dirección”, usando la información recibida.
                Cambiar el método Post por Get y analizar las diferencias
            </p>
        </div>
        <div class="modal-dialog">
            <div class="modal-content rounded-4 shadow">
                <div class="modal-header p-5 pb-4 border-bottom-0">
                    <h1 class="fw-bold mb-0 fs-3"> Ingrese sus datos personales </h1>
                </div>
                <div class="modal-body p-5 pt-0">
                    <form id="miFormulario3" action="Action/verDatosPersonalesEj3.php" method="POST">
                        <div class="form-floating mb-3">
                            <input class="form-control rounded-3" type="text" name="nombre" id="nombre" placeholder="">    
                            <label for="nombre">Nombre</label>
                            <span class="text-danger error" id="errorNombre"></span>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control rounded-3" type="text" name="apellido" id="apellido" placeholder="">
                            <label for="apellido">Apellido</label>
                            <span class="text-danger error" id="errorApellido"></span>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control rounded-3" type="number" name="edad" id="edad" placeholder="">
                            <label for="edad">Edad</label>
                            <span class="text-danger error" id="errorEdad"></span>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control rounded-3" type="text" name="direccion" id="direccion" placeholder="">
                            <label for="direccion">Direccion</label>
                            <span class="text-danger error" id="errorDireccion"></span>
                        </div>
                        <div class="form-floating mb-2">
                            <button class="w-100 mb-2 btn btn-lg rounded-3 btn-primary" type="submit">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="Assets/validacion.js"></script>
</body>

</html>