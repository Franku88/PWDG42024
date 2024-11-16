<?php
include_once '../../../configuracion.php';

$data = Funciones::data_submitted();

if (!empty($data)) {
    $arrProductos = ABMProducto->buscar(['idproducto' => $data['idproducto']]);
    $resultado = null;
    if (!empty($arrProductos)) {
        $producto = $arrProductos[0];
        $imagenesDiv = "";
        $dirImagenes = '/View/Assets/Media/'. $producto['idproducto'].'/images';
        $imgType = $dirImagenes . '/*.jpg';
        $scan = glob($imgType);

        if ($scan == 0) {
            $imagenesDiv = "SIN IMÁGENES";
        } else {
            for ($i = 0; $i < $scan; $i++){
                "<img src='".$dirImagenes."/img".$i."' alt='img".$i."'>";
            }
        }

        /*
        <?php
        $directorio = '/ruta/del/directorio';  // Especifica el directorio a buscar

        // Obtener la lista de archivos y directorios
        $archivos = scandir($directorio);

        // Filtrar los archivos (excluyendo los directorios '.' y '..')
        $archivos = array_filter($archivos, function($archivo) use ($directorio) {
         return is_file($directorio . '/' . $archivo);  // Verifica si es un archivo
        });

        // Contar los archivos
        echo "Número de archivos en el directorio: " . count($archivos);
        ?>
        <?php
        $directorio = '/ruta/del/directorio';  // Especifica el directorio a buscar
        $patron = $directorio . '/*.txt';  // Solo contar archivos .txt

        // Obtener los archivos que coinciden con el patrón
        $archivos = glob($patron);

        // Contar los archivos
        echo "Número de archivos .txt en el directorio: " . count($archivos);
        ?>
        */
        $resultado =

            "<main class='borde-inactivo-steam'>
        <div id=''>
            <div class=''>
                <div class=''>
                    <div class='producto__resumen borde-activo-steam'>
                        <div class='producto__data borde-inactivo-steam'>
                            <div class='producto__portada__borde'>
                                <div class='producto__portada__marco'>
                                    <img id='producto__portada'>
                                    <!-- PORTADA DEL PRODUCTO -->
                                </div>
                            </div>
                            <div class='producto__descripcion'>
                                <div>
                                    <!--- TEXTO DESCRIPTIVO DEL PRODUCTO --->
                                    <p id='producto__descripcion'> " . $producto['prodetalle'] . " </p>
                                </div>
                            </div>
                            <div id='producto__imagenes' class='borde-activo-steam'>
                                " . $imagenesDiv . "
                            </div>
                        </div>
                    </div>
                    <div id='producto__video borde-activo-steam'>
                        <!-- TRAILER/VIDEO/IMAGEN AL RESPECTO SI FUERA EL CASO -->
                        <iframe width='800' height='600' class='borde-inactivo-steam' src='https://www.youtube.com/embed/CHm2d3wf8EU' title='Cruelty Squad Trailer' frameborder='0' allowfullscreen>
                        </iframe>
                    </div>
                </div>
            </div>
            <div class='producto__bottom'>
                <div class='producto__precios'>
                    <p id='producto__precio__pesos'></p>
                    <p id='producto__precio__dolares'></p>
                </div>
                <div class='producto__botones'>
                    <button class='boton__agregar' onclick='agregarAlCarroTitulo('Cruelty Squad', null)'>Agregar al carro</button>
                    <button class='boton__carro' onclick='redirigir('/pages/carro.html')>Ir al carro</button>
                </div>
            </div>
        </div>
        <div>

        </div>
    </main> ";
    } else {
        $resultado = '<h2> PRODUCTO NO ENCONTRADO </h2>';
    }
} else {
    $resultado = '<h2> NO SE HA SELECCIONADO UN PRODUCTO </h2>';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <H1> PRODUCTO GENERICO </H1>

    <?php
    echo $resultado;
    ?>


</body>

</html>