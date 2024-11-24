<?php 
// Configs de aplicación. Incluir en toda pagina del proyecto

// Browser config
header('Content-Type: text/html; charset=utf-8');
header('Cache-Control: no-cache, must-revalidate');

// Paths constants
$dir = '/PWDG42024/TPF'; // Directorio del proyecto dentro del servidor (default: dentro de "C:/xampp/htdocs")
define('BASE_URL', 'http://'.$_SERVER['HTTP_HOST'].$dir ); // URL principal del sitio (direccion web)
define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT'].$dir); // Raiz del proyecto (directorio local)
define('STRUCTURE_PATH', ROOT_PATH.'/View/Structure'); // Directorio de la estructura (Header, footer, menu, etc)
//define('INCLUDE_PATH', STRUCTURE_PATH.'/Include'); // Directorio de la estructura de scripts a utilizar
$_SERVER["ROOT"] = ROOT_PATH; //Establece directorio raiz en array

// Global includes
include_once(ROOT_PATH.'/Util/autoloader.php'); // Funciones usadas en toda la sesion
// require_once 'vendor/autoload.php'; // Con Composer
?>
