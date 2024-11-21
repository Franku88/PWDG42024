<?php

// include_once '../../configuracion.php';
// testing de ABM de roles
include_once "/Applications/XAMPP/xamppfiles/htdocs/PWDG42024/TPF/Model/BaseDatos.php";
include_once '/Applications/XAMPP/xamppfiles/htdocs/PWDG42024/TPF/Model/Usuario.php';
include_once '/Applications/XAMPP/xamppfiles/htdocs/PWDG42024/TPF/Controller/ABMUsuario.php';

// test alta de usuario ✅
// $param = ['usnombre' => 'testingV3', 'uspass' => 'testing', 'usmail' => 'user@test.com'];
// $abmUsuario = new ABMUsuario();
// $alta = $abmUsuario->alta($param);

// if ($alta) {
//     echo "Alta exitosa";
// } else {
//     echo "Error en la alta";
// }

// test baja de usuario ✅

// $abmUsuario = new ABMUsuario();
// $baja = $abmUsuario->baja(['idusuario' => 5]);
// if ($baja) {
//     echo "Baja exitosa";
// } else {
//     echo "Error en la baja";
// }

// test buscar usuario por id ✅ (funciona, verificar el usdesabilitado en 0000-00-00 00:00:00 como activa, y cualquier fecha como la de deshabilitación, cambios en ABM)
// alternativa no usada, convertir usdeshabilitado en booleano pero se pierde registro de cuando se desactiva el user, salvo crear una tabla dedicada a eso (cambios en sql).
// $param = ['idusuario' => 2,'usdeshabilitado' => '2024-11-19 00:00:00'];
// $abmUsuario = new ABMUsuario();
// $busqueda = $abmUsuario->buscar($param);
// if ($busqueda) {
//     if($param['usdeshabilitado'] == '0000-00-00 00:00:00'){
//         echo 'usdeshabilitado confirma habilitado <br>';
//     } else {
//         echo 'usdeshabilitado confirma deshabilitado en la fecha '. $param['usdeshabilitado'].' <br>';
//     }
//     echo "Usuario encontrado ⬇️ \n";
//     $object = $busqueda[0];
//     echo $object;
// } else {
//     echo "Usuario no encontrado";
// }

// test busqueda de todos los usuarios ✅ (funciona, verifica si está habilitado con todo en 0000-00-00 00:00:00, sino muestra la fecha de desactivación)
// $abmUsuario = new AbmUsuario();
// $busqueda = $abmUsuario->buscar();
// if ($busqueda) {
//     echo "Usuarios encontrados ⬇️ \n";
//     foreach ($busqueda as $usuario) {
//         echo "ID del Usuario: " . $usuario->getIdusuario() . "\n";
//         echo "Nombre del Usuario: " . $usuario->getUsnombre() . "\n";
//         echo "Mail del Usuario: " . $usuario->getUsmail() . "\n";
//         if ($usuario->getUsdesabilitado() == '0000-00-00 00:00:00') {
//             echo "Usuario habilitado: Si";
//         } else {
//             echo "Usuario deshabilitado el día " . $usuario->getUsdesabilitado();
//         }
//         echo "----------------------------\n";
//     }
// } else {
//     echo "No se encontraron usuarios";
// }



// // test de modificacion de usuario ❌ (verificar el usdesabilitado en NULL y que el idUsuario exista)
// //Obtenemos el usuario recién creado para tener su ID
// $idUsuario = 2; // ID de usuario a buscar

// // Se puede usar otro parámetro para buscar en línea 102, cambia  $abmUsuario->buscar(['usnombre' => $variableIngresada])
// // Ejemplo modificando id, nombre y mail, se puede agregar pass si se usa CryptoJD antes de enviar el pass a la BD.
// // $usuarioModificar = ['idusuario' => $value1, 'usnombre'=> $value2, 'usmail' => value3];

// // Para hacerlo general se puede 
// // $abmUsuario = new ABMUsuario(); Comentado porque ya se crea la instancia de la clase en la busqueda (linea 49), sino hay que hacerla.


// // Paso 2: Modificar el usuario

// // paso 2.1: recuperar fecha actual
// $fecha = date('Y-m-d H:i:s');

// // Paso 2.2 si queremos elegir deshabilitarlo o no
// $deshabilitarUsuario = true; // Booleano que podemos obtener de un data_submitted
// if (!$deshabilitarUsuario){
//     $fecha = "0000-00-00 00:00:00";
// }

// $modificacionData = [
//     'idusuario' => $idUsuario, // cambia $idUsuario a $usuarioModificar['idusuario'] si se usa recomendación en línea 76
//     'usnombre' => 'Juan Modificado', // cambia $idUsuario a $usuarioModificar['usnombre] si se usa recomendación en línea 76
//     'uspass' => '5678',
//     'usmail' => 'juanmodificado@gmail.com', // cambia $idUsuario a $usuarioModificar['usmail'] si se usa recomendación en línea 76
//     'usdeshabilitado' => $fecha
// ];

// // Verificar si existe el usuario
// $usuarioModificado = $abmUsuario->buscar(['idusuario' => $idUsuario]);
// if (empty($usuarioModificado)) {
//     // en caso de no existir un ID para ese usuario
//     echo "El id del usuario no existe";
// } else {
//     // Si existe el ID ejecuta la modificación
//     $resultadoModificacion = $abmUsuario->modificacion($modificacionData);

//     // Paso 3: Verificar los cambios
//     if ($resultadoModificacion && !empty($usuarioModificado)) {
//         $usuarioModificado = $usuarioModificado[0]; // Tomamos el primer resultado
//         echo "Se modificó el usuario exitosamente.\n";
//         echo "Nuevo Nombre: " . $usuarioModificado->getUsNombre() . "\n";
//         echo "Nuevo Email: " . $usuarioModificado->getUsMail() . "\n";
//     } else {
//         echo "No se pudo modificar el usuario.\n";
//     }
// }

// // Repetido el buscar solo para redundancia en la modificación
// // $busqueda = $abmUsuario->buscar();
// // if ($busqueda) {
// //     echo "<br> Usuarios encontrados ⬇️ \n";
// //     foreach ($busqueda as $usuario) {
// //         echo "ID del Usuario: " . $usuario->getIdusuario() . "\n";
// //         echo "Nombre del Usuario: " . $usuario->getUsnombre() . "\n";
// //         echo "Mail del Usuario: " . $usuario->getUsmail() . "\n";
// //         if ($usuario->getUsdesabilitado() == '0000-00-00 00:00:00') {
// //             echo "Usuario habilitado: Si";
// //         } else {
// //             echo "Usuario deshabilitado el día " . $usuario->getUsdesabilitado();
// //         }
// //         echo "----------------------------\n";
// //     }
// // } else {
// //     echo "No se encontraron usuarios";
// // }
