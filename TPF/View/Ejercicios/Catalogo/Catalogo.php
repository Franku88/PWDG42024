<?php
    include_once "../../../configuracion.php";
    include STRUCTURE_PATH."/Head.php"
?>

<!-- TABLA DONDE SE PLASMAN LOS ELEMENTOS DE LA BD -->
<!-- <div class=''>
    <table id="dg" title="Productos" class="easyui-datagrid" url="Action/listarProductos.php" toolbar="#toolbar" 
    pagination="true" rownumbers="true" fitColumns="true" singleSelect="true">
        <thead class="">
            <tr>
                <th field="icon" width="50">Icono</th>
                <th field="idproducto" width="50">ID</th>
                <th field="pronombre" width="50">Nombre</th>
                <th field="proprecio" width="50">Precio</th>
            </tr>
        </thead>
    </table>
</div> -->
<!-- TABLA DONDE SE PLASMAN LOS ELEMENTOS DE LA BD -->


<div class="container">
    <h1>Catálogo de Productos</h1>
    <div class="row" id="catalogo"></div> <!-- Aquí se cargarán los productos -->
</div>

<script>
$(document).ready(function(){
    // Realizar la solicitud AJAX
    $.ajax({
        url: 'Action/ListarProductos.php', // Ruta al script PHP que genera los datos
        method: 'POST',
        data: 'todo',
        dataType: 'json',
        success: function(response) {
            console.log(response);
            var htmlContent = '';
            // Iterar sobre los productos y construir el HTML
            $.each(response, function(index, producto) {
                htmlContent += `
                    <div class="col-md-4 my-3" id="${producto.idproducto}">
                        <div class="card" style="width: 18rem;">
                            <img src="${producto.icon}" class="card-img-top" alt="${producto.pronombre}">
                            <div class="card-body">
                                <h5 class="card-title">${producto.pronombre}</h5>
                                <a href="#" class="btn btn-primary">Ver Detalles</a>
                            </div>
                        </div>
                    </div>
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

<?php include STRUCTURE_PATH."/Foot.php"?>