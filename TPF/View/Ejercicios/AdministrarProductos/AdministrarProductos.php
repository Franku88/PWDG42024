<?php
include_once "../../../configuracion.php";
include STRUCTURE_PATH . "/Head.php";
?>

<div class="d-flex justify-content-center align-items-start gap-3">

    <!-- Tabla de Productos -->
    <div class="mt-5" style="max-width: 45%; padding: 20px;">
        <h1>Administrar Productos</h1>
        <table class="table table-bordered table-striped" id="productosTable" style="width: 100%;">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Detalle</th>
                    <th>Stock</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- Los productos serán cargados dinámicamente aquí -->
            </tbody>
        </table>
    </div>

    <!-- Formulario Estático para Alta de Producto -->
    <div class="mt-5" style="max-width: 45%; padding: 20px;">
        <h2>Alta de Producto</h2>
        <form id="altaProductoForm">
            <div class="form-group">
                <label for="nombreAlta" class="text-white">Nombre</label>
                <input type="text" class="form-control" id="nombreAlta" name="nombreAlta" required>
            </div>
            <div class="form-group">
                <label for="detalleAlta" class="text-white">Detalle</label>
                <input type="text" class="form-control" id="detalleAlta" name="detalleAlta" required>
            </div>
            <div class="form-group">
                <label for="stockAlta" class="text-white">Stock</label>
                <input type="number" class="form-control" id="stockAlta" name="stockAlta" required>
            </div>
            <div class="form-group">
                <label for="precioAlta" class="text-white">Precio</label>
                <input type="number" class="form-control" id="precioAlta" name="precioAlta" required>
            </div>

            <button type="submit" class="btn btn-success mt-3">Crear producto</button>
        </form>
        <div class="d-flex flex-column justify-content-center align-items-center">
            <div id="errorMessage" class="text text-center mt-3 p-2 bg-danger rounded-3 w-100 text-white d-none"></div>
            <div id="successMessage" class="text text-center mt-3 p-2 bg-success rounded-3 w-100 text-white d-none"></div>
        </div>
    </div>


    <div class="mt-5" style="max-width: 45%; padding: 20px;">
        <h2>Modificar Producto</h2>
        <form id="modificarProductoForm">
        <div class="form-group">
                <label for="idproducto" class="text-white">Id</label>
                <input type="number" class="form-control" id="idproducto" name="idproducto" >
            </div>
            <div class="form-group">
                <label for="nombre" class="text-white">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" >
            </div>
            <div class="form-group">
                <label for="detalle" class="text-white">Detalle</label>
                <input type="text" class="form-control" id="detalle" name="detalle" >
            </div>
            <div class="form-group">
                <label for="stock" class="text-white">Stock</label>
                <input type="number" class="form-control" id="stock" name="stock" >
            </div>
            <div class="form-group">
                <label for="precio" class="text-white">Precio</label>
                <input type="number" class="form-control" id="precio" name="precio" >
            </div>

            <button type="submit" class="btn btn-primary mt-3">Actualizar producto</button>
        </form>
        <div class="d-flex flex-column justify-content-center align-items-center">
            <div id="errorMessageMod" class="text text-center mt-3 p-2 bg-danger rounded-3 w-100 text-white d-none"></div>
            <div id="successMessageMod" class="text text-center mt-3 p-2 bg-success rounded-3 w-100 text-white d-none"></div>
        </div>
    </div>

</div>

<script>
    $(document).ready(function() {
        cargarProductos();

        function cargarProductos() {
            $.ajax({
                url: 'Action/ListarProductos.php',
                method: 'POST',
                data: 'todo',
                dataType: 'json',
                success: function(response) {
                    var tableContent = '';
                    $.each(response, function(index, producto) {
                        tableContent += `
                        <tr id="producto-${producto.idproducto}">
                            <td>${producto.idproducto}</td>
                            <td>${producto.pronombre}</td>
                            <td>${producto.prodetalle}</td>
                            <td>${producto.procantstock}</td>
                            <td>${producto.proprecio}</td>
                            <td>
                                <button class="btn btn-danger btn-sm" onclick="bajaProducto(${producto.idproducto})">Eliminar</button>
                            </td>
                        </tr>
                    `;
                    });
                    $('#productosTable tbody').html(tableContent);
                },
                error: function() {
                    alert('Error al cargar los productos.');
                }
            });
        }

        // Manejo de alta de producto
        $('#altaProductoForm').submit(function(e) {
            e.preventDefault(); // Evita el envío por defecto del formulario
            $('#errorMessage').text('').removeClass('d-block').addClass('d-none');
            $('#successMessage').text('').removeClass('d-block').addClass('d-none');

            // Recopilación de los datos del formulario
            const formData = {
                nombre: $('#nombreAlta').val(),
                detalle: $('#detalleAlta').val(),
                stock: $('#stockAlta').val(),
                precio: $('#precioAlta').val()
            };

            // Envío de los datos a través de Ajax
            $.ajax({
                url: 'Action/AltaProducto.php',
                type: 'POST',
                data: formData,
                success: function(response) {
                    const res = JSON.parse(response);
                    if (res.success) {
                        $('#successMessage')
                            .text(res.message)
                            .removeClass('d-none')
                            .addClass('d-block');
                        cargarProductos(); // Recargar la lista de productos
                    } else {
                        $('#errorMessage')
                            .text(res.message)
                            .removeClass('d-none')
                            .addClass('d-block');
                    }
                },
                error: function() {
                    $('#errorMessage')
                        .text('Ocurrió un error al procesar la solicitud.')
                        .removeClass('d-none')
                        .addClass('d-block');
                }
            });
        });

        $('#modificarProductoForm').submit(function(e) {
            e.preventDefault(); // Evita el envío por defecto del formulario
            $('#errorMessageMod').text('').removeClass('d-block').addClass('d-none');
            $('#successMessageMod').text('').removeClass('d-block').addClass('d-none');

            var formData = {
                idproducto: parseInt($('#idproducto').val(), 10)
            }; // Convertir a entero
            
            if ($('#nombre').val().trim() != "") {
                formData.nombre = $('#nombre').val().trim();
            }
            if ($('#detalle').val().trim() != "") {
                formData.detalle = $('#detalle').val().trim();
            }
            if (!isNaN(parseInt($('#stock').val(), 10))) {
                formData.stock = parseInt($('#stock').val(), 10); // Validar si es NaN    
            }
            if (!isNaN(parseFloat($('#precio').val()))) {
                formData.precio = parseFloat($('#precio').val()); // Validar si es NaN
            }

            $.ajax({
                url: 'Action/ModificacionProductos.php',
                type: 'POST',
                data: formData,
                success: function(response) {
                    const res = JSON.parse(response);
                    //console.log(res);
                    if (res) {
                        $('#successMessageMod')
                            .text(res.message)
                            .removeClass('d-none')
                            .addClass('d-block');
                        cargarProductos(); // Recargar la lista de productos
                    } else {
                        $('#errorMessageMod')
                            .text(res.message)
                            .removeClass('d-none')
                            .addClass('d-block');
                    }
                },
                error: function() {
                    $('#errorMessageMod')
                        .text('Ocurrió un error al procesar la solicitud.')
                        .removeClass('d-none')
                        .addClass('d-block');
                }
            });
        });
    });
</script>

<?php include STRUCTURE_PATH . "/Foot.php"; ?>
