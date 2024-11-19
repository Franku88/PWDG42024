<?php




// testing de ABM de UsuarioRol
include_once "/Applications/XAMPP/xamppfiles/htdocs/PWDG42024/TPF/Model/BaseDatos.php";
include_once '/Applications/XAMPP/xamppfiles/htdocs/PWDG42024/TPF/Model/UsuarioRol.php';
include_once '/Applications/XAMPP/xamppfiles/htdocs/PWDG42024/TPF/Controller/ABMUsuarioRol.php';


// test alta UsuarioRol✅

// $abmUsuarioRol = new ABMUsuarioRol();
// $param = [
//     'idusuario' => 3,
//     'idrol' => 3
// ];
// $resultadoAlta = $abmUsuarioRol->alta($param);
// if ($resultadoAlta) {
//     echo "Alta exitosa\n";
// } else {
//     echo "Error en la alta\n";
// }


// test baja de UsuarioRol ✅
// $abmUsuarioRol = new ABMUsuarioRol();
// $param = [
//     'idusuario' => 3,
//     'idrol' => 3
// ];
// $resultadoBaja = $abmUsuarioRol->baja($param);
// if ($resultadoBaja) {
//     echo "Baja exitosa\n";
// } else {
//     echo "Error en la baja\n";
// }


// test buscar UsuarioRol por id ✅ (funciona, pero verificar que  existan)

// $abmUsuarioRol = new ABMUsuarioRol();
// $param = [
//     'idusuario' => 2,
//     'idrol' => 1
// ];
// $busqueda = $abmUsuarioRol->buscar($param);
// if ($busqueda) {
//     echo "UsuarioRol encontrado ⬇️ \n";
//     echo  $busqueda[0];
// } else {
//     echo "No se encontró UsuarioRol";  
// }


// test busqueda de todos los UsuarioRol ✅

// $abmUsuarioRol = new ABMUsuarioRol();
// $busqueda = $abmUsuarioRol->buscar();
// if ($busqueda) {
//     echo "UsuarioRol encontrados ⬇️ \n";
//     foreach ($busqueda as $usuarioRol) {
//         echo $usuarioRol;
//     }
// } else {
//     echo "No se encontraron UsuarioRol";  
// }



// test modificacion de UsuarioRol ❌ 
// (dado que ambas son claves primarias y foraneas, verificar la estructura de modificacion)