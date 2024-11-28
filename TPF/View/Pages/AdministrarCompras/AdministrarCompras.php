<?php
include_once "../../../configuracion.php";
include STRUCTURE_PATH . "/HeadSafe.php";
?>

<div class="d-flex justify-content-center align-items-start gap-3">

    <!-- Tabla de compras -->
    <div class="mt-5 text-center d-flex flex gap-5" style="max-width: 100%; padding: 20px;">
        <div>
            <h1>Compras Entrantes</h1>
            <table class="table table-bordered table-striped" id="comprasEntrantesTable" style="width: 100%;">
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
        <div>
            <h1>Compras concretadas</h1>
            <table class="table table-bordered table-striped" id="comprasConcretadasTable" style="width: 100%;">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th> <!-- id de compraestado -->
                        <th>Estado</th> <!-- idcompraestadotipo en compraestado -->
                        <th>Fecha Inicio</th> <!-- fechaInicio en compraestado -->
                        <th>Fecha Fin</th> <!-- fechaFin en compraestado -->
                        <th>Usuario</th> <!-- usuario relacionado con la compra -->
                    </tr>
                </thead>
                <tbody>
                    <!-- Las compras serán cargadas dinámicamente aquí -->
                </tbody>
            </table>
        </div>
        <div>
            <h1>Compras canceladas</h1>
            <table class="table table-bordered table-striped" id="comprasCanceladasTable" style="width: 100%;">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th> <!-- id de compraestado -->
                        <th>Estado</th> <!-- idcompraestadotipo en compraestado -->
                        <th>Fecha Inicio</th> <!-- fechaInicio en compraestado -->
                        <th>Fecha Fin</th> <!-- fechaFin en compraestado -->
                        <th>Usuario</th> <!-- usuario relacionado con la compra -->
                    </tr>
                </thead>
                <tbody>
                    <!-- Las compras serán cargadas dinámicamente aquí -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        cargarComprasEntrantes();
        cargarComprasConcretadas();
        cargarComprasCanceladas();
    });

    function cargarComprasEntrantes() {
        $.ajax({
            url: 'Action/ListarEntrantes.php',
            method: 'GET',
            data: 'todo',
            dataType: 'json',
            success: function(response) {
                var tableContent = '';
                $.each(response, function(index, compra) {
                    tableContent += `
                            <tr id="compra-${compra.idcompra}">
                                <td>${compra.idcompra}</td>
                                <td>${compra.estado}</td>
                                <td>${compra.fechaInicio}</td>
                                <td>${compra.fechaFin ?? 'N/A'}</td>
                                <td>${compra.usuario}</td>
                                <td>
                                    <button class="btn btn-success" onclick="enviarCompra(${compra.idcompraEstado})">Enviar</button>
                                    <button class="btn btn-danger" onclick="cancelarCompra(${compra.idcompraEstado})">Cancelar</button>
                                </td>
                            </tr>
                        `;
                });
                $('#comprasEntrantesTable tbody').html(tableContent);
            }

        });
    }

    function cargarComprasConcretadas() {
        $.ajax({
            url: 'Action/ListarConcretadas.php',
            method: 'GET',
            data: 'todo',
            dataType: 'json',

            success: function(response) {
                var tableContent = '';
                $.each(response, function(index, compra) {
                    tableContent += `
                            <tr id="compra-${compra.idcompra}">
                                <td class="bg-success text-white" >${compra.idcompra}</td>
                                <td class="bg-success text-white" >${compra.estado}</td>
                                <td class="bg-success text-white" >${compra.fechaInicio}</td>
                                <td class="bg-success text-white" >${compra.fechaFin ?? 'N/A'}</td>
                                <td class="bg-success text-white" >${compra.usuario}</td>
                            </tr>
                        `;
                });
                $('#comprasConcretadasTable tbody').html(tableContent);
            }
        })
    }

    function cargarComprasCanceladas() {
        $.ajax({
            url: 'Action/ListarCanceladas.php',
            method: 'GET',
            data: 'todo',
            dataType: 'json',

            success: function(response) {
                var tableContent = '';
                $.each(response, function(index, compra) {
                    tableContent += `
                            <tr id="compra-${compra.idcompra}">
                                <td class="bg-danger text-white">${compra.idcompra}</td>
                                <td class="bg-danger text-white">${compra.estado}</td>
                                <td class="bg-danger text-white">${compra.fechaInicio}</td>
                                <td class="bg-danger text-white">${compra.fechaFin ?? 'N/A'}</td>
                                <td class="bg-danger text-white">${compra.usuario}</td>
                            </tr>
                        `;
                });
                $('#comprasCanceladasTable tbody').html(tableContent);
            }
        })
    }

    function cancelarCompra(idcompraEstado) {
        if (confirm("¿Desea cancelar la compra?")) {
            $.ajax({
                url: 'Action/CambiarEstado.php',
                method: 'POST',
                data: {
                    accion: 'cancelar',
                    idcompraestado: idcompraEstado,
                    idnuevoestadotipo: 4
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        cargarComprasEntrantes();
                        cargarComprasConcretadas();
                        cargarComprasCanceladas();
                    }
                }
            });
        }

    }

    function enviarCompra(idcompraEstado) {
        if (confirm("¿Desea enviar la compra?")) {
            $.ajax({
                url: 'Action/CambiarEstado.php',
                method: 'POST',
                data: {
                    accion: 'enviar',
                    idcompraestado: idcompraEstado,
                    idnuevoestadotipo: 3
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        cargarComprasEntrantes();
                        cargarComprasConcretadas();
                        cargarComprasCanceladas();
                    }
                }
            });
        }
    }
</script>


<?php include STRUCTURE_PATH . "/Foot.php"; ?>