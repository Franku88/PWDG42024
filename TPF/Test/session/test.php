<?php 


include_once '/Applications/XAMPP/xamppfiles/htdocs/PWDG42024/TPF/Controller/Session.php';


// test iniciar session ✅

// $session = new Session(); // session_start()
// $sessionIniciar = $session->iniciar('test', 'test');
// if ($sessionIniciar) {
//     echo 'Session iniciada \n';
//     echo $_SESSION['idusuario'];
// } else {
//     echo 'No se pudo iniciar la session';
// }

// test cerrar session ✅
// $session = new Session(); // session_start()
// $sessionCerrar = $session->cerrar();
// if ($sessionCerrar) {
//     echo 'Session cerrada';
// } else {
//     echo 'No se pudo cerrar la session';
// }

// test session activa ✅
// $session = new Session(); // session_start()
// $sessionActiva = $session->activa();
// if ($sessionActiva) {
//     echo 'Session activa';
// } else {
//     echo 'Session no activa';
// }

// test validar session  ✅ (debe devolver false si los datos no se pre cargaron)
// $session = new Session(); // session_start()
// $validarSession = $session->validar();
// if ($validarSession) {
//     echo 'Session valida';
// } else {
//     echo 'Session no valida';
// }

// test getUsuario en session ✅
// $session = new Session(); // session_start()
// // iniciamos la session con los datos de un usuario
// $iniciarSession = $session->iniciar('test', 'test');
// if ($iniciarSession) {
//     $usuario = $session->getUsuario();
//     echo $usuario;
// } else {
//     echo 'No se pudo iniciar la session';
// }

// test getRol en session ✅
// $session = new Session(); // session_start()
// // iniciamos la session con los datos de un usuario
// $iniciarSession = $session->iniciar('test', 'test');
// if ($iniciarSession) {
//     $rol = $session->getRol();
//     echo $rol;
// } else {
//     echo 'No se pudo iniciar la session';
// }