<?php


include_once "/Applications/XAMPP/xamppfiles/htdocs/PWDG42024/TPF/Model/UsuarioRol.php";
include_once "/Applications/XAMPP/xamppfiles/htdocs/PWDG42024/TPF/Controller/ABMRol.php";
include_once "/Applications/XAMPP/xamppfiles/htdocs/PWDG42024/TPF/Controller/ABMUsuario.php";

class ABMUsuarioRol
{

    public function buscar($param = null)
    {
        $where = " true ";

        if ($param != null) {
            if (isset($param['idusuario'])) {
                $where .= " and idusuario ='" . $param['idusuario'] . "'";
            }

            if (isset($param['idrol'])) {
                $where .= " and idrol ='" . $param['idrol'] . "'";
            }
        }

        $arreglo = (new UsuarioRol())->listar($where);

        return $arreglo;
    }

    public function modificacion($param)
    {
        $resp = false;
        $objUsRol = new UsuarioRol();
        $abmRol = new  ABMRol();
        $abmUsuario = new ABMUsuario();
        $listaRol = $abmRol->buscar(['idrol' => $param['idrol']]);
        $listaUsuario = $abmUsuario->buscar(['idusuario' => $param['idusuario']]);
        $objUsRol->cargarDatos($listaUsuario[0]->getIdusuario(), $listaRol[0]->getId());
        if ($objUsRol->modificar()) {
            $resp = true;
        }
        return $resp;
    }

    public function baja($param)
    {
        $resp = false;
        $objRel = new UsuarioRol();
        $abmUs = new ABMUsuario();
        $abmRol = new ABMRol();
        $arrayUs = $abmUs->buscar(['idusuario' => $param['idusuario']]);
        $objRol = $abmRol->buscar(['idrol' => $param['idrol']]);
        $objRel->cargarDatos($arrayUs[0]->getIdusuario(), $objRol[0]->getId());

        if ($objRel->eliminar()) {
            $resp = true;
        }

        return $resp;
    }

    public function alta($param)
    {
        $resp = false;
        $objUsuarioRol = new UsuarioRol();
        $abmUs = new ABMUsuario();  
        $abmRol = new ABMRol();
        $arrayUs = $abmUs->buscar(['idusuario' => $param['idusuario']]);
        $objRol = $abmRol->buscar(['idrol' => $param['idrol']]);

        // print_r($arrayUs[0]->getIdusuario());
        // print_r($objRol[0]->getId());
        // dado que UsuarioRol toma idUsuario y idRol, utilizar los getters de estas claves
        $objUsuarioRol->cargarDatos($arrayUs[0]->getIdusuario(), $objRol[0]->getId());

        if ($objUsuarioRol->insertar()) {
            $resp = true;
        }
        return $resp;
    }
}
