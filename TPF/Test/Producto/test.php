<?php

// testing de ABM de Producto
include_once "/Applications/XAMPP/xamppfiles/htdocs/PWDG42024/TPF/Model/BaseDatos.php";
include_once '/Applications/XAMPP/xamppfiles/htdocs/PWDG42024/TPF/Model/Producto.php';
include_once '/Applications/XAMPP/xamppfiles/htdocs/PWDG42024/TPF/Controller/ABMProducto.php';

// test alta de producto ✅

// $params = ['proprecio' => 100, 'pronombre' => 'Producto de prueba', 'prodetalle' => 'Detalle de prueba', 'procantstock' => 10];
// $abmProducto = new ABMProducto();
// $alta = $abmProducto->alta($params);

// if ($alta) {
//     echo "Alta exitosa";
// } else {
//     echo "Error en la alta";
// }

// test baja de producto ✅

// $abmProducto = new ABMProducto();
// $baja = $abmProducto->baja(['idproducto' => 1]);
// if ($baja) {
//     echo "Baja exitosa";
// } else {
//     echo "Error en la baja";
// }

// test buscar producto por id ✅

// $param = ['idproducto' => 2];
// $abmProducto = new ABMProducto();
// $busqueda = $abmProducto->buscar($param);
// if ($busqueda) {
//     echo "Producto encontrado ⬇️ \n";
//     print_r($busqueda[0]);
// } else {
//     echo "Producto no encontrado";
// }


// test busqueda de todos los productos ✅
// $abmProducto = new ABMProducto();
// $busqueda = $abmProducto->buscar();
// if ($busqueda) {
//     echo "Productos encontrados ⬇️ \n";
//     foreach ($busqueda as $producto) {
//         echo "ID del Producto: " . $producto->getIdproducto() . "\n";
//         echo "Nombre del Producto: " . $producto->getPronombre() . "\n";
//         echo "Precio del Producto: " . $producto->getProprecio() . "\n";
//         echo "Detalle del Producto: " . $producto->getProdetalle() . "\n";
//         echo "Cantidad en Stock: " . $producto->getProcantstock() . "\n";
//         echo "----------------------------\n";
//     }
// } else {
//     echo "No se encontraron productos";  
// }

// test de modificacion de producto ✅
// $idProducto = 2;
// $abmProducto = new ABMProducto();

// $param = [
//     'idproducto' => $idProducto,
//     'proprecio' => 200,
//     'pronombre' => 'Producto de prueba modificado',
//     'prodetalle' => 'Detalle de prueba modificado',
//     'procantstock' => 20
// ];

// $modificacion = $abmProducto->modificacion($param);
// if ($modificacion) {
//     echo "Modificacion exitosa";
// } else {
//     echo "Error en la modificacion";
// }
