<?php
include_once '../../../configuracion.php';
?>

<?php include_once STRUCTURE_PATH.'/Head.php';?>

    <div class="alert alert-secondary rounded-4 m-5 border-steam-activo">
            <p class="fs-5"> <b>Ejercicio 4</b> - Crear una pagina "buscarAuto.php" que contenga un formulario en donde se solicite el numero
            de patente de  un auto, estos datos deberán  ser enviados a una  pagina “accionBuscarAuto.php”  en donde
            usando la clase de control correspondiente, se soliciten los datos completos del auto que se corresponda con
            la   patente   ingresada   y   mostrar   los   datos   en   una   tabla.   También   deberán   mostrar   los   carteles   que   crean
            convenientes en caso de que no se encuentre ningún auto con la patente ingresada.
            Utilizar   css   y   validaciones   javaScript   cuando   crea   conveniente.   Recordar   usar   la   capa   de   control   antes
            generada, no se puede acceder directamente a las clases del ORM.</p>
    </div>

    <div class="modal-dialog m-auto">
        <div class="modal-content rounded-4 shadow contenedor-inactivo-steam">
            <div class="modal-header p-5 pb-4 border-bottom-0">
                <h1 class="mb-0"> Ingrese una patente</h1>
            </div>
            <div class="modal-body p-5 pt-0">
                <form id="formEj4" action="Action/accionBuscarAuto.php" method="POST">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control rounded-3" name="patente" id="patente" minlength="7" maxlength="9" placeholder="" required>    
                        <label for="patente"> Patente </label>
                        <div class="invalid-feedback">
                            Formatos aceptados: 'ABC 123' o 'AB 123 CD'
                        </div>
                    </div>
                    <div class="form-floating mb-2">
                        <button class="w-100 mb-2 btn btn-lg rounded-3 btn-primary btn-steam4" type="submit">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php include_once STRUCTURE_PATH.'/Foot.php';?>