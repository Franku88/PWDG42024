<?php


include_once "/Applications/XAMPP/xamppfiles/htdocs/PWDG42024/TPF/Model/Compra.php";
include_once "/Applications/XAMPP/xamppfiles/htdocs/PWDG42024/TPF/Controller/ABMUsuario.php";

class ABMCompra
{
    // ['cofecha' => $cofecha, 'objUsuario' => $objUsuario] idcompra es AUTO_INCREMENT
    private function cargarObjeto($param)
    {
        $obj = null;
        if (array_key_exists('cofecha', $param) and array_key_exists('objUsuario', $param)) {
            $objUsuario = $param['objUsuario'];
            $idcompra = array_key_exists('idcompra', $param) ? $param['idcompra'] : null;
            $obj = new Compra();
            $obj->cargarDatos($idcompra, $param['cofecha'], $objUsuario);
        }
        return $obj;
    }
    private function seteadoCamposClaves($param) {
        $resp = false;
        if (isset($param['idcompra'])) {
            $resp = true;
        }
        return $resp;
    }
    private function cargarObjetoConClave($param) {
        $obj = null;
        if ($this->seteadoCamposClaves($param)) {
            $obj = new Compra();
            $obj->cargarDatos($param['idcompra']);
        }
        return $obj;
    }

    public function buscar($param = null)
    {
        $where = " true ";
        if ($param != null) {
            if (isset($param['idcompra'])) {
                $where .= " and idcompra = '" . $param['idcompra'] . "'";
            }
            if (isset($param['cofecha'])) {
                $where .= " and cofecha = '" . $param['cofecha'] . "'";
            }
            if (isset($param['objUsuario'])) {
                $where .= " and idusuario = '" . $param['objUsuario']->getIdusuario() . "'";
            }
        }
        $arreglo = (new Compra())->listar($where);
        return $arreglo;
    }
    public function alta($param)
    {
        $resp = false;
        $compra = $this->cargarObjeto($param);
        if ($compra != null and $compra->insertar()) {
            $resp = true;
        }
        return $resp;
    }
    public function baja($param)
    {
        $resp = false;
        // buscamos la compra y cargamos los datos
        if ($this->seteadoCamposClaves($param)) {
            $compra = $this->cargarObjetoConClave($param);
            if ($compra != null and $compra->eliminar()) {
                $resp = true;
            }
        }
        return $resp;
    }
}
