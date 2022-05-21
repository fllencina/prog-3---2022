<?php

require_once "ManejadorArchivos.php";

class Helado
{
    public $sabor;
    public $precio;
    public $tipo;
    public $stock;
    public $id;
    function __contruct()
    {
    }

    function NuevoHelado($sabor, $precio, $tipo, $stock)
    {
        $elemento = new Helado();

        $elemento->sabor = $sabor;
        $elemento->precio = $precio;
        $elemento->tipo = $tipo;
        $elemento->stock = $stock;
        $elemento->id = GeneradorID("Helado");
        return $elemento;
    }


    static function InsertarHelado($array, $sabor, $precio, $tipo, $stock, $path, $archivo = null, $pathImagen = null)
    {
        $insertar = false;
        if (!empty($array)) {
            if (self::ExisteHeladoDetalle($array, $sabor, $tipo, $stock) != 1) {
                $insertar = true;
            } else {
                self::Actualizar($array, $sabor, $precio, $tipo, $stock, $path);
                return "Cantidad actualizada.";
            }
        } else {
            $insertar = true;
        }
        if ($insertar) {

            $elemento = self::NuevoHelado($sabor, $precio, $tipo, $stock);
            $Nombre = $tipo . "-" . $sabor;
            GuardarFoto($archivo, $Nombre, $pathImagen);
            return  GuardarJson($array, $path, $elemento);
        }
    }
    static function ExisteHeladoDetalle($array, $sabor, $tipo)
    {
        $existeSabor = false;
        $existeTipo = false;

        foreach ($array as $x => $val) {

            if ($val->tipo ==  $tipo && $val->sabor == $sabor) {
                return 1;
            } else if ($val->tipo ==  $tipo  && $val->sabor != $sabor) {
                $existeTipo = true;
                $existeSabor = false;
            } else if ($val->tipo !=  $tipo  && $val->sabor == $sabor) {
                $existeSabor = true;
                $existeTipo = false;
            }
        }
        if (!$existeSabor && $existeTipo) {
            return -1;
        }
        if ($existeSabor && !$existeTipo) {
            return -2;
        }
        return 0;
    }


    static function Actualizar($array, $sabor, $precio, $tipo, $stock,  $path)
    {
        foreach ($array as $x => $val) {
            if ($val->tipo ==  $tipo && $val->sabor == $sabor) {
                $val->stock = $val->stock + $stock;
                $val->precio = $precio;
            }
        }

        return  GuardarJson($array, $path, null);
    }

    static function ExisteHeladoStock($array, $sabor, $tipo, $stock)
    {
        foreach ($array as $x => $val) {

            if ($val->tipo ==  $tipo && $val->sabor == $sabor && $val->stock >= $stock) {
                return 1;
            }
        }
        return 0;
    }
    static function ObtenerHelado($array, $sabor, $tipo)
    {
        foreach ($array as $x => $val) {

            if ($val->tipo ==  $tipo && $val->sabor == $sabor ) {
                return $val;
            }
        }
        return 0;
    }
    static function RestarStock($array, $sabor, $tipo, $stock, $path)
    {
        foreach ($array as $x => $val) {
            if ($val->sabor ==  $sabor  && $val->tipo ==  $tipo) {
                $val->stock = $val->stock - $stock;

                break;
            }
        }
        GuardarJson($array, $path, null);
    }
}
