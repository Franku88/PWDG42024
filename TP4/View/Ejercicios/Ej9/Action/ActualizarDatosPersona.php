<?php
include_once '../../../../configuracion.php';
// include_once ROOT_PATH.'/Util/funciones.php'; Lo carga el autoloader.php
// include_once ROOT_PATH.'/Controller/ABMPersona.php'; Lo carga el autoloader.php

$data = Funciones::data_submitted();  // Cambiado a clase Funciones, función data_submitted() cambiada a public static

$resultado = "<div class='alert alert-warning border-steam-inactivo'>
                <h5> Datos no recibidos.</h5>
            </div>";

if (!empty($data)) {
    $arrPersona = (new ABMPersona())->buscar(['NroDni'=>(trim($data['nrodni']))]);
    if (!empty($arrPersona)) {
        $personaModificada = [
            'NroDni'=> ($arrPersona[0]->getNroDni()),
            'Apellido'=> (trim($data['apellido'])),
            'Nombre'=> (trim($data['nombre'])),
            'fechaNac'=> (trim($data['fechanac'])),
            'Telefono'=> (trim($data['codarea'].'-'.$data['numlocal'])),
            'Domicilio'=> (trim($data['domicilio']))
        ];
        if ((new ABMPersona())->modificacion($personaModificada)) {
            $resultado = "<div class='alert alert-success border-steam-inactivo'>
            <h5> Persona con DNI '".trim($data['nrodni'])."' modificada con exito.</h5>
            </div>";
        } else {
            $resultado = "<div class='alert alert-warning border-steam-inactivo'>
            <h5> Cambios no realizados, algún dato no válido en la BD.</h5>
            </div>";
        }
    } else {
        $resultado = "<div class='alert alert-warning border-steam-inactivo'>
            <h5> Persona con DNI '".trim($data['nrodni'])."' no se encuentra registrada.</h5>
            </div>";
    }
}
?>

<?php include_once STRUCTURE_PATH.'/Head.php';?>
    <div class="container mt-5">
        <?php echo $resultado;?>
        <div>
            <form action='accionBuscarPersona.php'>
            <input class='d-none' type='text' name='nrodni' id='nrodni' value='<?php echo trim($data['nrodni'])?>' readonly> 
            <button class="btn btn-secondary btn-steam2" type='submit'> Volver </button>
            </form>
        </div>
    </div>

<?php include_once STRUCTURE_PATH.'/Foot.php';?>