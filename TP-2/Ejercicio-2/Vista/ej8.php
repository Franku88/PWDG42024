<html>
    
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <title> Ejercicio 8 Validado </title>
    </head>
    
    <body>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-2">
                <li class="breadcrumb-item"><a href="../../../menu.html">Menú</a></li>
                <li class="breadcrumb-item active" aria-current="page">Ejercicio 2 (Ejercicio 8 TP1)</li>
            </ol>
        </nav>
        <div>
            <h1 class="position-relative border p-4"> Ejercicio 8 Validado </h1>
        </div>
        <div class="modal position-relative d-block p-5 py-md-5">
            <div class="rounded-4 shadow border p-3">
                <p class="fs-5"> 
                    La empresa de Cine Cinem@s tiene establecidas diferentes tarifas para las entradas, en
                    función de la edad y de la condición de estudiante del cliente. Desea que sean los propios
                    clientes los que puedan calcular el valor de sus entradas a través de una página web. Si
                    es estudiante o menor de 12 años el precio es de $160, si es estudiante y mayor o igual
                    de 12 años el precio es de $180, en cualquier otro caso el precio es de $300. Diseñar un
                    formulario que solicite la edad y permita ingresar si se trata de un estudiante o no. Con
                    un botón enviar los datos a un script encargado de realizar el cálculo y visualizarlo.
                    Agregar un botón para limpiar el formulario y volver a consultar.
                </p>
            </div>
            <!-- IGNORAR (test para mostrar el resultado en la misma página)
            <?php /**
                // Inicializa variables
                $resultado = null;
                // Verifica si el formulario ha sido enviado
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    // Obtiene los valores enviados
                    if (($_POST["edad"]) < 12) {
                        $resultado = 160;
                    } else {
                        if ($_POST["estudia"]) {
                            $resultado = 180;
                        } else {
                            $resultado = 300;
                        }
                    }
                }*/
            ?>
            -->

            <div class="modal-dialog d-flex justify-content-center">
                <div class="modal-content rounded-4 shadow w-75">
                    <div class="modal-header p-5 pb-4 border-bottom-0 justify-content-center">
                        <h1 class="fw-bold mb-0 fs-4"> Cinem@s </h1>
                    </div>
                    <div class="modal-body p-5 pt-0">
                        <form id="miFormulario8" action="Action/verPrecio.php" method="POST">
                            <div class="form-floating mb-3">
                                <input class="form-control rounded-3" type="number" name="edad" id="edad" placeholder="">
                                <label for="edad">Edad</label>
                                <span class="text-danger error" id="errorEdad"></span>
                            </div>
                            <div class="form-floating mb-3">
                                <p>¿Estudia?: </p>        
                                <div class="d-flex mb-2">
                                    <div class="form-check">
                                        <input type="radio" id="si" name="estudia" value="1">
                                        <label for="si">Si</label><br>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" id="no" name="estudia" value="0">
                                        <label for="no">No</label><br>
                                    </div>
                                </div>
                                <span class="text-danger error" id="errorEstudia"></span>
                            </div>
                            <div class="d-flex">
                                <div class="form-floating w-50 me-1">
                                    <button class="w-100 btn btn-lg rounded-3 btn-primary" type="submit">Enviar</button>
                                </div>
                                <div class="form-floating w-50 ms-1">
                                    <button class="w-100 btn btn-lg rounded-3 btn-primary" type="reset">Limpiar</button>
                                </div>
                            </div>                                
                        </form>
                    </div>
                </div>
            </div>
            <!-- IGNORAR (test para mostrar el resultado en la misma página)
            <div class="modal-dialog d-flex align-content-center">
                <?php /* if ($resultado != null): */?>
                    <div class="modal-content rounded-4 justify-content-center">
                        <div class="modal-body p-5">
                            <p class="fw-bold fs-3">El precio del boleto es: <?php /* echo htmlspecialchars($resultado);*/?></p>
                        </div>
                    </div>
                <?php /* endif; */?>
            </div>
            -->
        </div>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="Assets/validacion.js"></script>
    </body>
    
    </html>