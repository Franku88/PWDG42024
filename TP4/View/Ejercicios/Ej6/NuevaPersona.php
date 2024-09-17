<?php
include_once '../../../configuracion.php';
?>

<?php include_once STRUCTURE_PATH.'/Head.php';?>

    <div class="alert alert-secondary rounded-4 m-5 border-steam-activo">
        <p class="fs-5"> <b>Ejercicio 6</b> - Crear una página “NuevaPersona.php” que contenga un formulario que permita solicitar todos
        los datos de una persona. Estos datos serán enviados a una página “accionNuevaPersona.php” que cargue
        un nuevo registro en la tabla persona de la base de datos. Se debe mostrar un mensaje que indique si se
        pudo  o no  cargar  los datos  de  la persona.  Utilizar  css y  validaciones  javaScript cuando  crea  conveniente.
        Recordar usar la capa de control antes generada, no se puede acceder directamente a las clases del ORM.</p>
    </div>

    <div class="modal-dialog m-auto">
        <div class="modal-content rounded-4 shadow contenedor-inactivo-steam w-auto">
            <div class="modal-header p-5 pb-4 border-bottom-0">
                <h1 class="mb-0">Registrar Persona</h1>
            </div>
            <div class="modal-body p-4 pt-0">
                <form id="formEj6" action="Action/accionNuevaPersona.php" method="POST">
                    
                    <div class="form-floating mx-1 mb-2">
                        <input type="text" class="form-control form-control-sm rounded-3" name="nrodni" id="nrodni" minlength="8" maxlength="8" placeholder="" required>
                        <label for="nrodni"> DNI </label>
                        <div class="invalid-feedback">
                        Ocho dígitos, sin puntos.
                        </div>
                    </div>

                    <div class="form-floating mx-1 mb-2">
                        <input type="text" class="form-control form-control-sm rounded-3" name="apellido" id="apellido" minlength="2" maxlength="50" placeholder="" required>
                        <label for="apellido"> Apellido </label>
                        <div class="invalid-feedback">
                        Apellido inválido.
                        </div>
                    </div>

                    <div class="form-floating mx-1 mb-2">
                        <input type="text" class="form-control form-control-sm rounded-3" name="nombre" id="nombre" minlength="2" maxlength="50" placeholder="" required>
                        <label for="nombre"> Nombre </label>
                        <div class="invalid-feedback">
                        Nombre inválido.
                        </div>
                    </div>
                
                    <div class="form-floating mx-1 mb-2">
                        <input type="date" class="form-control form-control-sm rounded-3" name="fechanac" id="fechanac" min="1900-01-01" max="<?php echo date('Y-m-d'); ?>"  placeholder="" required>
                        <label for="fechanac"> Fecha de Nacimiento </label>
                        <div class="invalid-feedback">
                        Fecha inválida. Debe ser mayor de 18 años.
                        </div>
                    </div>
                
                    <div class="d-flex">
                        <div class="form-floating mx-1 mb-2 w-25">
                            <input type="text" class="form-control form-control-sm rounded-3" name="codarea" id="codarea" placeholder="" minlength="2" maxlength="4" required>
                            <label for="codarea"> Cod. area </label>
                            <div class="invalid-feedback">
                                
                            </div>
                        </div>

                        <div class="form-floating mx-1 mb-2 w-75">
                            <input type="text" class="form-control form-control-sm rounded-3" name="numlocal" id="numlocal" placeholder="" minlength="6" maxlength="8" required>
                            <label for="numlocal"> Número </label>
                            <div class="invalid-feedback">
                            Diez dígitos entre Cod. area y Número.
                            </div>
                        </div>
                    </div>
                
                    <div class="form-floating mx-1 mb-1">
                        <input type="text" class="form-control form-control-sm rounded-3" name="domicilio" id="domicilio" minlength="5" maxlength="200" placeholder="" required>
                        <label for="domicilio"> Domicilio </label>
                        <div class="invalid-feedback">
                        Domicilio inválido.
                        </div>
                    </div>

                    <div class="form-floating mb-2 text-center">
                        <button class="w-50 mb-2 btn rounded-3 btn-primary btn-steam4" type="submit">Enviar</button>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>

<?php include_once STRUCTURE_PATH.'/Foot.php';?>