<?php
include_once '../../../configuracion.php';
include STRUCTURE_PATH . '/HeadSafe.php';
//ESTE BLOQUE DEBE SER PERSONALIZADO PARA CADA PAGINA CON HEAD SAFE (ESTABLECER SU ID)
$menuesFiltrados = array_filter($menues, function ($menu) {
    return ($menu->getIdmenu()) == 8; //8 es el id del menu MisCompras
});

if (empty($menuesFiltrados)) {
    echo ("Sesión inválida"); //Puede embellecerse un poco más
    //header("Location: ".ROOT_PATH."/index.php");
    exit();
}

$usuarioID = 'hola';


//-------------------------------------------------------------------------------------
?>

<div class="d-flex justify-content-center align-items-start gap-3">
    <!-- Tabla de Productos -->
    <div class="mt-5" style="max-width: 65%; padding: 20px;">
        <h1 class="text-center">Mis Compras</h1>
        <table class="table table-bordered table-striped" id="comprasPersonalesTable" style="width: 100%;">
            <thead class="thead-dark">
                <tr>
                    <th>Fecha</th>
                    <th>Productos</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <!-- Las compras serán cargadas dinámicamente aquí -->
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function() {
        listarComprasPersonales();
    });

    function listarComprasPersonales() {
        $.ajax({
            url: 'Action/ListarCompras.php',
            method: 'GET',
            data: {
                usuarioID: '<?php echo $usuarioID; ?>'
            },
            dataType: 'json',
            success: function(response) {
                console.log(response);
            }

        });
    }
</script>


<?php include STRUCTURE_PATH . '/Foot.php'; ?>