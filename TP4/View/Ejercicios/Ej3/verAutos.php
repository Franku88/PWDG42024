<?php
include_once '../../../configuracion.php';
// require_once '../../../vendor/autoload.php'; se trae el paquete de composer
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
    foreach ($arrAutos as $auto) {
        $arreglo[] = $auto->toArrayNyA(); //Solo obtiene nombre y apellido del duenio
    }
    $resultado = Helper::arrayToHtmlTable($arreglo);
}
?>

<?php include STRUCTURE_PATH . '/Head.php'; ?>
<div class="alert alert-secondary rounded-4 m-5 border-steam-activo">
    <p class="fs-5"> <b>Ejercicio 3</b> - Crear una pagina php “VerAutos.php”, en ella usando la capa de control correspondiente
        mostrar todos los datos de los autos que se encuentran cargados, de los dueños mostrar nombre y apellido.
        En caso de que no se encuentre ningún auto cargado en la base mostrar un mensaje indicando que no hay
        autos cargados.</p>
</div>
<div class="mx-4 my-3">
    <h1> Autos Registrados </h1>
    <div class="rounded-4 overflow-x-auto p-3"><?php echo ($resultado); ?></div>
</div>
<div class="d-flex justify-content-center mb-2">
    <form action="Action/accionFomatoFechas.php" method="POST">
        <div class="form-floating mb-2 text-center">
            <button class="btn btn-success text-center" type="submit">Cambiar formato de todas las fechas al formato YYYY usando Carbon</button>
        </div>
    </form>
</div>
<div class="d-flex justify-content-center mb-2">
    <form action="Action/accionAntiguedadPatente.php" method="POST">
        <div class="form-floating mb-2 text-center">
            <button class="btn btn-success text-center" type="submit">Mostrar los autos de más de 20 años de antiguedad que no deben abonar patentes</button>
        </div>
    </form>
</div>


<?php include STRUCTURE_PATH . '/Foot.php'; ?>