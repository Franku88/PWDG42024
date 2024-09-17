<?php
include_once '../../../../configuracion.php';
// include_once ROOT_PATH.'/Util/funciones.php'; Lo carga el autoloader.php
// include_once ROOT_PATH.'/Controller/ABMPersona.php';  Lo carga el autoloader.php

$data = Funciones::data_submitted(); // Cambiado a clase Funciones, función data_submitted() cambiada a public static

$resultado = "<div class='alert alert-warning border-steam-inactivo'>
                <h5> Datos no recibidos.</h5>
            </div>";

if (!empty($data)) {
    $arrPersona = (new ABMPersona())->buscar(['NroDni'=>($data['nrodni'])]);
    if (empty($arrPersona)) {
        $nuevaPersona = [
            'NroDni'=> (trim($data['nrodni'])),
            'Apellido'=> (trim($data['apellido'])),
            'Nombre'=> (trim($data['nombre'])),
            'fechaNac'=> (trim($data['fechanac'])),
            'Telefono'=> (trim($data['codarea'].'-'.$data['numlocal'])),
            'Domicilio'=> (trim($data['domicilio']))
        ];
        if((new ABMPersona())->alta($nuevaPersona)) {
            $resultado = "<div class='alert alert-success border-steam-inactivo'>
            <h5> Persona registrada con exito.</h5>
            </div>
            <div class='mb-1'>
                    <a href='../../Ej5/listaPersonas.php' class='btn btn-secondary btn-steam2'> Ver personas </a>
            </div>";
        } else {
            $resultado = "<div class='alert alert-warning border-steam-inactivo'>
            <h5> Alta no realizada, algún dato no válido en la BD.</h5>
            </div>";
        }
    } else {
        $resultado = "<div class='alert alert-warning border-steam-inactivo'>
            <h5> Persona con DNI '".trim($data['nrodni'])."' ya se encuentra registrada.</h5>
            </div>";
    }
}
?>

<?php include_once STRUCTURE_PATH.'/Head.php';?>
 
    <div class="container mt-5">
        <?php echo $resultado;?>
        <div>
            <a href="../NuevaPersona.php" class="btn btn-secondary btn-steam2"> Volver </a>
        </div>
    </div>

<?php include_once STRUCTURE_PATH.'/Foot.php';?>