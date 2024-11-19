<?php

include_once "/Applications/XAMPP/xamppfiles/htdocs/PWDG42024/TPF/Model/MenuRol.php";
include_once "/Applications/XAMPP/xamppfiles/htdocs/PWDG42024/TPF/Controller/ABMRol.php";
include_once "/Applications/XAMPP/xamppfiles/htdocs/PWDG42024/TPF/Controller/ABMMenu.php";

class ABMMenuRol
{

    public function buscar($param = null)
    {
        $where = " true ";

        if ($param != null) {
            if (isset($param['idmenu'])) {
                $where .= " and idmenu ='" . $param['idmenu'] . "'";
            }

            if (isset($param['idrol'])) {
                $where .= " and idrol ='" . $param['idrol'] . "'";
            }
        }

        $arreglo = (new MenuRol())->listar($where);

        return $arreglo;
    }

    public function modificacion($param)
    {
        $resp = false;
        $objMenuRol = new MenuRol();
        $abmRol = new ABMRol();
        $listaRol = $abmRol->buscar(['idrol' => $param['idrol']]);
        $abmMenu = new ABMMenu();
        $listaMenu = $abmMenu->buscar(['idmenu' => $param['idmenu']]);
        $objMenuRol->setear($listaMenu[0], $listaRol[0]);
        if ($objMenuRol->modificar()) {
            $resp = true;
        }
        return $resp;
    }

    public function baja($param)
    {
        $resp = false;
        $objMenuRol = new MenuRol();
        $abmMenu = new ABMMenu();
        $abmRol = new ABMRol();
        $listaMenu = $abmMenu->buscar(['idmenu' => $param['idmenu']]);
        $objRol = $abmRol->buscar(['idrol' => $param['idrol']]);
        $objMenuRol->setear($listaMenu[0], $objRol[0]);

        if ($objMenuRol->eliminar()) {
            $resp = true;
        }

        return $resp;
    }

    public function alta($param)
    {
        $resp = false;
        $objMenuRol = new MenuRol();
        $abmMenu = new ABMMenu();
        $abmRol = new ABMRol();
        $listaMenu = $abmMenu->buscar(['idmenu' => $param['idmenu']]);
        $objRol = $abmRol->buscar(['idrol' => $param['idrol']]);
        
        // print_r($listaMenu);
        // print_r($objRol);

        $objMenuRol->setear($listaMenu[0], $objRol[0]);

        if ($objMenuRol->insertar()) {
            $resp = true;
        }
        return $resp;
    }
}
