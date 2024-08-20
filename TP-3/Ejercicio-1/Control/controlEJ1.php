<?php
class Archivo
{
    private $dir;

    public function __construct()
    {
        $this->dir = '../../Modelo/archivos/';
    }
    /**
     * Get the value of dir
     */
    public function getDir()
    {
        return $this->dir;
    }

    /**
     * Set the value of dir
     *
     * @return  self
     */
    public function setDir($dir)
    {
        $this->dir = $dir;

        return $this;
    }

    public function upload($arregloFiles)
    {
        $mensaje = "";
        $extension = false;
        if ($arregloFiles['archivo']["type"] == "application/pdf" || $arregloFiles['archivo']["type"] == "application/doc") {
            $extension = true;
        }

        if ($arregloFiles['archivo']["error"] <= 0 && $arregloFiles['archivo']["size"] <= 2097152 && $extension) {
            // Intentamos copiar el archivo al servidor.
            if (!copy($arregloFiles['archivo']['tmp_name'], $this->getDir() . $arregloFiles['archivo']['name'])) {
                $mensaje = 0; //'ERROR: no se pudo cargar el archivo';
            } else {
                $mensaje = 1; //"El archivo " . $arregloFiles['archivo']["name"] . " se ha copiado con Éxito <br />";
            }
        } else {
            $mensaje = -1; //"ERROR: no se pudo cargar el archivo. Verifique que su archivo sea de la extensión correcta (*.doc o *.pdf) y no exceda el tamaño máximo permitido (2 MB). <br />";
        }
        return $mensaje;
    }
}
