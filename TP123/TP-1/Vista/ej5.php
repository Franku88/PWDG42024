<html>
    
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title> Ejercicio 5 </title>
</head>

<body>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb m-2">
            <li class="breadcrumb-item"><a href="../../menu.html">Menú</a></li>
            <li class="breadcrumb-item active" aria-current="page">Ejercicio 5</li>
        </ol>
    </nav>
    <div>
        <h1 class="position-relative border p-4"> Ejercicio 5 </h1>
    </div>
    <div class="modal position-relative d-block p-5 py-md-5">
        <div class="rounded-4 shadow border p-3">
            <p class="fs-5"> Modificar el formulario del ejercicio anterior solicitando, tal que usando componentes
                “radios buttons” se ingrese el nivel de estudio de la persona: 1-no tiene estudios, 2-
                estudios primarios, 3-estudios secundarios. Agregar el componente que crea más
                apropiado para solicitar el sexo. En la página que procesa el formulario mostrar además
                un mensaje que indique el tipo de estudios que posee y su sexo.
            </p>
        </div>
        <div class="modal-dialog">
            <div class="modal-content rounded-4 shadow">
                <div class="modal-header p-5 pb-4 border-bottom-0">
                    <h1 class="fw-bold mb-0 fs-3"> Ingrese sus datos personales </h1>
                </div>
                <div class="modal-body p-5 pt-0">
                    <form action="Action/verDatosPersonalesEj5.php" method="GET">
                        <div class="form-floating mb-3">
                            <input class="form-control rounded-3" type="text" name="nombre" id="nombre" placeholder="" required>    
                            <label for="nombre">Nombre</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control rounded-3" type="text" name="apellido" id="apellido" placeholder="" required>    
                            <label for="apellido">Apellido</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control rounded-3" type="number" name="edad" id="edad" placeholder="" min="0" required>    
                            <label for="edad">Edad</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control rounded-3" type="text" name="direccion" id="direccion" placeholder="" required>    
                            <label for="direccion">Direccion</label>
                        </div>
                        <div class="form-floating m-3">
                            <p>Estudios</p>
                            <div class="form-check">
                                <input type="radio" id="ninguno" name="estudios" value="ninguno" required>
                                <label for="ninguno">1. Sin estudios</label><br>
                            </div>
                            <div class="form-check">
                                <input type="radio" id="primaria" name="estudios" value="primaria" required>
                                <label for="primaria">2. Estudios Primarios</label><br>
                            </div>
                            <div class="form-check">
                                <input type="radio" id="secundaria" name="estudios" value="secundaria" required>
                                <label for="secundaria">3. Estudios Secundarios</label><br>
                            </div>
                        </div>
                        <div class="form-floating m-3">
                            <p>Sexo</p>
                            <div class="form-check">
                                <input type="radio" id="hombre" name="sexo" value="hombre" required>
                                <label for="hombre">Hombre</label><br>
                            </div>
                            <div class="form-check">
                                <input type="radio" id="mujer" name="sexo" value="mujer" required>
                                <label for="mujer">Mujer</label><br>
                            </div>
                        </div>
                        <div class="form-floating mb-2">
                            <button class="w-100 mb-2 btn btn-lg rounded-3 btn-primary" type="submit">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>