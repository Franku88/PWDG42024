<?php
include_once '../../../../configuracion.php';

use Carbon\Carbon;

$arrAutos = (new ABMAuto())->buscar();

$resultado = "";
if (empty($arrAutos)) {
    $resultado = "  <div class='alert alert-warning border-steam-inactivo'>
                    <h5> No se encuentran autos cargados en la BD.</h5>
                </div>";
} else {
    $arreglo = [];

    //Busca si el auto paga patente según su modelo
    foreach ($arrAutos as $auto) {
        //Determino el año de auto
        $modelo = $auto->getModelo();
        //Determino el año actual
        $fechaActual = Carbon::now()->year;
        // Creo las instancias de carbon con las fechas de inicio y fin para calcular la diferencia de años
        $fechaActualTributo = Carbon::createFromDate($modelo, 1, 1);
        $fechaAntiguedadTributo = Carbon::createFromDate($fechaActual, 1, 1);
        // Calculo de la diferencia de años, y convertido el valor de float (salida de funcion diffInYears) en int
        $diferenciaModelos = intval($fechaActualTributo->diffInYears($fechaAntiguedadTributo));
        // echo $diferenciaModelos . " // ";
        $paga = true;
        $mensaje = 'Si';
        // Verificación si la diferencia de años es mayor a 20
        if ($diferenciaModelos > 20) {
            $paga = false;
            $mensaje = 'No';
        }
        // Obtengo los datos del auto incluido el del dueño
        $arregloDatos = $auto->toArrayNyA();
        // Incorporo el dato si pago patente al arreglo de los datos del auto
        $arregloDatos['Paga'] = $mensaje;

        //print_r($arregloDatos);

        $arreglo[] = $arregloDatos;
    }
}
$resultado = Helper::arrayToHtmlTable($arreglo) . "<div class='alert alert-warning border-steam-inactivo'>
<h5> Vehículos de hasta 20 años inclusive pagan el tributo municipal en la ciudad de Neuquén Capital.</h5>
<div class='mb-1'>
<a href='../../Ej3/verAutos.php' class='btn btn-secondary btn-steam2'> Ver autos </a>
</div>
</div>";

?>

<?php include STRUCTURE_PATH . '/Head.php'; ?>
<div class="alert alert-secondary rounded-4 m-5 border-steam-activo">
    <p class="fs-5"> <b>Ejercicio 3</b> - Crear una pagina php “VerAutos.php”, en ella usando la capa de control correspondiente
        mostrar todos los datos de los autos que se encuentran cargados, de los dueños mostrar nombre y apellido.
        En caso de que no se encuentre ningún auto cargado en la base mostrar un mensaje indicando que no hay
        autos cargados.</p>
</div>
<div class="mx-4 my-3">
    <h1> Autos registrados que deben pagar patentes</h1>
    <div class="rounded-4 overflow-x-auto p-3"><?php echo ($resultado); ?></div>
</div>

<?php include STRUCTURE_PATH . '/Foot.php'; ?>