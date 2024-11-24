<?php
include_once "../../../configuracion.php";
include STRUCTURE_PATH . "/HeadSafe.php";

$sessionValida = $session->validar();
if ($sessionValida) {
    $usuarioId = $session->getUsuario()->getIdusuario();
} else {
    $usuarioId = 0;
}
//ESTE BLOQUE DEBE SER PERSONALIZADO PARA CADA PAGINA CON HEAD SAFE (ESTABLECER SU ID)
$menuesFiltrados = array_filter($menues, function ($menu) {
    return ($menu->getIdmenu()) == 7; //7 es el id del menu Carrito
});

if (empty($menuesFiltrados)) {
    echo ("Sesión inválida"); //Puede embellecerse un poco más
    //header("Location: ".ROOT_PATH."/index.php");
    exit();
}
//-------------------------------------------------------------------------------------
?>

<div class="container">
    <h1>Carrito de compras</h1>
    <div class="row" id="catalogo"></div> <!-- Aquí se cargarán los productos -->
</div>


<?php include STRUCTURE_PATH . '/Foot.php'; ?>