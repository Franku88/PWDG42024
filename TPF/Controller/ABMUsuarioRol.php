<?php


include_once "/Applications/XAMPP/xamppfiles/htdocs/PWDG42024/TPF/Model/UsuarioRol.php";
include_once "/Applications/XAMPP/xamppfiles/htdocs/PWDG42024/TPF/Controller/ABMRol.php";
include_once "/Applications/XAMPP/xamppfiles/htdocs/PWDG42024/TPF/Controller/ABMUsuario.php";

class ABMUsuarioRol
{
    // ['usuario' => $objUsuario , 'rol' => $objRol]
    private function cargarObjeto ($param) {
        $obj =  null;
        if (array_key_exists('usuario', $param) && array_key_exists('rol', $param)) {
            $objUsuario = $param['usuario'];
            $objRol = $param['rol'];
            // cargamos datos en UsuarioRol 
            $obj = new UsuarioRol();
            $obj->cargarDatos($objUsuario, $objRol);
        }
        return $obj;
    }



    // ['usuario' => $objUsuario , 'rol' => $objRol]
    public function buscar($param = null)
    {
        $where = " true ";

        if ($param != null) {
            if (isset($param['usuario'])) {
                $where .= " and idusuario ='" . $param['usuario']->getIdusuario() . "'";
            }

            if (isset($param['rol'])) {
                $where .= " and idrol ='" . $param['rol']->getIdrol() . "'";
            }
        }

        $arreglo = (new UsuarioRol())->listar($where);

        return $arreglo;
    }

    /**
     * Modificar los datos de un usuariorol con los que tiene el objeto actual 
     * (Ambos y unicos atributos son clave, nunca se utilizaria este metodo. En dicho caso,
     * se realizara el alta de otro usuariorol y luego la baja del que no es necesario)
     * @return false // no se utiliza en la relacion
     */
    public function modificacion($param)
    {
        return false;
    }

    // ['usuario' => $objUsuario , 'rol' => $objRol]
    public function baja($param)
    {
        $resp = false;
        $usuarioRol = $this->cargarObjeto($param);
        if ($usuarioRol != null && $usuarioRol->eliminar()) {
            $resp = true;
        }
        return $resp;
    }


    // ['usuario' => $objUsuario , 'rol' => $objRol]
    public function alta($param)
    {
        $resp = false; 
        $usuarioRol = $this->cargarObjeto($param);
        if ($usuarioRol != null && $usuarioRol->insertar()) {
            $resp = true;
        }
        return $resp;
    }
}
