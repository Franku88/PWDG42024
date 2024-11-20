<?php

// testing de ABM de UsuarioRol
include_once "/Applications/XAMPP/xamppfiles/htdocs/PWDG42024/TPF/Model/BaseDatos.php";
include_once '/Applications/XAMPP/xamppfiles/htdocs/PWDG42024/TPF/Model/Compra.php';
include_once '/Applications/XAMPP/xamppfiles/htdocs/PWDG42024/TPF/Controller/ABMCompra.php';
include_once '/Applications/XAMPP/xamppfiles/htdocs/PWDG42024/TPF/Controller/ABMUsuario.php';


// test alta Compra✅
// ['cofecha' => $cofecha, 'objUsuario' => $objUsuario] idcompra es AUTO_INCREMENT
// $abmCompra = new ABMCompra();
// $abmUsuario = new ABMUsuario();
// $usuarios = $abmUsuario->buscar(['idusuario' => 3]);
// $fechaActual = date('Y-m-d');
// $alta = $abmCompra->alta(['cofecha' => $fechaActual , 'objUsuario' => $usuarios[0]]);
// if ($alta) {
//     echo 'Alta exitosa';
// } else {
//     echo 'Error en la alta';
// }

// test baja de compra ✅
// ['cofecha' => $cofecha, 'objUsuario' => $objUsuario] idcompra es AUTO_INCREMENT
$abmCompra = new abmCompra();
$baja = $abmCompra->baja(['idcompra' => 6]);
if ($baja) {
    echo 'Baja exitosa';
} else {
    echo 'Error en la baja';
}

// test busqueda de todas las compras ✅
// ['cofecha' => $cofecha, 'objUsuario' => $objUsuario] idcompra es AUTO_INCREMENT
// $abmCompra = new ABMCompra();
// $busqueda = $abmCompra->buscar();
// if ($busqueda) {
//     echo "Compras encontradas ⬇️ \n";
//     foreach ($busqueda as $compra) {
//         echo $compra;
//     }
// } else {
//     echo "No se encontraron compras";  
// }

