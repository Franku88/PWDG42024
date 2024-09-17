<?php
include_once '../../../../configuracion.php';
// include_once ROOT_PATH.'/Util/funciones.php'; Lo carga el autoloader.php
// include_once ROOT_PATH.'/Controller/ABMPersona.php'; Lo carga el autoloader.php
// include_once ROOT_PATH.'/Controller/ABMAuto.php';  Lo carga el autoloader.php

$data = Funciones::data_submitted(); // Cambiado a clase Funciones, función data_submitted() cambiada a public static

$resultado = "
            <div class='container mt-5'>
            <div class='alert alert-warning border-steam-inactivo'>
                <h5> Datos no recibidos.</h5>
            </div>
            <div class='mt-3'>
                <a href='../BuscarPersona.php' class='btn btn-secondary btn-steam2'> Volver </a>
            </div>
            </div>";
if (!empty($data)) {
        $arrPersona = (new ABMPersona())->buscar(['NroDni'=>(trim($data['nrodni']))]);
        if (!empty($arrPersona)) {
            $nrodni = $arrPersona[0]->getNroDni();
            $apellido = $arrPersona[0]->getApellido();
            $nombre = $arrPersona[0]->getNombre();
            $fechaNac = $arrPersona[0]->getFechaNac();
            $telefono = $arrPersona[0]->getTelefono();
            $telefonoArr = explode('-', $telefono);
            $domicilio = $arrPersona[0]->getDomicilio();

            $resultado = "
            <div class='container mt-5 w-auto'>
                <div class='modal-dialog m-auto'>
                    <div class='modal-content rounded-4 shadow contenedor-inactivo-steam w-auto'>
                        <div class='modal-header p-5 pb-4 border-bottom-0'>
                            <h1 class='mb-0'>Datos personales</h1>
                        </div>
                        <div class='modal-body p-4 pt-0'>
                            <form id='formEj9_2' action='ActualizarDatosPersona.php' method='POST'>
            
                                <div class='form-floating mx-1 mb-2'>
                                    <input type='text' class='form-control form-control-sm rounded-3' name='nrodni' id='nrodni' minlength='8' maxlength='8' placeholder='' value='".$nrodni."' readonly required>
                                    <label for='nrodni'>DNI</label>
                                    <div class='invalid-feedback'>
                                    Ocho dígitos, sin puntos.
                                    </div>
                                </div>
                                <div class='form-floating mx-1 mb-2'>
                                    <input type='text' class='form-control form-control-sm rounded-3' name='apellido' id='apellido' minlength='2' maxlength='50' placeholder='' value='".$apellido."' readonly required>
                                    <label for='apellido'> Apellido </label>
                                    <div class='invalid-feedback'>
                                    Apellido inválido.
                                    </div>
                                </div>

                                <div class='form-floating mx-1 mb-2'>
                                    <input type='text' class='form-control form-control-sm rounded-3' name='nombre' id='nombre' minlength='2' maxlength='50' placeholder='' value='".$nombre."' readonly required>
                                    <label for='nombre'> Nombre </label>
                                    <div class='invalid-feedback'>
                                    Nombre inválido.
                                    </div>
                                </div>
                
                                <div class='form-floating mx-1 mb-2'>
                                    <input type='date' class='form-control form-control-sm rounded-3' name='fechanac' id='fechanac' min='1900-01-01' max=".date('Y-m-d')."  placeholder='' value='".$fechaNac."' readonly required>
                                    <label for='fechanac'> Fecha de Nacimiento </label>
                                    <div class='invalid-feedback'>
                                    Fecha inválida. Debe ser mayor de 18 años.
                                    </div>
                                </div>
                
                                <div class='d-flex'>
                                    <div class='form-floating mx-1 mb-2 w-25'>
                                        <input type='text' class='form-control form-control-sm rounded-3' name='codarea' id='codarea' placeholder='' minlength='2' maxlength='4' value='".$telefonoArr[0]."' readonly required>
                                        <label for='codarea'> Cod. area </label>
                                        <div class='invalid-feedback'>
                                            
                                        </div>
                                    </div>

                                    <div class='form-floating mx-1 mb-2 w-75'>
                                        <input type='text' class='form-control form-control-sm rounded-3' name='numlocal' id='numlocal' placeholder='' minlength='6' maxlength='8' value='".$telefonoArr[1]."' readonly required>
                                        <label for='numlocal'> Número </label>
                                        <div class='invalid-feedback'>
                                        Diez dígitos entre Cod. area y Número.
                                        </div>
                                    </div>
                                </div>
                
                                <div class='form-floating mx-1 mb-1'>
                                    <input type='text' class='form-control form-control-sm rounded-3' name='domicilio' id='domicilio' minlength='5' maxlength='200' placeholder='' value='".$domicilio."' readonly required>
                                    <label for='domicilio'> Domicilio </label>
                                    <div class='invalid-feedback'>
                                    Domicilio inválido.
                                    </div>
                                </div>

                                <div class='d-flex my-4 justify-content-center'>
                                    <div class='form-floating mx-3 text-center'>
                                        <button class='btn rounded-3 btn-primary btn-steam4' id='submitButtonEj9' type='submit' disabled>Enviar</button>
                                    </div>
                                    <div class='form-floating mx-3 text-center'>
                                        <button class='btn rounded-3 btn-group btn-steam2' id='editButtonEj9' type='button'>Editar</button>
                                    </div>
                                    <div class='form-floating mx-3 text-center'>
                                        <button class='btn rounded-3 btn-secondary btn-steam3' id='cancelButtonEj9' type='button' disabled>Cancelar</button>
                                    </div>
                                </div>
                                <div class='text-warning text-center d-none' id='noChangeDiv'>
                                    <p>No se han modificado datos.</p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class='mt-3'>
                    <a href='../BuscarPersona.php' class='btn btn-secondary btn-steam2'> Volver </a>
                </div>
            </div>";
        } else {
            $resultado = "
                <div class='container mt-5'>
                    <div class='alert alert-warning border-steam-inactivo'>
                        <h5> Persona con DNI '".trim($data['nrodni'])."' no se encuentra registrada.</h5>
                    </div>
                    <div class='mt-3'>
                        <a href='../BuscarPersona.php' class='btn btn-secondary btn-steam2'> Volver </a>
                    </div>
                </div>";
        }    
}

?>

<?php include_once STRUCTURE_PATH.'/Head.php';?>

    <?php echo $resultado;?>

<?php include_once STRUCTURE_PATH.'/Foot.php';?>