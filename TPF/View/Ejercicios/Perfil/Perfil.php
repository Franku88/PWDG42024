<?php
include_once '../../../configuracion.php';
include STRUCTURE_PATH . '/Head.php';

// // compras del usuario. Recibe un array con el objeto del usuario
// $compras = (new ABMCompra())->buscar(['usuario' => $usuario]);
// $compra = $compras[0]; // obtenemos la primera compra del usuario
// $compraItems = (new ABMCompraItem())->buscar(['compra' => $compra]); // obtenemos los items de la compra
// $compraItem = $compraItems[0]; // obj compra

// // nombre del producto
// $producto = (new ABMProducto())->buscar(['idproducto' => $compraItem->getObjProducto()])[0];
// $productoNombre = $producto->getPronombre();


// // estado de la compra 
// $compraEstado = (new ABMCompraEstado())->buscar(['compra' => $compra])[0];
// $estado = $compraEstado->getObjCompraEstadoTipo()->getCetdescripcion();

// // 1. Nombre del producto = $producto->getPronombre()
// //2. Fecha de la compra = $compra->getCofecha()
// //3. Cantidad de la compra = $compraItem->getCicantidad()
// //4. Estado de la compra = $compraEstado->getObjCompraEstadoTipo()->getCetdescripcion()



// // echo "<pre>";
// //    print_r($estado);
// // echo "</pre>";




$session = new Session();
$usuario = $session->getUsuario();
$usuarioId = $usuario->getIdusuario();

?>

<div class="d-flex justify-content-center align-items-start gap-3">
   <!-- Tabla de Productos -->
   <div class="mt-5" style="max-width: 65%; padding: 20px;">
      <h1 class="text-center">Mis Compras</h1>
      <table class="table table-bordered table-striped" id="productosTable" style="width: 100%;">
         <thead class="thead-dark">
            <tr>
               <th>Producto</th>
               <th>Fecha</th>
               <th>Cantidad</th>
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
    $(document).ready(function () {
        function cargarCompras() {

            $.ajax({
                url: 'Action/administrarCompras.php', // Archivo PHP backend
                method: 'POST', // Método HTTP
                data: { usuarioid: <?php echo $usuarioId; ?> }, // Datos a enviar
                dataType: 'json', // Esperamos una respuesta JSON
                success: function (response) {
                   console.log(response)
                    const tableBody = $('#productosTable tbody');
                    tableBody.empty(); // Limpiamos la tabla antes de llenarla

                    if (response.mensaje) {
                        // Si hay un mensaje, lo mostramos en la tabla
                        tableBody.append('<tr><td colspan="4" class="text-center">' + response.mensaje + '</td></tr>');
                        return;
                    }

                    // Si no hay mensaje, entonces se procesan las compras
                    response.forEach(compra => {
                        tableBody.append(`
                            <tr>
                                <td>${compra.producto}</td>
                                <td>${compra.fecha}</td>
                                <td>${compra.cantidad}</td>
                                <td>${compra.estado}</td>
                            </tr>
                        `);
                    });
                },
                error: function () {
                    alert('Ocurrió un error al cargar las compras.');
                }
            });
        }

        // Llamamos a la función al cargar la página
        cargarCompras();
    });
</script>


<?php include STRUCTURE_PATH . '/Foot.php'; ?>
