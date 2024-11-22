<?php
include_once '../../../../configuracion.php';
$data = Funciones::data_submitted();  // Obtener los datos enviados

// Verificar que todos los campos necesarios están presentes
if (isset($data['usuarioID'])) {
    // buscar el usuario
    $usuarios = (new ABMProducto())->buscar(['idproducto' => $data['usuarioID']]);
    
    if (!empty($usuarios)) {
        $usuario = $usuarios[0];
        $param['idusuario'] = $usuario->getIdproducto();
        if (isset($data['modNombre'])) {
            $param['usnombre'] = $data['modNombre'];
        } else {
            $param['usnombre'] = $usuario->getUsNombre();
        }
        if (isset($data['modEmail'])) {
            $param['usmail'] = $data['modEmail'];
        } else {
            $param['usmail'] = $usuario->getUsMail();
        }
        // 1.deberiamos tener construido el usuario con idusuario, usnombre, usmail a actualizar
        // 2.actualizar el idrol de la tabla usuarioRol con el rol seleccionado
        $abmUsuarioRol = new ABMUsuarioRol();
        $abmRol = new ABMRol();
        // 3. buscar el objRol  con el nombre del rol seleccionado
        $rol = $abmRol->buscar(['rodescripcion' => $data['rol']]);
        // 3. actualizar el usuarioRol utilizando el objUsuario y el objRol
        $modificacionUsuarioRol = $abmUsuarioRol->modificacion(['usuario' => $usuario, 'rol' => $rol[0]]);
        
        if ($modificacion) {
            echo json_encode(['success' => true, 'message' => 'usuario modificado exitosamente.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al modificar el producto.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Producto no encontrado.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos.']);
}
