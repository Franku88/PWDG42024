<?php 


class Controlador {
    public function validarUsuario($nuevoUsuario , $usuarios) {
        $usuarioValido = false;
        foreach ($usuarios as $usuario) {
            if ($usuario['user'] == $nuevoUsuario['user'] && $usuario['password'] == $nuevoUsuario['password']) {
                $usuarioValido = true;
                $usuario  = $nuevoUsuario['user'];
            }
        }
        return [$usuarioValido];
    }
}