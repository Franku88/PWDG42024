<?php
include_once '../../../configuracion.php';

$abmUsuarios = new ABMUsuario();
$usuarios = $abmUsuarios->buscar(null);


?>

<?php include STRUCTURE_PATH . '/Head.php'; ?>
<div class="alert alert-secondary rounded-4 m-5 border-steam-activo">
    <p class="fs-5"> <b>Ejercicio 1</b> - un script Vista/listarUsuario.php que liste los usuario registrados y permita actualizar sus datos o
        realizar un borrado lógico. Las acciones que se van a poder invocar son:
        accion/actualizarLogin.php y accion/eliminarLogin.php.</p>
</div>
<div class="mx-4 my-3">
    <h1> Usuarios Registrados </h1>
    <div class="rounded-4 overflow-x-auto p-3">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">ID Usuario</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Email</th>
                    <th scope="col">Deshabilitado</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario) : ?>
                    <?php $usuarioDesabilitado = ($usuario->getUsdesabilitado() === null ) ? 'null' : $usuario->getUsdesabilitado() ?>
                    <tr>
                        <th scope="row"><?php echo $usuario->getIdusuario(); ?></th>
                        <td><?php echo $usuario->getUsnombre(); ?></td>
                        <td><?php echo $usuario->getUsMail(); ?></td>
                        <td><?php echo $usuarioDesabilitado ?></td>
                        <td>
                            <a href="accion/actualizarLogin.php?id=<?php echo $usuario->getIdusuario(); ?>" class="btn btn-primary">Actualizar</a>
                            <a href="accion/eliminarLogin.php?id=<?php echo $usuario->getIdusuario(); ?>" class="btn btn-danger">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>

        </table>
    </div>
</div>

<?php include STRUCTURE_PATH . '/Foot.php'; ?>