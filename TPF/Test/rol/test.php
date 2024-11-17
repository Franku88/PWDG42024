<?php 


// testing de ABM de roles
include_once "/Applications/XAMPP/xamppfiles/htdocs/PWDG42024/TPF/Model/BaseDatos.php";
include_once '/Applications/XAMPP/xamppfiles/htdocs/PWDG42024/TPF/Model/Rol.php';
include_once '/Applications/XAMPP/xamppfiles/htdocs/PWDG42024/TPF/Controller/ABMRol.php';

// test alta de rol ✅
// $param = array('rodescripcion' => 'Cliente');
//  $abmRol = new ABMRol();
//  $alta = $abmRol->alta($param);

// if ($alta) {
//     echo "Alta exitosa";
// } else {
//     echo "Error en la alta";
// }

// test baja de rol ✅
// $abmRol = new ABMRol();
// $baja = $abmRol->baja(array('idrol' => 2));
// if ($baja) {
//     echo "Baja exitosa";
// } else {
//     echo "Error en la baja";
// }

// test buscar rol por id ✅

// $param = array('roid' => 1);
// $abmRol = new ABMRol();
// $busqueda = $abmRol->buscar($param);
// if ($busqueda) {
//     echo "Rol encontrado ⬇️ \n";
//     $object = $busqueda[0];
//     echo $object;
// } else {
//     echo "Rol no encontrado";
// }

// test busqueda de todos los roles ✅

// $abmrol = new ABMRol();
// $busqueda = $abmrol->buscar();

// if ($busqueda) {
//     echo "Roles encontrados ⬇️ \n";
//     foreach ($busqueda as $rol) {
//         echo "ID del Rol: " . $rol->getId() . "\n";
//         echo "Descripción del Rol: " . $rol->getRodescripcion() . "\n";
//         echo "----------------------------\n";
//     }
// } else {
//     echo "No se encontraron roles";
// }


