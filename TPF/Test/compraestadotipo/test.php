<?php

// testing de ABM de CompraEstadoTipo
include_once "/Applications/XAMPP/xamppfiles/htdocs/PWDG42024/TPF/Model/BaseDatos.php";
include_once '/Applications/XAMPP/xamppfiles/htdocs/PWDG42024/TPF/Model/CompraEstadoTipo.php';
include_once '/Applications/XAMPP/xamppfiles/htdocs/PWDG42024/TPF/Controller/ABMCompraEstadoTipo.php';

// Test de Alta ❌
// $abmCompraEstadoTipo = new ABMCompraEstadoTipo();
// $compraEstadoTipo = ['cetdescripcion' => 'Compra en proceso', 'cetdetalle' => 'Test alta'];
// $alta = $abmCompraEstadoTipo->alta($compraEstadoTipo);
// if ($alta) {
//     echo "Alta exitosa";
// } else {
//     echo "Error en la alta";
// }

// test de Baja ✅
// $abmCompraEstadoTipo = new ABMCompraEstadoTipo();
// $compraEstadoTipoId = ['idcompraestadotipo' => 13];
// $baja = $abmCompraEstadoTipo->baja($compraEstadoTipoId);
// if ($baja) {
//     echo "Baja exitosa";
// } else {
//     echo "Error en la baja";
// }

// test de Busqueda de todos los CompraEstadoTipo ✅
// $abmCompraEstadoTipo = new ABMCompraEstadoTipo();
// $busqueda = $abmCompraEstadoTipo->buscar();
// if ($busqueda) {
//     echo "CompraEstadoTipo encontrados ⬇️ \n";
//     foreach ($busqueda as $compraEstadoTipo) {
//         echo "------------------------------------\n";
//         echo $compraEstadoTipo;
//         echo "------------------------------------\n";
//     }
// } else {
//     echo "No se encontraron CompraEstadoTipo";  
// }

// test de Busqueda de CompraEstadoTipo por id ✅
// $abmCompraEstadoTipo = new ABMCompraEstadoTipo();
// $compraEstadoTipoId = ['idcompraestadotipo' => 3];
// $busqueda = $abmCompraEstadoTipo->buscar($compraEstadoTipoId);
// if ($busqueda) {
//     echo "CompraEstadoTipo encontrados ⬇️ \n";
//     echo "------------------------------------\n";
//     echo $busqueda[0];
//     echo "------------------------------------\n";
// } else {
//     echo "No se encontraron CompraEstadoTipo";  
// }
