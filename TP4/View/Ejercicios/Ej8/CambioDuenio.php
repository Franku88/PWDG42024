<?php
include_once '../../../configuracion.php';
?>

<?php include_once STRUCTURE_PATH.'/Head.php';?>
    <div class="alert alert-secondary rounded-4 m-5 border-steam-activo">
        <p class="fs-5"> <b>Ejercicio 8</b> - Crear   una   página   “CambioDuenio.php”   que   contenga   un   formulario   en   donde   se   solicite   el
        numero de patente de un auto y un numero de documento de una persona, estos datos deberán ser enviados
        a   una   página   “accionCambioDuenio.php”   en   donde   se   realice   cambio   del   dueño   del   auto   de   la   patente
        ingresada en el formulario. Mostrar mensajes de error en caso de que el auto o la persona no se encuentren
        cargados. Utilizar css y validaciones javaScript cuando crea conveniente. Recordar usar la capa de control
        antes generada, no se puede acceder directamente a las clases del ORM.</p>
    </div>
    <div class="modal-dialog m-auto">
        <div class="modal-content rounded-4 shadow contenedor-inactivo-steam w-auto">
            <div class="modal-header p-5 pb-4 border-bottom-0">
                <h1 class="mb-0">Cambiar Dueño</h1>
            </div>
            <div class="modal-body p-4 pt-0">
                <form id="formEj8" action="Action/accionCambioDuenio.php" method="POST">
                    
                    <div class="form-floating mx-1 mb-2">
                        <input type="text" class="form-control form-control-sm rounded-3" name="patente" id="patente" minlength="7" maxlength="9" placeholder="" required>
                        <label for="patente"> Patente </label>
                        <div class="invalid-feedback">
                        Formatos aceptados: 'ABC 123' o 'AB 123 CD'
                        </div>
                    </div>
                
                    <div class="form-floating mx-1 mb-2">
                        <input type="text" class="form-control form-control-sm rounded-3" name="dniduenio" id="dniduenio" minlength="8" maxlength="8" placeholder="" required>
                        <label for="dniduenio"> DNI de nuevo dueño </label>
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