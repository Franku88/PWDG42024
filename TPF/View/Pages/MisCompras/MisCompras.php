<?php
include_once '../../../configuracion.php';
include STRUCTURE_PATH . '/HeadSafe.php';
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
            method: 'POST',
            data: {
                idusuario: <?php echo $usuario->getIdusuario()?>
            },
            dataType: 'json',
            success: function(response) {
               var tableContent = '';
               $.each(response , function(index, compra) {
                     tableContent += `<tr> <td> ${compra.cofecha} </td> <td>`;
                     $.each(compra.items, function(index, item){
                          tableContent += `${item.pronombre} x ${item.cicantidad} <br>`;
                     });
                     tableContent += `</td> <td> ${compra.estado} </td> </tr>`;
               })
               $('#comprasPersonalesTable tbody').append(tableContent);

            },
            error: function() {
                alert('Error al cargar compras.');
            }
        });    
    }
</script>

<?php include STRUCTURE_PATH . '/Foot.php'; ?>