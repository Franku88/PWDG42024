<?php

// testing de ABM de Producto
include_once "/Applications/XAMPP/xamppfiles/htdocs/PWDG42024/TPF/Model/BaseDatos.php";
include_once '/Applications/XAMPP/xamppfiles/htdocs/PWDG42024/TPF/Model/Producto.php';
include_once '/Applications/XAMPP/xamppfiles/htdocs/PWDG42024/TPF/Controller/ABMProducto.php';

// test alta de producto ✅


// $abmProducto = new ABMProducto();
// $params = [
//     'proprecio' => 120 , 
//     'pronombre' => 'age',
//     'prodetalle' => 'ageDefinitive', 
//     'procantstock' => 10];
// $alta = $abmProducto->alta($params);
// if ($alta) {
//     echo "Alta exitosa";
// } else {
//     echo "Error en la alta";
// }


// test baja de producto ✅

// $abmProducto = new ABMProducto();
// $baja = $abmProducto->baja(['idproducto' => 7]);
// if ($baja) {
//     echo "Baja exitosa";
// } else {
//     echo "Error en la baja";
// }



// test buscar modificacion de producto ✅

$param = ['idproducto' => 8];
$abmProducto = new ABMProducto();
$busqueda = $abmProducto->buscar($param);
$producto= $busqueda[0];

print_r($producto);


// test busqueda de todos los productos ✅
// $abmProducto = new ABMProducto();
// $busqueda = $abmProducto->buscar();
// if ($busqueda) {
//     echo "Productos encontrados ⬇️ \n";
//     foreach ($busqueda as $producto) {
//         echo $producto;
//     }
// } else {
//     echo "No se encontraron productos";  
// }

// test busqueda de producto por id ✅
// $abmProducto = new ABMProducto();
// $param = ['idproducto' => 2];
// $busqueda = $abmProducto->buscar($param);
// if ($busqueda) {
//     echo "Producto encontrado ⬇️ \n";
//     echo $busqueda[0];
// } else {
//     echo "Producto no encontrado";
// }

