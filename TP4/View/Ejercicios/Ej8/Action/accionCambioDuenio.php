<?php
include_once '../../../../configuracion.php';
// include_once ROOT_PATH.'/Util/funciones.php'; Lo carga el autoloader.php
// include_once ROOT_PATH.'/Controller/ABMPersona.php'; Lo carga el autoloader.php
// include_once ROOT_PATH.'/Controller/ABMAuto.php'; Lo carga el autoloader.php

$data = Funciones::data_submitted(); // Cambiado a clase Funciones, función data_submitted() cambiada a public static

$resultado = "<div class='alert alert-warning border-steam-inactivo'>
                <h5> Datos no recibidos.</h5>
            </div>";

if (!empty($data)) {
    $arrAuto = (new ABMAuto())->buscar(['Patente'=>(trim(strtoupper($data['patente'])))]);
    if (!empty($arrAuto)) {
        $arrPersona = (new ABMPersona())->buscar(['NroDni'=>(trim($data['dniduenio']))]);
        if (!empty($arrPersona)) {
            if (($arrAuto[0]->getDuenio())->getNroDni() != trim($data['dniduenio'])) { //Verifica que no sea duenio actualmente
                $autoModificado = [
                    'Patente'=> ($arrAuto[0]->getPatente()),
                    'Marca'=> ($arrAuto[0]->getMarca()),
                    'Modelo'=> ($arrAuto[0]->getModelo()),
                    'Duenio'=> ($arrPersona[0])
                ];
                if ((new ABMAuto())->modificacion($autoModificado)) {
                    $resultado = "<div class='alert alert-success border-steam-inactivo'>
                    <h5> Dueño modificado con exito.</h5>
                    </div>
                    <div class='mb-1'>
                        <a href='../../Ej3/verAutos.php' class='btn btn-secondary btn-steam2'> Ver autos </a>
                    </div>";
                } else {
                    $resultado = "<div class='alert alert-warning border-steam-inactivo'>
                    <h5> Cambio no realizado, algún dato no válido en la BD.</h5>
                    </div>";
                }
            } else {
                $resultado = "<div class='alert alert-warning border-steam-inactivo'>
                    <h5> Persona con DNI '".trim($data['dniduenio'])."' ya es dueña del auto con pantente '".trim(strtoupper($data['patente']))."'.</h5>
                    </div>
                    <div class='mb-1'>
                        <a href='../../Ej3/verAutos.php' class='btn btn-secondary btn-steam2'> Ver autos </a>
                    </div>";
            }
        } else {
            $resultado = "<div class='alert alert-warning border-steam-inactivo'>
                <h5> Persona con DNI '".trim($data['dniduenio'])."' no se encuentra registrada.</h5>
                </div>";
        }
    } else {
        $resultado = "<div class='alert alert-warning border-steam-inactivo'>
                <h5> Auto con pantente '".trim(strtoupper($data['patente']))."' no se encuentra registrado.</h5>
                </div>";
    }
}
?>

<?php include_once STRUCTURE_PATH.'/Head.php';?>
 
    <div class="container mt-5">
        <?php echo $resultado;?>
        <div>
            <a href="../CambioDuenio.php" class="btn btn-secondary btn-steam2"> Volver </a>
        </div>
    </div>

<?php include_once STRUCTURE_PATH.'/Foot.php';?>