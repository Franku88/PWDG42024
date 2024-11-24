<?php
include_once '../../../configuracion.php';
include STRUCTURE_PATH . '/HeadSafe.php';
//ESTE BLOQUE DEBE SER PERSONALIZADO PARA CADA PAGINA CON HEAD SAFE (ESTABLECER SU ID)
$menuesFiltrados = array_filter($menues, function($menu) {
    return ($menu->getIdmenu()) == 8; //8 es el id del menu MisCompras
});

if (empty($menuesFiltrados)) {
    echo("Sesión inválida"); //Puede embellecerse un poco más
    //header("Location: ".ROOT_PATH."/index.php");
    exit();
}
//-------------------------------------------------------------------------------------
?>

<div class="d-flex justify-content-center align-items-start gap-3">
   <!-- Tabla de Productos -->
   <div class="mt-5" style="max-width: 65%; padding: 20px;">
      <h1 class="text-center">Mis Compras</h1>
      <table class="table table-bordered table-striped" id="productosTable" style="width: 100%;">
         <thead class="thead-dark">
            <tr>
               <th>Producto</th>
               <th>Fecha</th>
               <th>Cantidad</th>
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
    $(document).ready(function () {
        function cargarCompras() {

            $.ajax({
                url: 'Action/ListarCompras.php', // Archivo PHP backend
                method: 'POST', // Método HTTP
                data: { usuarioid: <?php echo $sesion->getUsuario()->getIdusuario(); ?> }, // Datos a enviar
                dataType: 'json', // Esperamos una respuesta JSON
                success: function (response) {
                   console.log(response)
                    const tableBody = $('#productosTable tbody');
                    tableBody.empty(); // Limpiamos la tabla antes de llenarla

                    if (response.mensaje) {
                        // Si hay un mensaje, lo mostramos en la tabla
                        tableBody.append('<tr><td colspan="4" class="text-center">' + response.mensaje + '</td></tr>');
                        return;
                    }

                    // Si no hay mensaje, entonces se procesan las compras
                    response.forEach(compra => {
                        tableBody.append(`
                            <tr>
                                <td>${compra.producto}</td>
                                <td>${compra.fecha}</td>
                                <td>${compra.cantidad}</td>
                                <td>${compra.estado}</td>
                            </tr>
                        `);
                    });
                },
                error: function () {
                    alert('Ocurrió un error al cargar las compras.');
                }
            });
        }

        // Llamamos a la función al cargar la página
        cargarCompras();
    });
</script>


<?php include STRUCTURE_PATH . '/Foot.php'; ?>
