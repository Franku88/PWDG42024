<?php
include_once '../../../configuracion.php';
// include_once ROOT_PATH.'/Controller/ABMPersona.php'; Lo carga el autoloader.php
// include_once ROOT_PATH.'/View/Assets/Helper.php'; Lo carga el autoloader.php

$arrPersonas = (new ABMPersona())->buscar();
$resultado = "";
if (empty($arrPersonas)) {
    $resultado = "<h5> No se encuentran personas cargadas en la BD.</h5>";
} else {
    $arreglo = [];
    foreach($arrPersonas as $persona) {
        $arreglo[] = $persona->toArray();
    }
    $resultado = Helper::arrayToHtmlTable($arreglo);
}
?>

<?php include_once STRUCTURE_PATH.'/Head.php';?>
    <div class="alert alert-secondary rounded-4 m-5 border-steam-activo">
            <p class="fs-5"> <b>Ejercicio 5</b> - Crear   una   página   "listaPersonas.php"   que   muestre   un   listado   con   las   personas   que   se
            encuentran cargadas y un link a otra página “autosPersona.php” que recibe un dni de una persona y muestra
            los datos de la persona y un listado de los autos que tiene asociados. Recordar usar la capa de control antes
            generada, no se puede acceder directamente a las clases del ORM.</p>
    </div>

    <div class="mx-4 my-3">
        <h1> Personas Registradas </h1> 
        <div class="rounded-4 overflow-x-auto p-3"><?php echo($resultado);?></div>
    </div>

    <div class="modal-dialog m-auto">
        <div class="modal-content rounded-4 shadow contenedor-inactivo-steam">
            <div class="modal-header p-5 pb-4 border-bottom-0">
                <h1 class="mb-0">Autos asociados a un DNI</h1>
            </div>
            <div class="modal-body p-5 pt-0">
                <form id="formEj5" action="Action/autosPersona.php" method="POST">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control rounded-3" name="nrodni" id="nrodni" minlength="8" maxlength="8" placeholder="" required>
                        <label for="nrodni"> DNI </label>
                        <div class="invalid-feedback">
                        DNI de 8 digitos, sin puntos.
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