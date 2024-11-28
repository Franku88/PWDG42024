<?php
include_once '../../../configuracion.php';
include STRUCTURE_PATH . '/HeadSafe.php';
?>

<div class="d-flex justify-content-center align-items-start gap-3">
    <!-- Tabla de Productos -->
    <div class="mt-5" style="max-width: 100%; padding: 20px; width:900px;">
        <h1 class="text-center">Mis Compras</h1>
        <table class="table table-bordered table-striped" id="comprasPersonalesTable" style="width: 100%;">
            <thead class="thead-dark">
                <tr>
                    <th>Fecha</th>
                    <th>Productos</th>
                    <th>Total</th>
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
                idusuario: <?php echo $usuario->getIdusuario(); ?>
            },
            dataType: 'json',
            success: function(response) {
                var tableContent = '';

                $.each(response, function(index, compra) {
                    var estadoClass = '';
                    if (compra.estado == 'Cancelada') {
                        estadoClass = 'bg-danger text-white';
                    } else if (compra.estado == 'Enviada') {
                        estadoClass = 'bg-success text-white';
                    } else if (compra.estado == 'Aceptada') {
                        estadoClass = 'bg-primary text-white';
                    }

                    tableContent += `
                        <tr>
                            <td class="${estadoClass}">${compra.cofecha}</td>
                            <td class="${estadoClass}">
                    `;

                    // Agregamos los productos dentro de la celda
                    $.each(compra.items, function(index, item) {
                        tableContent += `${item.pronombre} x ${item.cicantidad}<br>`;
                    });
                    // sumamos los precios de cada item y los agregamos al total
                    let total = 0;
                    $.each(compra.items, function(index, item) {
                        total += item.proprecio * item.cicantidad;
                    });
                    tableContent += `
                            </td>
                            <td class="${estadoClass}">$${total}</td>
                    `;

                    tableContent += `
                            </td>
                            <td class="${estadoClass}">${compra.estado}</td>
                        </tr>
                    `;
                });

                $('#comprasPersonalesTable tbody').html(tableContent);
            },
            error: function() {
                alert('Error al cargar compras.');
            }
        });
    }
</script>


<?php include STRUCTURE_PATH . '/Foot.php'; ?>