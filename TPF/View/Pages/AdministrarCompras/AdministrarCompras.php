<?php
include_once "../../../configuracion.php";
include STRUCTURE_PATH . "/HeadSafe.php";

// FILTRO DE PERMISOS: Verifica que el usuario tenga acceso al menú correspondiente
$menuesFiltrados = array_filter($menues, function ($menu) {
    return ($menu->getIdmenu()) == 5; // 5 es el ID del menú AdministrarProductos
});

if (empty($menuesFiltrados)) {
    echo ("<div class='alert alert-danger text-center mt-5'>Sesión inválida. Acceso denegado.</div>");
    exit();
}

// $compras = (new ABMCompraEstado())->buscar();
// echo '<pre>';
// // print_r($compras[0]);
// print_r($compras[0]->getObjCompra()->getIdcompra());
// echo "<br>";
// print_r($compras[0]->getObjCompraEstadoTipo()->getCetdescripcion());
// echo "<br>";
// print_r($compras[0]->getObjCompra()->getObjUsuario()->getUsnombre());
// echo "<br>";
// print_r($compras[0]->getCefechaini());
// echo "<br>";
// print_r($compras[0]->getCefechafin()); // es null, hasta que se cierre la compra. seria idcompraestadotipo = 3
// echo '</pre>';



?>

<div class="d-flex justify-content-center align-items-start gap-3">

    <!-- Tabla de compras -->
    <div class="mt-5 text-center" style="max-width: 75%; padding: 20px;">
        <h1>Administrar Compras</h1>
        <table class="table table-bordered table-striped" id="comprasTable" style="width: 100%;">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th> <!-- id de compraestado -->
                    <th>Estado</th> <!-- idcompraestadotipo en compraestado -->
                    <th>Fecha Inicio</th> <!-- fechaInicio en compraestado -->
                    <th>Fecha Fin</th> <!-- fechaFin en compraestado -->
                    <th>Usuario</th> <!-- usuario relacionado con la compra -->
                    <th>Acción</th> <!-- Botones de acción -->
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
        cargarCompras();

        function cargarCompras() {
            $.ajax({
                url: 'Action/ListarCompras.php',
                method: 'GET',
                data: 'todo',
                dataType: 'json',
                success: function(response) {
                    var tableContent = '';
                    $.each(response, function(index, compra) {
                            // en base al estado de la compra cambiamos los botones de la accion


                        tableContent += `
                            <tr id="compra-${compra.idcompra}">
                                <td>${compra.idcompra}</td>
                                <td>${compra.estado}</td>
                                <td>${compra.fechaInicio}</td>
                                <td>${compra.fechaFin ?? 'N/A'}</td>
                                <td>${compra.usuario}</td>
                                <td>
                                    <button class="btn btn-success" onclick="gestionarCompra(${compra.idcompra}, 2)">Aceptar</button>
                                    <button class="btn btn-danger" onclick="gestionarCompra(${compra.idcompra}, 3)">Cancelar</button>

                                </td>
                            </tr>
        `;
                    });
                    $('#comprasTable tbody').html(tableContent);
                }

            });
        }

        window.gestionarCompra = function(idcompra, accion) {
            $.ajax({
                url: 'Action/EstadoCompra.php',
                method: 'POST',
                data: {
                    idcompra: idcompra,
                    accion: accion
                },
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    if (response.success) {
                        alert(response.message);
                        cargarCompras();
                    } else {
                        alert(response.message);
                    }
                },
                error: function() {
                    alert("Ocurrió un error al realizar la acción.");
                }
            });
        };




    });
</script>


<?php include STRUCTURE_PATH . "/Foot.php"; ?>