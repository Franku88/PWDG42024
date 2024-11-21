<?php

// testing de ABM de UsuarioRol
include_once "/Applications/XAMPP/xamppfiles/htdocs/PWDG42024/TPF/Model/BaseDatos.php";
include_once '/Applications/XAMPP/xamppfiles/htdocs/PWDG42024/TPF/Model/UsuarioRol.php';
include_once '/Applications/XAMPP/xamppfiles/htdocs/PWDG42024/TPF/Controller/ABMUsuarioRol.php';
include_once '/Applications/XAMPP/xamppfiles/htdocs/PWDG42024/TPF/Controller/ABMUsuario.php';
include_once '/Applications/XAMPP/xamppfiles/htdocs/PWDG42024/TPF/Controller/ABMRol.php';


// test alta UsuarioRol✅
// $abmUsuarioRol = new ABMUsuarioRol();
// // ['usuario' => $objUsuario , 'rol' => $objRol]
// $abmUsuario = new ABMUsuario();
// $abmRol = new AbmRol();
// $usuarios = $abmUsuario->buscar(['idusuario' => 3]);
// $roles = $abmRol->buscar(['idrol'=> 1]);

// $alta = $abmUsuarioRol->alta(['usuario' => $usuarios[0], 'rol' => $roles[0]]);
// if ($alta) {
//     echo 'Alta exitosa';
// } else {
//     echo 'Error en la alta';
// }

// test baja de UsuarioRol ✅
// $abmUsuarioRol = new ABMUsuarioRol();
// $abmUsuario = new ABMUsuario();
// $abmRol = new AbmRol();
// $usuarios = $abmUsuario->buscar(['idusuario' => 3]);
// $roles = $abmRol->buscar(['idrol'=> 1]);

// $baja = $abmUsuarioRol->baja(['usuario' => $usuarios[0], 'rol' => $roles[0]]);

// if ($baja) {
//     echo 'Baja exitosa';
// } else {
//     echo 'Error en la baja';
// }


// test modificacion de UsuarioRol ❌ 
// (dado que ambas son claves primarias y foraneas, verificar la estructura de modificacion)


// test busqueda de todos los UsuarioRol ✅
// ['usuario' => $objUsuario , 'rol' => $objRol]
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

// test busqueda de UsuarioRol por claves primarias ✅
$abmUsuarioRol = new ABMUsuarioRol();
$idUsuario = 2;
$busqueda = $abmUsuarioRol->buscar(['idusuario' => $idUsuario]);
if ($busqueda) {
    echo "UsuarioRol encontrados ⬇️ \n";
    foreach ($busqueda as $usuarioRol) {
        echo $usuarioRol;
    }
} else {
    echo "No se encontraron UsuarioRol";  
}