<?php
include_once '../../../configuracion.php';
include STRUCTURE_PATH . '/Head.php';
?>

<div class="container">
    <h1>Carrito de compras</h1>
    <div class="row" id="catalogo" ></div> <!-- Aquí se cargarán los productos -->
</div>

<script>
    $(document).ready(function() {
        // Realizar la solicitud AJAX
        $.ajax({
            url: 'Action/testcarritoAction.php', // Ruta al script PHP que genera los datos
            method: 'POST',
            data: 'todo',
            dataType: 'json',
            success: function(response) {
                console.log(response);
                var htmlContent = '';
                // Iterar sobre los productos y construir el HTML
                $.each(response, function(index, producto) {
                    htmlContent += `
                <ul class="list-group bg-steam-lightgreen bdr-steam-nofocus  text-center p-2 my-3" style="max-height: 200px>
                <li class="list-group-item bg-steam-lightgreen bdr-steam-nofocus  text-center p-2 h-75">
                    <div class="card bg-steam-lightgreen bdr-steam-nofocus h-auto">
                        <div class="row g-0">
                            <div class="col-md-8">
                            <img src="${producto.icon}" class="img-fluid rounded-start float-start" style="max-height: 150px; max-width: 150px" alt="${producto.pronombre}">                            
                            <div class="card-body">
                            <h5 class="card-title">${producto.pronombre}</h5>
                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                            </div>
                            </div>
                            <div class="col align-content-center">              
                                <a href="#" class="btn btn-primary m-4 boton_eliminar" id="${producto.idproducto}">Remover</a>
                                <a href="#" class="btn btn-primary m-4 boton_comprar">Comprar</a>
                            </div>
                        </div>
                    </div>

                    </li>
                </ul>
                `;
                });
                // Insertar el HTML generado en el contenedor
                $('#catalogo').html(htmlContent);
            },
            error: function() {
                alert('Error al cargar el catálogo.');
            }
        });
    });
</script>


<?php include STRUCTURE_PATH . '/Foot.php'; ?>