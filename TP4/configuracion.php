<?php 
// Configs de aplicación. Incluir en toda pagina del proyecto

// Browser config
header('Content-Type: text/html; charset=utf-8');
header('Cache-Control: no-cache, must-revalidate');

// Paths constants
$dir = '/PWDG42024/TP4'; // Directorio del proyecto dentro del servidor (default: dentro de "C:/xampp/htdocs")
define('BASE_URL', 'http://'.$_SERVER['HTTP_HOST'].$dir ); // Para hrefs (links)
define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT'].$dir); // Define raiz del proyecto como cons. ROOT_PATH
define('STRUCTURE_PATH', ROOT_PATH.'/View/Structure'); //Define path de la estructura (Header, footer, menu, etc)
define('INCLUDE_PATH', STRUCTURE_PATH.'/Include'); // Define path de scripts a utilizar
$_SESSION["ROOT"] = ROOT_PATH; //$SESSION: Array (inicalmente vacio) que persiste durante sesion del usuario

// Global includes
include_once(ROOT_PATH.'/Util/autoloader.php'); //Funciones usadas en toda la sesion
require_once 'vendor/autoload.php';

?>
