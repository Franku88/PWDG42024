<?php
include_once '../../../configuracion.php';
include STRUCTURE_PATH . '/Head.php';
$abmProducto = new ABMProducto();
$productos = $abmProducto->buscar();

$roles = ($session)->getRol();
$esCliente = false;
if (!empty($roles)) { //Si tiene roles
    $rolesFiltrados = (array_filter($roles, function ($cadaRol) {
        return $cadaRol->getRodescripcion() == 'Cliente'; //filtra array para que tenga solo los que cumplan la condicion
    }));
    $esCliente = !empty($rolesFiltrados); // Si no esta vacio, entonces encontro un rol Cliente
}
?>

<div class="container py-4">
    <h1 class="text-center mb-4">Productos</h1>
    <!-- Product Grid -->
    <div class="d-flex flex-wrap bg-steam-lightgreen bdr-steam-nofocus" id="catalogo">
    </div>
</div>

<script>
    $(document).ready(function() {
        // Realizar la solicitud AJAX
        $.ajax({
            url: 'Action/ListarProductos.php', // Ruta al script PHP que genera los datos
            method: 'POST',
            data: 'todo',
            dataType: 'json',
            success: function(response) {
                //console.log(response);
                var htmlContent = '';
                // Iterar sobre los productos y construir el HTML
                $.each(response, function(index, producto) {
                    htmlContent += `
                    <div class="d-flex w-100">
                        <div class="h-100 w-100 shadow-sm d-flex">
                            <!-- Product Details -->
                            <div class='card-body bg-steam-darkgreen bdr-steam-focus d-flex'>
                                <div class='align-self-center bdr-steam-nofocus m-1 p-1'>
                                    <!-- Product Image -->
                                    <img src='${producto.icon}'  width='100' height='100' alt='...'>
                                </div>

                                <div class='d-flex flex-column justify-content-center items-center mx-5'>
                                    <h5 class='card-title'> <a href='../Producto/Producto.php?idproducto=${producto.idproducto}'> ${producto.pronombre}</a> </h5>
                                    <p class='card-text'> Precio: $ ${producto.proprecio} </p>
                                </div>
                            </div>
                            <!-- Product Actions -->
                            <div class='d-flex bg-steam-lightgreen bdr-steam-nofocus'>
                                <div class="d-flex flex-column m-auto center text-center p-2">
                                    <div>
                                        <a class='btn btn-primary btn-steam w-100' href='../Producto/Producto.php?idproducto=${producto.idproducto}'>Ver detalles</a>
                                    </div>
                                    <div>
                                        <?php if ($usuarioRolId == 3) { //Inserta estos botones si el usuario es un cliente idrol = 3 ?> 
                                            <button class="btn btn-primary btn-steam boton_agregar w-100" id="${producto.idproducto}">Agregar al carro</button>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>`;
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