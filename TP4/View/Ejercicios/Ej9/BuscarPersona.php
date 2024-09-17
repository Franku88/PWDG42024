<?php
include_once '../../../configuracion.php';
?>

<?php include_once STRUCTURE_PATH.'/Head.php';?>

    <div class="alert alert-secondary rounded-4 m-5 border-steam-activo">
        <p class="fs-5"> <b>Ejercicio 9</b> - Crear   una   página   “BuscarPersona.html”   que   contenga   un   formulario   que   permita   cargar   un
        numero de documento de una persona. Estos datos serán enviados a una página “accionBuscarPersona.php”
        busque los datos de la persona cuyo documento sea el ingresado en el formulario los muestre en un nuevo
        formulario; a su vez este nuevo formulario deberá permitir modificar los datos mostrados (excepto el nro de
        documento) y estos serán enviados a otra página “ActualizarDatosPersona.php” que actualiza los datos de la
        persona.  Utilizar  css  y  validaciones   javaScript  cuando  crea   conveniente.  Recordar   usar  la  capa  de  control
        antes generada, no se puede acceder directamente a las clases del ORM.</p>
    </div>
    <div class="modal-dialog m-auto">
        <div class="modal-content rounded-4 shadow contenedor-inactivo-steam w-auto">
            <div class="modal-header p-5 pb-4 border-bottom-0">
                <h1 class="mb-0">Buscar Persona</h1>
            </div>
            <div class="modal-body p-4 pt-0">
                <form id="formEj9" action="Action/accionBuscarPersona.php" method="POST">
                
                    <div class="form-floating mx-1 mb-2">
                        <input type="text" class="form-control form-control-sm rounded-3" name="nrodni" id="nrodni" minlength="8" maxlength="8" placeholder="" required>
                        <label for="nrodni"> DNI</label>
                        <div class="invalid-feedback">
                        Ocho dígitos, sin puntos.
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