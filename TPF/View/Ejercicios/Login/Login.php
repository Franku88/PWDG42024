<?php
include_once '../../../configuracion.php';
include STRUCTURE_PATH . '/Head.php';
$session = new Session();
if ($session->validar()) {
    header('Location: ../../Ejercicios/Tienda/Tienda.php');
}
?>

<div class="container py-4">
    <div class="text-center p-2 bg-steam-lightgreen bdr-steam-nofocus mx-auto rounded-4" style="margin-top: 200px; max-width: 400px;">
        <h2 class="m-4">Login</h2>
        <form class="bg-steam-darkgreen bdr-steam-focus rounded-4 m-4 d-flex flex-column justify-content-center align-items-center p-5 gap-5" action="LoginAction.php" method="POST">
            <input
                type="text"
                name="user"
                id="user"
                placeholder="Usuario"
                class="border-0 border-bottom p-2 bg-transparent text-white"
                style="outline: none; box-shadow: none;"
                required
                >
            <input
                type="password"
                name="password"
                id="password"
                placeholder="Contraseña"
                class="border-0 border-bottom p-2 bg-transparent text-white"
                style="outline: none; box-shadow: none;"
                required
                >
            <button type="submit" class="btn btn-primary btn-steam">Ingresar</button>
        </form>
    </div>
</div>

<?php include STRUCTURE_PATH . '/Foot.php'; ?>