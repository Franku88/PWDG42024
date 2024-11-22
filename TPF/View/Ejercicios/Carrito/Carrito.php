<?php
include_once "../../../configuracion.php";
include STRUCTURE_PATH . "/HeadSafe.php"; 

//ESTE BLOQUE DEBE SER PERSONALIZADO PARA CADA PAGINA CON HEAD SAFE (ESTABLECER SU ID)
$menuesFiltrados = array_filter($menues, function($menu) {
    return ($menu->getIdmenu()) == 7; //7 es el id del menu Carrito
});

if (empty($menuesFiltrados)) {
    echo("Sesión inválida"); //Puede embellecerse un poco más
    //header("Location: ".ROOT_PATH."/index.php");
    exit();
}
//-------------------------------------------------------------------------------------
?>

<div class="container">
    <h1>Carrito de compras</h1>
    <div class="row" id="catalogo"></div> <!-- Aquí se cargarán los productos -->
</div>


<script>
    $(document).ready(function() {
        // Obtener el arreglo de productos desde sessionStorage
        const productosLS = JSON.parse(sessionStorage.getItem('carrito')) || [];
        // Realizar la solicitud AJAX
        $.ajax({
            url: 'Action/testcarritoAction.php', // Ruta al script PHP que genera los datos
            method: 'POST',
            data: 'todo',
            dataType: 'json',
            success: function(response) {
                console.log(response)
                var htmlContent = '';
                var respuestaEncontrado = false
                $.each(response, function(index, encontrado) {
                    const prodLS = productosLS.find(p => p.idproducto === encontrado.idproducto);
                    const cantidad = prodLS ? prodLS.cicantidad : null;
                    console.log(prodLS)
                    console.log(cantidad)
                    if (typeof prodLS !== 'undefined') {
                        respuestaEncontrado = true
                    }
                    console.log(respuestaEncontrado)
                })
                console.log(respuestaEncontrado)

                // Iterar sobre los productos y construir el HTML
                $.each(response, function(index, producto) {
                    const prodLS = productosLS.find(p => p.idproducto === producto.idproducto);
                    const cantidad = prodLS ? prodLS.cicantidad : null;
                    if (respuestaEncontrado) {
                        htmlContent += `
                <ul class="list-group bg-steam-lightgreen bdr-steam-nofocus p-2 my-3" style="max-height: 100px" >
                <li class="list-group-item bg-steam-lightgreen bdr-steam-nofocus p-2 h-100">                    
                        <div class="row g-0 h-100">
                            <div class="col-md-9 g-0 h-100">
                                <img src="${producto.icon}" class="img-fluid rounded-start float-start h-100" style="max-width:60px" alt="${producto.pronombre}">                            
                                    <div class="float-start ps-4">
                                        <h5 class="">${producto.pronombre}</h5>
                                        <p class="">${producto.prodetalle}</p>
                                    </div>
                            </div>
                            <div class="col-md-3 align-content-center">
                                <div class="float-start" id="${producto.idproducto}">  
                                    <a href="#" class="btn btn-primary btn-steam boton_resta mx-1" id="${producto.idproducto}">-</a>           
                                    <span class="cantidad_carrito">${cantidad}</span> 
                                    <a href="#" class="btn btn-primary btn-steam boton_suma mx-1" id="${producto.idproducto}">+</a>
                                </div>
                                <div class="float-end">
                                    <a href="#" class="btn btn-primary btn-steam boton_comprar">Comprar</a>
                                </div>
                            </div>
                        </div>               
                    </li>
                </ul>
                `;
                    } else {
                        htmlContent = `<div>Carrito vacío</div>`
                    }
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