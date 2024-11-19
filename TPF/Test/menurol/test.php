<?php




// testing de ABM de MenuRol
include_once "/Applications/XAMPP/xamppfiles/htdocs/PWDG42024/TPF/Model/BaseDatos.php";
include_once '/Applications/XAMPP/xamppfiles/htdocs/PWDG42024/TPF/Model/MenuRol.php';
include_once '/Applications/XAMPP/xamppfiles/htdocs/PWDG42024/TPF/Controller/ABMMenuRol.php';


// test alta ✅

//Paso 1: Crear datos para alta
// $param = [
//     'idmenu' => 2,  // Este id debe existir en la base de datos
//     'idrol' => 3    // Este id también debe existir
// ];

// $abmMenuRol = new ABMMenuRol();
// $resultadoAlta = $abmMenuRol->alta($param);

// if ($resultadoAlta) {
//     echo "Alta exitosa\n";
// } else {
//     echo "Error en la alta\n";
// }


// test baja de MenuRol ✅
// $abmMenuRol = new ABMMenuRol();
// $param = [
//     'idmenu' => 2,
//     'idrol' => 3
// ];
// $resultadoBaja = $abmMenuRol->baja($param);
// if ($resultadoBaja) {
//     echo "Baja exitosa\n";
// } else {
//     echo "Error en la baja\n";
// }

// test buscar MenuRol por id ✅ (funciona, pero verificar que el idmenu y idrol existan)

// $abmMenuRol = new ABMMenuRol();
// $param = [
//     'idmenu' => 1,
//     'idrol' => 1
// ];
// $busqueda = $abmMenuRol->buscar($param);

// if ($busqueda) {
//     echo "MenuRol encontrado ⬇️ \n";
//     echo $busqueda[0]; // muestra los valores de los objetos 
// } else {
//     echo "MenuRol no encontrado";
// }

// test busqueda de todos los MenuRol ✅

// $abmMenuRol = new ABMMenuRol();
// $busqueda = $abmMenuRol->buscar();
// if ($busqueda) {
//     echo "MenuRoles encontrados ⬇️ \n";
//     foreach ($busqueda as $menuRol) {
//         echo $menuRol;
//         echo "--------------------------------\n";
//     }
// } else {
//     echo "No se encontraron MenuRoles";  
// }


// test modificacion de MenuRol ❌ 
// (dado que ambas son claves primarias y foraneas, verificar la estructura de modificacion)

// $abmMenuRol = new ABMMenuRol();
// $param = [
//     'idmenu' => 1,
//     'idrol' => 1
// ];
// $resultadoModificacion = $abmMenuRol->modificacion($param);
// if ($resultadoModificacion) {
//     echo "Modificación exitosa\n";
// } else {
//     echo "Error en la modificación\n";
// }
