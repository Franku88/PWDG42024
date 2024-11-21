$(document).ready(function () {
    // Función que realiza la llamada AJAX para agregar el producto al carrito
    $('.boton_agregar').on('click', function () {
      // Obtener el id del botón clickeado (id del producto)
      const idProducto = parseInt($(this).attr('id'));
      
      // Crear el objeto producto con el id del producto
      const producto = { idproducto: idProducto, cicantidad: 1 };
  
      // Levantar el carrito desde localStorage
      const carritoAlmacenado = JSON.parse(localStorage.getItem('productos_carrito'));
  
      // Si el carrito existe en localStorage
      let carrito = carritoAlmacenado ? carritoAlmacenado : [];
  
      // Revisar si el producto ya está en el carrito
      const productoExistente = carrito.find((item) => item.idproducto === idProducto);
  
      if (productoExistente) {
        // Si el producto ya existe en el carrito, incrementar la cantidad
        productoExistente.cicantidad++;
      } else {
        // Si el producto no está en el carrito, agregarlo con cantidad 1
        carrito.push(producto);
      }
  
      // Guardar el carrito actualizado en localStorage
      localStorage.setItem('productos_carrito', JSON.stringify(carrito));
  
      // Mostrar una alerta con el producto y su cantidad
      alert('Producto agregado: ' + producto['idproducto'] + ' | cicantidad: ' + (productoExistente?.cantidad || 1));
  
      // Llamada AJAX para procesar el carrito en el servidor
      $.ajax({
        url: 'Action/carritoAction.php',
        type: 'POST',
        data: { producto: producto },  // Enviar el objeto del producto
        success: function (response) {
          console.log('Producto agregado al carrito en el servidor');
        },
        error: function (xhr, status, error) {
          alert('Hubo un error al agregar el producto.');
        },
      });
  
      // Actualizar la cantidad de productos en el carrito
      actualizarCantidadCarrito();
    });
  
    // Función para actualizar la cantidad de productos en el carrito
    function actualizarCantidadCarrito() {
      const carritoAlmacenado = JSON.parse(localStorage.getItem('productos_carrito'));
      const cantidadTotal = carritoAlmacenado ? carritoAlmacenado.reduce((total, producto) => total + producto.cantidad, 0) : 0;
      $('#cantidad_carrito').text(cantidadTotal);  // Actualiza la interfaz con la cantidad total de productos
    }
  
    // Eliminar un producto del carrito
    $('.boton_eliminar').on('click', function () {
      // Obtener el id del producto a eliminar
      const idProducto = parseInt($(this).attr('id')); // Asumimos que el id del botón contiene el id del producto a eliminar
  
      // Levantar el carrito desde localStorage
      const carritoAlmacenado = JSON.parse(localStorage.getItem('productos_carrito'));
      let carrito = carritoAlmacenado ? carritoAlmacenado : [];
  
      // Filtrar el producto a eliminar, eliminando el producto con el id correspondiente
      carrito = carrito.filter((producto) => producto.idproducto !== idProducto);
  
      // Guardar el carrito actualizado en localStorage
      localStorage.setItem('productos_carrito', JSON.stringify(carrito));
  
      // Actualizar la cantidad de productos en el carrito
      actualizarCantidadCarrito();  
  
      // Mostrar una alerta (opcional)
      alert('Producto eliminado: ' + idProducto);
    });
  });