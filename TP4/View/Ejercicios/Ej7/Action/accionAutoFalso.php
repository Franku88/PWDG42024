<?php
include_once '../../../../configuracion.php';
//require_once '../../../../vendor/autoload.php'; // cargamos la libreria desde composer
// include_once ROOT_PATH.'/Util/funciones.php'; Lo carga el autoloader.php
// include_once ROOT_PATH.'/Controller/ABMPersona.php'; Lo carga el autoloader.php 
// include_once ROOT_PATH.'/Controller/ABMAuto.php'; Lo carga el autoloader.php

// generamos el auto falso
$vehiculoFalso = (new CustomFaker())->vehiculo();

(new ABMAuto())->alta($vehiculoFalso);

$tabla = "<table class='table table-bordered table-striped table-hover'>
            <thead>
                <tr>
                    <th>Patente</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Dueño</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{$vehiculoFalso['Patente']}</td>
                    <td>{$vehiculoFalso['Marca']}</td>
                    <td>{$vehiculoFalso['Modelo']}</td>
                    <td>{$vehiculoFalso['Duenio']->getNroDni()}</td>
                </tr>
            </tbody>
        </table>";
?>

<?php include_once STRUCTURE_PATH.'/Head.php';?>
 
    <div class="container mt-5">
        <?php echo $tabla ?>
        <div>
            <a href="../NuevoAuto.php" class="btn btn-secondary btn-steam2"> Volver </a>
        </div>
    </div>

<?php include_once STRUCTURE_PATH.'/Foot.php';?>