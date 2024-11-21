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
        <?php foreach ($productos as $producto): ?>
            <div class="col">
                <div class="h-100 shadow-sm">
                    <!-- Product Details -->
                    <div class="card-body bg-steam-darkgreen bdr-steam-focus d-flex">
                        
                        <div class="align-self-center bdr-steam-nofocus m-2 p-2">
                            <!-- Product Image -->
                            <?php  echo("<img src='../../Media/Product/".$producto->getIdproducto()."/icon.png'  width='200' height='200' alt='...'>") ?>
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
                        <?php echo ("<a href='../Producto/Producto.php?idproducto=".$producto->getIdproducto()."' class='btn btn-primary btn-steam'>Ver detalles</a>") ?>
                        <button class="btn btn-primary btn-steam">Agregar al carro</button>
                    </div>
                </div>
            </div>
            
        <?php endforeach; ?>

        

    </div>
</div>

<?php include STRUCTURE_PATH . '/Foot.php'; ?>
