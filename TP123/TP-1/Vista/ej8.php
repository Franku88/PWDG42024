<html>
    
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <title> Ejercicio 8 </title>
    </head>
    
    <body>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-2">
            <li class="breadcrumb-item"><a href="../../menu.html">Menú</a></li>
            <li class="breadcrumb-item active" aria-current="page">Ejercicio 8</li>
            </ol>
        </nav>
        <div>
            <h1 class="position-relative border p-4"> Ejercicio 8 </h1>
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
                        <form action="Action/verPrecio.php" method="POST">
                            <div class="form-floating mb-3">
                                <input class="form-control rounded-3" type="number" name="edad" id="edad" min="0" placeholder="" required>    
                                <label for="edad">Edad</label>
                            </div>
                            <div class="d-flex mb-2">
                                <p>¿Estudia?: </p>        
                                <div class="form-check">
                                    <input type="radio" id="si" name="estudia" value="1" required>
                                    <label for="si">Si</label><br>
                                </div>
                                <div class="form-check">
                                    <input type="radio" id="no" name="estudia" value="0" required>
                                    <label for="no">No</label><br>
                                </div>
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
    </body>
    
    </html>