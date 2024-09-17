<?php
include_once '../../../../configuracion.php';
// include_once ROOT_PATH.'/Util/funciones.php'; Lo carga el autoloader.php
// include_once ROOT_PATH.'/Controller/ABMPersona.php'; Lo carga el autoloader.php
// include_once ROOT_PATH.'/Controller/ABMAuto.php'; Lo carga el autoloader.php
// include_once ROOT_PATH.'/View/Assets/Helper.php'; Lo carga el autoloader.php

$data = Funciones::data_submitted();  // Cambiado a clase Funciones, función data_submitted() cambiada a public static
$resultado = "<div class='alert alert-warning border-steam-inactivo'>
                <h5> Datos no recibidos.</h5>
            </div>";

if (!empty($data)) {
    $arrPersona = (new ABMPersona())->buscar(['NroDni'=>(trim($data['nrodni']))]);
    if (!empty($arrPersona)) {
        //$arreglo1 referencia arreglo con Persona en forma de arreglo
        $arreglo1 = [$arrPersona[0]->toArray()]; //Paso objeto a array para usar arrayToTable
        $resultado = "<h1>".$arreglo1[0]['Apellido'].", ".$arreglo1[0]['Nombre']."</h1> 
            <div class='rounded-4 overflow-x-auto p-3'>".Helper::arrayToHtmlTable($arreglo1)."</div>";
        $arrAutos = (new ABMAuto())->buscar(['Duenio'=>($arrPersona[0])]);
        if (!empty($arrAutos)) {
            //$arreglo2 referencia arreglo con Autos en forma de arreglo
            $arreglo2 = [];
            foreach ($arrAutos as $auto) {
                $arreglo2[] = $auto->toArraySolo(); //Paso objeto a array para usar arrayToTable, solo datos del auto
            }
            $resultado .= "<h1> Autos registrados </h1>
            <div class='rounded-4 overflow-x-auto p-3'>".Helper::arrayToHtmlTable($arreglo2)."</div>";
        } else {
            $resultado .= "<div class='alert alert-warning border-steam-inactivo'>
            <h5> No posee vehículos registrados.</h5>
            </div>";
        }
    } else {
        $resultado = "<div class='alert alert-warning border-steam-inactivo'>
            <h5> Persona con DNI '".trim($data['nrodni'])."' no registrada.</h5>
            </div>";
    }
}
?>

<?php include_once STRUCTURE_PATH.'/Head.php';?>
 
    <div class="container mt-5">
        <?php echo $resultado;?>
        <div>
            <a href="../listaPersonas.php" class="btn btn-secondary btn-steam2"> Volver </a>
        </div>
    </div>

<?php include_once STRUCTURE_PATH.'/Foot.php';?>