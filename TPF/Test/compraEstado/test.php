<?php 

include_once "/Applications/XAMPP/xamppfiles/htdocs/PWDG42024/TPF/Model/BaseDatos.php";
include_once '/Applications/XAMPP/xamppfiles/htdocs/PWDG42024/TPF/Model/CompraEstado.php';
include_once '/Applications/XAMPP/xamppfiles/htdocs/PWDG42024/TPF/Controller/ABMCompraEstado.php';
include_once '/Applications/XAMPP/xamppfiles/htdocs/PWDG42024/TPF/Controller/ABMCompra.php';
include_once '/Applications/XAMPP/xamppfiles/htdocs/PWDG42024/TPF/Controller/ABMCompraEstadoTipo.php';



// test de alta ✅
// // ['objCompra' => $objCompra, 'objCompraEstadoTipo' => $objCompraEstadoTipo, 'cefechaini' => $cefechaini, 'cefechafin' => $cefechafin]
// // 1. Buscamos los objs para el test
// $abmCompra = new ABMCompra();
// $abmCompraEstadoTipo = new ABMCompraEstadoTipo();
// $objCompra = $abmCompra->buscar(['idcompra' => 1]);
// $objCompraEstadoTipo = $abmCompraEstadoTipo->buscar(['idcompraestadotipo' => 2]);
// // 2. Creamos el array asociativo
// $compraEstado = ['objCompra' => $objCompra[0], 'objCompraEstadoTipo' => $objCompraEstadoTipo[0], 'cefechaini' => '2021-06-01', 'cefechafin' => '2021-06-30'];
// // 3. Creamos el objeto
// $abmCompraEstado = new ABMCompraEstado();
// // 4. alta
// $alta = $abmCompraEstado->alta($compraEstado);
// if ($alta) {
//     echo "Alta exitosa";
// } else {
//     echo "Error en la alta";
// }

// test de baja ✅
// 1. Creamos el array asociativo
// $compraEstado = ['idcompraestado' => 1];
// // 2. Creamos el objeto
// $abmCompraEstado = new ABMCompraEstado();
// // 3. baja
// $baja = $abmCompraEstado->baja($compraEstado);
// if ($baja) {
//     echo "Baja exitosa";
// } else {
//     echo "Error en la baja";
// }

// test busqueda de todos los compraestados ✅
// // 1. Creamos el objeto
// $abmCompraEstado = new ABMCompraEstado();
// $busqueda = $abmCompraEstado->buscar();
// if ($busqueda) {
//     echo "Busqueda exitosa";
//     foreach ($busqueda as $busquedaobj) {
//         echo $busquedaobj;
//     }
// } else {
//     echo "Error en la busqueda";
// }

// test busqueda por idcompraestado ✅
// // 1. Creamos el array asociativo
// $compraEstado = ['idcompraestado' => 2];
// // // 2. Creamos el objeto
// $abmCompraEstado = new ABMCompraEstado();
// // // 3. busqueda
// $busqueda = $abmCompraEstado->buscar($compraEstado);
// if ($busqueda) {
//     echo "Busqueda exitosa";
//     foreach ($busqueda as $busquedaobj) {
//         echo $busquedaobj;
//     }
// } else {
//     echo "Error en la busqueda";
// }