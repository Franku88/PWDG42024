<?php 

include_once '/Applications/XAMPP/xamppfiles/htdocs/PWDG42024/TP5/Model/Usuario.php';
include_once '/Applications/XAMPP/xamppfiles/htdocs/PWDG42024/TP5/Controller/ABMUsuario.php';
include_once '/Applications/XAMPP/xamppfiles/htdocs/PWDG42024/TP5/Model/BaseDatos.php';

// rol acepta como parametro una descripcion, pero el id se autogenera en la bd
// $rol = new Rol("usuario");
// if ($rol->insertar()) {
//     echo "Se insertó el rol \n";
//     echo $rol;
// } else {
//     echo "No se insertó el rol";
// }


// TEST DE ALTA DE USUARIO ✅
// $usnombre = "nicoTest";
// $uspass = "12345";
// $usmail = "nico@gmail.com";

// $abmUsuario = new ABMUsuario();
// $insertion = $abmUsuario->alta(["usnombre" => $usnombre, "uspass" => $uspass, "usmail" => $usmail]);

// if ($insertion) {
//     echo "Se insertó el usuario \n";
// } else {
//     echo "No se insertó el usuario \n";
// }

// TEST DE MODIFICACION DE USUARIO ✅

// Obtén el usuario recién creado para tener su ID
// $idUsuario = 1;
// $abmUsuario = new ABMUsuario();
// // Paso 2: Modificar el usuario
// $modificacionData = [
//     'idusuario' => $idUsuario,
//     'usnombre' => 'Juan Modificado',
//     'uspass' => '5678',
//     'usmail' => 'juanmodificado@gmail.com',
//     'usdesabilitado' => null, // O establece un valor si necesitas
// ];

// // Ejecutar la modificación
// $resultadoModificacion = $abmUsuario->modificacion($modificacionData);

// // Paso 3: Verificar los cambios
// $usuarioModificado = $abmUsuario->buscar(['idusuario' => $idUsuario]);

// if ($resultadoModificacion && !empty($usuarioModificado)) {
//     $usuarioModificado = $usuarioModificado[0]; // Tomamos el primer resultado
//     echo "Se modificó el usuario exitosamente.\n";
//     echo "Nuevo Nombre: " . $usuarioModificado->getUsNombre() . "\n";
//     echo "Nuevo Email: " . $usuarioModificado->getUsMail() . "\n";
// } else {
//     echo "No se pudo modificar el usuario.\n";
// }

// TEST DE BAJA DE USUARIO ✅
// buscamos el usuario a eliminar

// Inicializa el objeto ABMUsuario
// $abmusuario = new ABMUsuario();
// $username = 'nicoTest'; // Suponiendo que este usuario ya existe en la base de datos

// // Paso 1: Buscar el usuario a eliminar por nombre
// $usuarios = $abmusuario->buscar(['usnombre' => $username]);

// if (!empty($usuarios)) {
//     $idUsuario = $usuarios[0]->getIdusuario(); // Obtener el ID del usuario encontrado

//     // Paso 2: Ejecutar la baja
//     $eliminacion = $abmusuario->baja(['idusuario' => $idUsuario]);

//     // Paso 3: Verificar la eliminación
//     if ($eliminacion) {
//         echo "Se eliminó el usuario \n";
//     } else {
//         echo "No se eliminó el usuario \n";
//     }
// } else {
//     echo "No se encontró el usuario para eliminar.\n";
// }