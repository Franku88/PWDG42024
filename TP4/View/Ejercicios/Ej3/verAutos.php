<?php
include_once '../../../configuracion.php';
// include_once ROOT_PATH.'/Controller/ABMAuto.php'; Lo carga el autoloader.php
// include_once ROOT_PATH.'/View/Assets/Helper.php'; Lo carga el autoloader.php

$arrAutos = (new ABMAuto())->buscar();

$resultado = "<div class='alert alert-warning border-steam-inactivo'>
                <h5> Datos no recibidos.</h5>
            </div>";
if (empty($arrAutos)) {
    $resultado = "  <div class='alert alert-warning border-steam-inactivo'>
                    <h5> No se encuentran autos cargados en la BD.</h5>
                </div>";
} else {
    $arreglo = [];
    foreach($arrAutos as $auto) {
        $arreglo[] = $auto->toArrayNyA(); //Solo obtiene nombre y apellido del duenio
    }
    $resultado = Helper::arrayToHtmlTable($arreglo);
}
?>

<?php include STRUCTURE_PATH.'/Head.php';?>
    <div class="alert alert-secondary rounded-4 m-5 border-steam-activo">
        <p class="fs-5"> <b>Ejercicio 3</b> - Crear   una   pagina   php   “VerAutos.php”,   en   ella   usando   la   capa   de   control   correspondiente
        mostrar todos los datos de los autos que se encuentran cargados, de los dueños mostrar nombre y apellido.
        En caso de que no se encuentre ningún auto cargado en la base mostrar un mensaje indicando que no hay
        autos cargados.</p>
    </div>
    <div class="mx-4 my-3">
        <h1> Autos Registrados </h1> 
        <div class="rounded-4 overflow-x-auto p-3"><?php echo($resultado);?></div>
    </div>
    
<?php include STRUCTURE_PATH.'/Foot.php';?>