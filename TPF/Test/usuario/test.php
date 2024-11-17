<?php 


// testing de ABM de roles
include_once "/Applications/XAMPP/xamppfiles/htdocs/PWDG42024/TPF/Model/BaseDatos.php";
include_once '/Applications/XAMPP/xamppfiles/htdocs/PWDG42024/TPF/Model/Usuario.php';
include_once '/Applications/XAMPP/xamppfiles/htdocs/PWDG42024/TPF/Controller/ABMUsuario.php';

// test alta de usuario ✅
// $param = ['usnombre' => 'testing', 'uspass' => 'testing', 'usmail' => 'user@test.com'];
// $abmUsuario = new ABMUsuario();
// $alta = $abmUsuario->alta($param);

// if ($alta) {
//     echo "Alta exitosa";
// } else {
//     echo "Error en la alta";
// }

// test baja de usuario ✅

// $abmUsuario = new ABMUsuario();
// $baja = $abmUsuario->baja(['idusuario' => 1]);
// if ($baja) {
//     echo "Baja exitosa";
// } else {
//     echo "Error en la baja";
// }

// test buscar usuario por id ❌ (funciona, pero verificar el usdesabilitado en NULL)
// $param = ['idusuario' => 2];
// $abmUsuario = new ABMUsuario();
// $busqueda = $abmUsuario->buscar($param);
// if ($busqueda) {
//     echo "Usuario encontrado ⬇️ \n";
//     $object = $busqueda[0];
//     echo $object;
// } else {
//     echo "Usuario no encontrado";
// }

// test busqueda de todos los usuarios ❌ (funciona, pero verificar el usdesabilitado en NULL)
// $abmUsuario = new AbmUsuario();
// $busqueda = $abmUsuario->buscar();
// if ($busqueda) {
//     echo "Usuarios encontrados ⬇️ \n";
//     foreach ($busqueda as $usuario) {
//         echo "ID del Usuario: " . $usuario->getIdusuario() . "\n";
//         echo "Nombre del Usuario: " . $usuario->getUsnombre() . "\n";
//         echo "Mail del Usuario: " . $usuario->getUsmail() . "\n";
//         echo "----------------------------\n";
//     }
// } else {
//     echo "No se encontraron usuarios";  
// }



// test de modificacion de usuario ❌ (verificar el usdesabilitado en NULL y que el idUsuario exista)
//Obtenemos el usuario recién creado para tener su ID
$idUsuario = 3;
$abmUsuario = new ABMUsuario();
// Paso 2: Modificar el usuario
$modificacionData = [
    'idusuario' => $idUsuario,
    'usnombre' => 'Juan Modificado',
    'uspass' => '5678',
    'usmail' => 'juanmodificado@gmail.com',
    'usdesabilitado' => null, // O establece un valor si necesitas
];
// Ejecutar la modificación
$resultadoModificacion = $abmUsuario->modificacion($modificacionData);
// Paso 3: Verificar los cambios
$usuarioModificado = $abmUsuario->buscar(['idusuario' => $idUsuario]);
if ($resultadoModificacion && !empty($usuarioModificado)) {
    $usuarioModificado = $usuarioModificado[0]; // Tomamos el primer resultado
    echo "Se modificó el usuario exitosamente.\n";
    echo "Nuevo Nombre: " . $usuarioModificado->getUsNombre() . "\n";
    echo "Nuevo Email: " . $usuarioModificado->getUsMail() . "\n";
} else {
    echo "No se pudo modificar el usuario.\n";
}