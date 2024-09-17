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
    $arrAuto = (new ABMAuto())->buscar(['Patente'=>(strtoupper($data['patente']))]);
    if (empty($arrAuto)) {
        $arrPersona = (new ABMPersona())->buscar(['NroDni'=>($data['dniduenio'])]);
        if (!empty($arrPersona)) {
            $nuevoAuto = [
                'Patente'=> (trim(strtoupper($data['patente']))),
                'Marca'=> (trim($data['marca'])),
                'Modelo'=> (trim($data['modelo'])),
                'Duenio'=> ($arrPersona[0])
            ];
            if ((new ABMAuto())->alta($nuevoAuto)) {
                $resultado = "<div class='alert alert-success border-steam-inactivo'>
                <h5> Auto registrado con exito.</h5>
                </div>
                <div class='mb-1'>
                    <a href='../../Ej3/verAutos.php' class='btn btn-secondary btn-steam2'> Ver autos </a>
                </div>";
            } else {
                $resultado = "<div class='alert alert-warning border-steam-inactivo'>
                <h5> Alta no realizada, algún dato no válido en la BD.</h5>
                </div>";
            }
        } else {
            $resultado = "<div class='alert alert-warning border-steam-inactivo'>
                <h5> Persona con DNI '".trim($data['dniduenio'])."' no se encuentra registrada.
                Registrela e intente nuevamente.</h5>
                </div>
                <div class='mb-1'>
                    <a href='../../Ej6/NuevaPersona.php' class='btn btn-secondary btn-steam2'> Registrar Persona </a>
                </div>";
        }
    } else {
        $resultado = "<div class='alert alert-warning border-steam-inactivo'>
                <h5> Auto con pantente '".trim($data['patente'])."' ya se encuentra registrado.</h5>
                </div>";
    }
}
?>

<?php include_once STRUCTURE_PATH.'/Head.php';?>
 
    <div class="container mt-5">
        <?php echo $resultado;?>
        <div>
            <a href="../NuevoAuto.php" class="btn btn-secondary btn-steam2"> Volver </a>
        </div>
    </div>

<?php include_once STRUCTURE_PATH.'/Foot.php';?>