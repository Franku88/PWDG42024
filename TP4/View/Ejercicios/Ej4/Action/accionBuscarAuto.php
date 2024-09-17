<?php
include_once '../../../../configuracion.php';
// include_once ROOT_PATH.'/Util/funciones.php'; Lo carga el autoloader.php
// include_once ROOT_PATH.'/Controller/ABMAuto.php'; Lo carga el autoloader.php
// include_once ROOT_PATH.'/View/Assets/Helper.php'; Lo carga el autoloader.php

$data = Funciones::data_submitted();  // Cambiado a clase Funciones, función data_submitted() cambiada a public static
$resultado = "<div class='alert alert-warning border-steam-inactivo'>
            <h5> Datos no recibidos.</h5>
            </div>";

if (!empty($data)) {
    $arrAutos = (new ABMAuto())->buscar(['Patente'=> (trim(strtoupper($data['patente'])))]);
    if (!empty($arrAutos)) {
        $arreglo = [$arrAutos[0]->toArray()]; //Paso objeto a array para usar arrayToTable
        $resultado = "<h1> Resultado </h1> 
            <div class='rounded-4 overflow-x-auto p-3'>".Helper::arrayToHtmlTable($arreglo)."</div>";
    } else {
        $resultado = "<div class='alert alert-warning border-steam-inactivo'>
            <h5> Auto con patente '".trim(strtoupper($data['patente']))."' no encontrado.</h5>
            </div>";
    }
}
?>

<?php include_once STRUCTURE_PATH.'/Head.php';?>

    <div class="container mt-5">
        <?php echo $resultado;?>
        <div>
            <a href="../buscarAuto.php" class="btn btn-secondary btn-steam2"> Volver </a>
        </div>
    </div>

<?php include_once STRUCTURE_PATH.'/Foot.php';?>