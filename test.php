<?php

include_once '/Applications/XAMPP/xamppfiles/htdocs/PWDG42024/TP5/Model/Usuario.php';
include_once '/Applications/XAMPP/xamppfiles/htdocs/PWDG42024/TP5/Model/Rol.php';
include_once '/Applications/XAMPP/xamppfiles/htdocs/PWDG42024/TP5/Model/UsuarioRol.php';
include_once '/Applications/XAMPP/xamppfiles/htdocs/PWDG42024/TP5/Controller/ABMUsuario.php';
include_once '/Applications/XAMPP/xamppfiles/htdocs/PWDG42024/TP5/Controller/ABMRol.php';
include_once '/Applications/XAMPP/xamppfiles/htdocs/PWDG42024/TP5/Controller/ABMUsuarioRol.php';
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

// TEST DE BUSQUEDA DE USUARIO ✅
// $abmUsuario = new ABMUsuario();
//$usuarios = $abmUsuario->buscar();

// --------------------------------------------------------------------------------------------

// TEST DE ALTA DE ROL ✅

// $rolDescription = "nicoTest";
// $abmRol = new ABMRol();
// $insertion = $abmRol->alta(["roldescripcion" => $rolDescription]);

// if ($insertion) {
//     echo "Se inserto el nuevo Rol \n";
// } else {
//     echo "No se inserto el nuevo Rol \n";
// }

// TEST DE MODIFICACION DE ROL ✅
// $id = 4; // ID del rol a modificar. Este se puede buscar en base a ciertos criterios
// $rolDescription = "supervisor";
// $abmRol = new ABMRol();
// $modificacion = $abmRol->modificacion(["idrol" => $id, "roldescripcion" => $rolDescription]);
// if ($modificacion) {
//     echo "Se modifico el Rol \n";
// } else {
//     echo "No se modifico el Rol \n";
// }

// TEST DE BAJA DE ROL ✅
// $id = 1; // ID del rol a eliminar. Este se puede buscar en base a ciertos criterios
// $abmRol = new ABMRol();
// $eliminacion = $abmRol->baja(["idrol" => $id]);
// if ($eliminacion) {
//     echo "Se elimino el Rol \n";
// } else {
//     echo "No se elimino el Rol \n";
// }

// --------------------------------------------------------------------------------------------

// TEST DE ALTA DE USUARIO-ROL ✅
// $abmUsuarioRol = new ABMUsuarioRol();
// los valores de idusuario e idrol se pueden buscar en base a ciertos criterios
// por ejemplo, para verificar que existan en la base de datos
// FIX: buscar primero que existan tanto el usuario como el rol

// $idusuario = 1;
// $idrol = 2;
// $abmUsuario = new ABMUsuario();
// $abmRol = new ABMRol();
// $usuario = $abmUsuario->buscar(['idusuario' => $idusuario]);
// $rol = $abmRol->buscar(['idrol' => $idrol]);

// if (empty($rol)) {
//     echo "No se encontro el rol \n"; 
// } else if (empty($usuario)) {
//     echo "No se encontro el usuario \n";
// } else {
//     $insertion = $abmUsuarioRol->alta(["idusuario" => $idusuario, "idrol" => $idrol]);
//     if ($insertion) {
//         echo "Se inserto el nuevo Usuario-Rol \n";
//     } else {
//         echo "No se inserto el nuevo Usuario-Rol \n";
//     }
// }


// TEST DE MODIFICACION DE USUARIO-ROL ✅
// $idusuario = 1;
// $idrol = 3;
// $abmUsuarioRol = new ABMUsuarioRol();
// $modificacion = $abmUsuarioRol->modificacion(["idusuario" => $idusuario, "idrol" => $idrol]);
// if ($modificacion) {
//     echo "Se modifico el Usuario-Rol \n";
// } else {
//     echo "No se modifico el Usuario-Rol \n";
// }

// TEST DE BAJA DE USUARIO-ROL ✅
// $idusuario = 1;
// $idrol = 3;
// $abmUsuarioRol = new ABMUsuarioRol();
// $eliminacion = $abmUsuarioRol->baja(["idusuario" => $idusuario, "idrol" => $idrol]);
// if ($eliminacion) {
//     echo "Se elimino el Usuario-Rol \n";
// } else {
//     echo "No se elimino el Usuario-Rol \n";
// }