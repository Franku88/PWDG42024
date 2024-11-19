<?php 

// testing de ABM de menu
include_once "/Applications/XAMPP/xamppfiles/htdocs/PWDG42024/TPF/Model/BaseDatos.php";
include_once '/Applications/XAMPP/xamppfiles/htdocs/PWDG42024/TPF/Model/Menu.php';
include_once '/Applications/XAMPP/xamppfiles/htdocs/PWDG42024/TPF/Controller/ABMMenu.php';


//test alta de menu ❌ (inserta, pero verificar que inserta con el timestamp, producto de la estructura de la bd)  
// $param = array('menombre' => 'Testing menu v2', 'medescripcion' => 'Menu de prueba', 'idpadre' => 1);
// $abmMenu = new ABMMenu();
// $alta = $abmMenu->alta($param);

// if ($alta) {
//     echo "Alta exitosa";
// } else {
//     echo "Error en la alta";
// }



// test baja de menu ✅
// $abmMenu = new ABMMenu();
// $baja = $abmMenu->baja(['idmenu' => 12]);
// if ($baja) {
//     echo "Baja exitosa";
// } else {
//     echo "Error en la baja";
// }

// test buscar menu por id ✅ (funciona. NULL se muestra vacio)
// $param = ['idmenu' => 11];
// $abmUsuario = new ABMMenu();
// $busqueda = $abmUsuario->buscar($param);
// if ($busqueda) {
//     echo "Menu encontrado ⬇️ \n";
//     $object = $busqueda[0];
//     echo $object;
// } else {
//     echo "Menu no encontrado";
// }

// test busqueda de todos los menu ❌ (funciona, pero verificar el usdesabilitado en NULL)
// $abmMenu = new ABMMenu();
// $busqueda = $abmMenu->buscar();
// if ($busqueda) {
//     echo "Menus encontrados ⬇️ \n";
//     foreach ($busqueda as $menu) {
//         echo "ID del Menu: " . $menu->getIdmenu() . "\n";
//         echo "----------------------------\n";
//     }
// } else {
//     echo "No se encontraron usuarios";  
// }



// test de modificacion de menu ✅ (verificar el usdesabilitado en NULL y que el $menu exista)
// $menu = 11;
// $abmMenu = new ABMMenu();
// // Paso 2: Modificar el usuario
// //paso 2.1: recuperar fecha actual
// $fecha = date('Y-m-d H:i:s');

// $modificacionData = [
//     'idmenu' => $menu,
//     'menombre' => 'MenuModificado',
//     'medescripcion' => 'desc mod',
//     'idpadre' => 1,
//     'medeshabilitado' => $fecha
// ];
// // Ejecutar la modificación
// $resultadoModificacion = $abmMenu->modificacion($modificacionData);
// if ($resultadoModificacion) {
//     echo "Modificación exitosa";
// } else {
//     echo "Error en la modificación";
// }