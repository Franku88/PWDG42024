<?php
include_once "../../../configuracion.php";
include STRUCTURE_PATH . "/HeadSafe.php";

$sessionValida = $session->validar();
if ($sessionValida) {
    $usuarioId = $session->getUsuario()->getIdusuario();
} else {
    $usuarioId = 0;
}
//ESTE BLOQUE DEBE SER PERSONALIZADO PARA CADA PAGINA CON HEAD SAFE (ESTABLECER SU ID)
$menuesFiltrados = array_filter($menues, function ($menu) {
    return ($menu->getIdmenu()) == 7; //7 es el id del menu Carrito
});

if (empty($menuesFiltrados)) {
    echo ("Sesión inválida"); //Puede embellecerse un poco más
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
        const productosSS = JSON.parse(sessionStorage.getItem('carrito')) || [];

        // Realizar la solicitud AJAX
        $.ajax({
            url: 'Action/testcarritoAction.php', // Ruta al script PHP que genera los datos
            method: 'POST',
            data: 'todo',
            dataType: 'json',
            success: function(response) {

                let htmlContent = '';
                let respuestaEncontrado = false;

                // Verificar si hay coincidencias entre los productos del sessionStorage y la respuesta AJAX
                $.each(response, function(index, encontrado) {
                    const prodSS = productosSS.find(p => p.idproducto === encontrado.idproducto);
                    if (prodSS) {
                        respuestaEncontrado = true;
                    }
                });

                // Iterar sobre los productos y construir el HTML
                $.each(response, function(index, producto) {
                    const prodSS = productosSS.find(p => p.idproducto === producto.idproducto);
                    const cantidad = prodSS ? prodSS.cicantidad : null;

                    if (respuestaEncontrado && cantidad != null) {
                        htmlContent += `
                        <ul class="list-group bg-steam-lightgreen bdr-steam-nofocus p-2 my-3" style="max-height: 100px;">
                            <li class="list-group-item bg-steam-lightgreen bdr-steam-nofocus p-2 h-100">
                                <div class="row g-0 h-100">
                                    <div class="col-md-8 g-0 h-100">
                                        <img src="${producto.icon}" class="img-fluid rounded-start float-start h-100" style="max-width:60px" alt="${producto.pronombre}">
                                        <div class="float-start ps-4 h-100">
                                            <h5>${producto.pronombre}</h5>                                            
                                        </div>
                                    </div>
                                    <div class="col align-content-center">
                                        <div class="float-end" id="${producto.idproducto}">
                                            <a href="#" class="btn btn-primary btn-steam boton_resta mx-1" id="${producto.idproducto}">-</a>
                                            <span class="cantidad_carrito">${cantidad}</span>
                                            <a href="#" class="btn btn-primary btn-steam boton_suma mx-1" id="${producto.idproducto}">+</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    `;
                    }
                });

                // Si el carrito está vacío, mostrar mensaje de "Carrito vacío"
                if (htmlContent === '') {
                    htmlContent = `<div>Carrito vacío</div>`;
                } else {
                    // Agregar botón de "Vaciar carrito" si hay elementos
                    htmlContent += `
                    <div class="container p-0 m-0">
                        <div class="row row-cols 2">
                            <div class="col" id="vaciarCarritoContainer">
                                <button class="btn btn-primary btn-steam boton_eliminar">
                                    <span>Vaciar carrito</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                    </svg>
                                </button>
                            </div>
                            <div class="col float-end" id="comprarContainer">
                                <div class="float-end">
                                    <button class="btn btn-primary btn-steam boton_comprar">Comprar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                }

                // Insertar el HTML generado en el contenedor
                $('#catalogo').html(htmlContent);
            },
            error: function() {
                alert('Error al cargar el catálogo.');
            }
        });


        $(document).on('click', '.boton_eliminar', function() {
            // Vaciar el carrito en sessionStorage
            sessionStorage.setItem('carrito', JSON.stringify([]));

            // Actualizar el contenido de la página
            $('#catalogo').html('<div>Carrito vacío</div>');

            // Remover el botón de "Vaciar carrito"
            $('#vaciarCarritoContainer').remove();
        });


        $(document).on('click', '.boton_comprar', function() {
            const idProductosCarro = productosSS.map(item => ({
                "idproducto": item.idproducto
            }));   
            var usuarioId = {idusuario : <?php echo json_encode($usuarioId); ?>};
            $.ajax({
                url: 'Action/confirmaCompraAction.php', // Ruta al script PHP que procesa los datos
                method: 'POST', // Método de la solicitud
                data: usuarioId,// Dato que se enviará al servidor,
                dataType: 'json', // El tipo de datos que se espera recibir como respuesta                
                success: function(response) {                    
                    if (response) {
                        // Verificar si el servidor indicó que la operación fue exitosa
                        alert('Compra ingresada correctamente.');
                    } else {
                        // Manejo de errores devueltos por el servidor
                        alert('Hubo un problema al procesar la compra: ');
                    }
                },
                error: function(xhr, status, error) {
                    // Manejo de errores de la solicitud AJAX

                    alert('Error al procesar la solicitud: ');
                }
            });

            $.ajax({
                url: 'Action/testcarritoAction.php', // Ruta al script PHP que genera los datos
                method: 'POST',
                data: {
                    idProductosCarro
                },
                dataType: 'json',
                success: function(totalProd) {
                    // Filtrar los productos que coincidan
                    const productosFiltrados = totalProd.filter(prod =>
                        idProductosCarro.some(p => p.idproducto === prod.idproducto)
                    );

                    // Mostrar los productos filtrados
                    // console.log(productosFiltrados);


                },
                error: function() {
                    alert('Error al cargar el catálogo.');
                }
            });


            // sessionStorage.setItem('carrito', JSON.stringify([]));

            // // Actualizar el contenido de la página
            // $('#catalogo').html('<div>Carrito vacío</div>');

            // // Remover el botón de "Vaciar carrito"
            // $('#vaciarCarritoContainer').remove();

            // alert('Muchas gracias por su compra')
            // window.location.href='<?php echo BASE_URL; ?>/View/Ejercicios/Catalogo/Catalogo.php';
        });

    });
</script>


<?php include STRUCTURE_PATH . '/Foot.php'; ?>