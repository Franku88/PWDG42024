<?php
include_once "../../../configuracion.php";
include STRUCTURE_PATH . "/HeadSafe.php";
?>

<div class="bg-steam-lightgreen bdr-steam-nofocus w-75 mx-auto my-5">
    <div class="bdr-steam-nofocus px-5">
        <div class="m-3"> 
            <h1> Carro </h1>
        </div>
        <div class="w-100 m-auto flex-column">
            <div class="bg-steam-lightgray d-flex flex-column bdr-steam-focus " style="min-height: 100px;">
                <!-- Aqui se cargaran los nuevos divs con productos-->
            </div>
            <div class="d-flex flex-column align-items-end my-2">
                <button class="btn btn-success rounded-3" style="font-weight: bold; max-width: 150px" onclick="comprarCarro();">Comprar</button>
                <button class="btn btn-danger rounded-3" style="font-weight: bold; max-width: 150px;" onclick="vaciarCarro();">Vaciar carro</button>
            </div>
        </div>
    </div>
</div>

<script>
    // ajax para listar los productos agregados al carrito (CompraItem)
    $(document).ready(function() {

    });
</script>

<?php include STRUCTURE_PATH . '/Foot.php'; ?>



