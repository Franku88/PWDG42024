<?php
include_once '../../../../configuracion.php';

use Carbon\Carbon;

$arrAutos = (new ABMAuto())->buscar();

$resultado = "<div class='alert alert-warning border-steam-inactivo'>
                <h5> Fechas modificadas correctamente.</h5>
                <div class='mb-1'>
                <a href='../../Ej3/verAutos.php' class='btn btn-secondary btn-steam2'> Ver autos </a>
            </div>
            </div>";
if (empty($arrAutos)) {
    $resultado = "  <div class='alert alert-warning border-steam-inactivo'>
                    <h5> No se encuentran autos cargados en la BD.</h5>
                </div>";
} else {
    $arreglo = [];

    //Cambiar todas las fechas de los modelos al formato de cuatro dígitos
    foreach ($arrAutos as $auto) {
        // Obtengo el modelo del auto
        $modelo = $auto->getModelo();
        // Filtro cualquier fecha que no cumpla con el formato YYYY (año completo)
        if (strlen($modelo) != 4) {
            // Determino el año actual
            $fechaActual = Carbon::now()->year;
            // Creo una fecha con Carbon interpretanto el año del modelo, se convierte de int a string para que pueda ser usado por Carbon
            $fechaAuto = Carbon::createFromFormat('y', strval($modelo));
            // Modifico el modelo por la fecha convertida por carbon, convertido a int para el uso en la base de datos
            $modelo = intval($fechaAuto->year);
            // En caso de que el año de dos dígitos refiera a una fecha anterior al siglo actual (ej: 25 como 1925 y no 2025)
            if ($modelo > $fechaActual) {
                // Función de carbon para restarle una centuria al 
                $fechaAuto->subCentury();
                // modifico la fecha al valor correspondiente
                $modelo = intval($fechaAuto->year);
            }            
            // Creo el arreglo con los datos del auto y el modelo modificado.
            $autoMod = [
                'Patente' => ($auto->getPatente()),
                'Marca' => ($auto->getMarca()),
                'Modelo' => $modelo,
                'Duenio' => ($auto->getDuenio())
            ];
            // Modifico la base de datos
            $arrAutoMod = (new ABMAuto())->buscar(['Patente' => $autoMod['Patente']]);
            $arrAutoMod = (new ABMAuto())->modificacion($autoMod);
        }
    }
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

<?php include STRUCTURE_PATH . '/Foot.php'; ?>