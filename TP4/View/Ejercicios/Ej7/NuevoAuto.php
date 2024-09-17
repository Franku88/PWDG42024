<?php
include_once '../../../configuracion.php';
?>

<?php include_once STRUCTURE_PATH.'/Head.php';?>

<div class="alert alert-secondary rounded-4 m-5 border-steam-activo">
    <p class="fs-5"> <b>Ejercicio 7</b> - Crear una  página  “NuevoAuto.php”  que  contenga  un  formulario  en el  que  se permita  cargar
    todos   los   datos   de   un   auto   (incluso   su   dueño).   Estos   datos   serán   enviados   a   una   página
    “accionNuevoAuto.php” que cargue un nuevo registro en la tabla auto de la base de datos. Se debe chequear
    antes que la persona dueña del auto ya se encuentre cargada en la base de datos, de no ser así mostrar un
    link a la página que permite carga una nueva persona. Se debe mostrar un mensaje que indique si se pudo o
    no cargar los datos Utilizar css y validaciones javaScript cuando crea conveniente. Recordar usar la capa de
    control antes generada, no se puede acceder directamente a las clases del ORM.</p>
</div>

<div class="modal-dialog m-auto">
    <div class="modal-content rounded-4 shadow contenedor-inactivo-steam w-auto">
        <div class="modal-header p-5 pb-4 border-bottom-0">
            <h1 class="mb-0">Registrar Auto</h1>
        </div>
        <div class="modal-body p-4 pt-0">
            <form id="formEj7" action="Action/accionNuevoAuto.php" method="POST">
                
                <div class="form-floating mx-1 mb-2">
                    <input type="text" class="form-control form-control-sm rounded-3" name="patente" id="patente" minlength="7" maxlength="9" placeholder="" required>
                    <label for="patente"> Patente </label>
                    <div class="invalid-feedback">
                    Formatos aceptados: 'ABC 123' o 'AB 123 CD'
                    </div>
                </div>

                <div class="form-floating mx-1 mb-2">
                    <input type="text" class="form-control form-control-sm rounded-3" name="marca" id="marca" minlength="2" maxlength="50" placeholder="" required>
                    <label for="marca"> Marca </label>
                    <div class="invalid-feedback">
                    Marca inválida.
                    </div>
                </div>

                <div class="form-floating mx-1 mb-2">
                    <input type="number" class="form-control form-control-sm rounded-3" name="modelo" id="modelo" min="10" max="<?php echo ((int)date('Y') + 2)?>" placeholder="" required>
                    <label for="modelo"> Modelo </label>
                    <div class="invalid-feedback">
                    Año del vehiculo. Numero de 2 o 4 dígitos.
                    </div>
                </div>
            
                <div class="form-floating mx-1 mb-2">
                    <input type="text" class="form-control form-control-sm rounded-3" name="dniduenio" id="dniduenio" minlength="8" maxlength="8" placeholder="" required>
                    <label for="dniduenio"> DNI del dueño </label>
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