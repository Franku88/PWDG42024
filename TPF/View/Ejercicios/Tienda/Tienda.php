<?php
include_once '../../../configuracion.php';
include STRUCTURE_PATH . '/Head.php';
$abmProducto = new ABMProducto();
$productos = $abmProducto->buscar();
?>

<div class="container py-4">
    <h1 class="text-center mb-4">SteamDisk</h1>

    <!-- Product Grid -->
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php foreach ($productos as $producto) : ?>
            <div class="col">
                <div class="h-100 shadow-sm">
                    <!-- Product Details -->
                    <div class="card-body bg-steam-darkgreen bdr-steam-focus d-flex">

                        <div class="align-self-center bdr-steam-nofocus m-2 p-2">
                            <!-- Product Image -->
                            <?php echo ("<img src='../../Media/Product/" . $producto->getIdproducto() . "/icon.png'  width='200' height='200' alt='...'>") ?>
                        </div>

                        <div class="d-flex flex-column justify-content-center items-center ">
                            <h5 class="card-title">
                                <?= htmlspecialchars($producto->getPronombre()); ?>
                            </h5>

                            <p class="card-text">
                                Precio: $<?= number_format($producto->getProprecio(), 2) ?>
                            </p>
                        </div>
                    </div>

                    <!-- Product Actions -->
                    <div class="bg-steam-lightgreen bdr-steam-nofocus  text-center p-2">
                        <?php echo ("<a href='../Producto/Producto.php?idproducto=" . $producto->getIdproducto() . "' class='btn btn-primary btn-steam'>Ver detalles</a>") ?>
                        <?php if ($usuarioRolId == 1) { ?>
                            <button class="btn btn-primary btn-steam boton_agregar" id="<?= $producto->getIdproducto() ?>">Agregar al carro</button>
                            <button class="btn btn-primary btn-steam boton_eliminar" id="<?= $producto->getIdproducto() ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                </svg></button>
                        <?php } ?>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>



    </div>
</div>

<?php include STRUCTURE_PATH . '/Foot.php'; ?>