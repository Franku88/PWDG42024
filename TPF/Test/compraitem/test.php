<?php
include_once '../../configuracion.php';

// testing de ABM de compraitem
// include_once "/Applications/XAMPP/xamppfiles/htdocs/PWDG42024/TPF/Model/BaseDatos.php";
// include_once '/Applications/XAMPP/xamppfiles/htdocs/PWDG42024/TPF/Model/CompraItem.php';
// include_once '/Applications/XAMPP/xamppfiles/htdocs/PWDG42024/TPF/Controller/ABMCompraItem.php';


//test alta de CompraItem ❌ (no se puede probar porque faltan objetos de producto y compra)

// insertando CompraItem nuevo
// $param = array('producto' => 1, 'compra' => '1', 'cicantidad' => 3);
// $abmCompraItem = new ABMCompraItem();
// $alta = $abmCompraItem->alta($param);

// if ($alta) {
//     echo "Alta exitosa";
// } else {
//     echo "Error en la alta";
// }



// test baja de CompraItem ✅ funciona
// $abmCompraItem = new ABMCompraItem();
// $baja = $abmCompraItem->baja(['idcompraitem' => 1]);
// if ($baja) {
//     echo "Baja exitosa";
// } else {
//     echo "Error en la baja";
// }

// test buscar CompraItem por id ✅ (funciona)
// $param = ['idCompraItem' => 2];
// $abmUsuario = new ABMCompraItem();
// $busqueda = $abmUsuario->buscar($param);
// if ($busqueda) {
//     echo "CompraItem encontrado ⬇️ \n";
//     $object = $busqueda[0];
//     echo $object;
// } else {
//     echo "CompraItem no encontrado";
// }

// test busqueda de todos los CompraItem ✅ (funciona)
// $abmCompraItem = new ABMCompraItem();
// $busqueda = $abmCompraItem->buscar();
// if ($busqueda) {
//     echo "CompraItems encontrados ⬇️ \n";
//     foreach ($busqueda as $CompraItem) {
//         echo "ID del CompraItem: " . $CompraItem->getIdCompraItem() . "\n";
//         echo "----------------------------\n";
//         echo $CompraItem . "\n";
//     }
// } else {
//     echo "No se encontraron usuarios";  
// }



// test de modificacion de CompraItem ✅ (falta probar con objeto, el echo de error en la modificación lo hace)
// $CompraItem = 3;
// $abmCompraItem = new ABMCompraItem();
// // Paso 2: Modificar el usuario
// //paso 2.1: recuperar fecha actual
// $modificacionData = [
//     'idCompraItem' => $CompraItem,
//     'producto' => 2,
//     'compra' => 3,
//     'cicantidad' => 6
// ];
// // Ejecutar la modificación
// $resultadoModificacion = $abmCompraItem->modificacion($modificacionData);
// if ($resultadoModificacion) {
//     echo "Modificación exitosa";
// } else {
//     echo "Error en la modificación";
// }