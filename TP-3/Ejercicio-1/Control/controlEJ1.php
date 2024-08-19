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

        if ($arregloFiles['archivo']["error"] <= 0) {
            // Intentamos copiar el archivo al servidor.
            if (!copy($arregloFiles['archivo']['tmp_name'], $this->getDir() . $arregloFiles['archivo']['name'])) {
                $mensaje = 0; //'ERROR: no se pudo cargar el archivo';
            } else {
                $mensaje = 1; //"El archivo " . $arregloFiles['archivo']["name"] . " se ha copiado con Éxito <br />";
            }
        } else {
            $mensaje = -1; //"ERROR: no se pudo cargar el archivo. No se pudo acceder al archivo Temporal";
        }
        return $mensaje;
    }
}
