<?php

class Pizza
{
    public $sabor;
    public $precio;
    public $tipo;
    public $cantidad;
    public $imagenPizza;


    function __construct($sabor, $precio, $tipo, $cantidad)
    {

        $this->sabor = $sabor;
        $this->precio = $precio;
        $this->tipo = $tipo;
        $this->cantidad = $cantidad;
        $this->id = self::GeneradorID();
        //return $pizza;
        // var_dump($this);
    }

    static function  GeneradorID()
    {
        if (!file_exists("GeneradorID.txt")) {
            $file = fopen("GeneradorID.txt", "w+");
            fwrite($file, 0);
            fclose($file);
        }

        $file = fopen("GeneradorID.txt", "r");
        $id = fgets($file);
        fclose($file);
        $file = fopen("GeneradorID.txt", "w");
        fwrite($file, $id + 1);
        fclose($file);
        return $id + 1;
    }

    static function GuardarJson($arrayJson, $path, $dato = null)
    {

        $strRet = "";
        $fh = fopen($path, 'w+');
        fwrite($fh, "[");
        for ($i = 0; $i < count($arrayJson); $i++) {
            $jsonencoded = json_encode($arrayJson[$i], true, JSON_FORCE_OBJECT);

            fwrite($fh, $jsonencoded);
            if ($i < (count($arrayJson) - 1)) {
                fwrite($fh, ",\r\n");
            }
        }
        $Retorno = false;
        if ($dato != null) {
            $jsonencoded = json_encode($dato, true, JSON_FORCE_OBJECT);
            if (count($arrayJson) == 0) {
                $Retorno = fwrite($fh, $jsonencoded);
            } else {
                $Retorno = fwrite($fh, ",\r\n" . $jsonencoded);
            }
        }
        fwrite($fh, "]");
        fclose($fh);

        if ($Retorno) {
            $strRet = "Dato Agregado Correctamente.";
        } else {
            $strRet = "El Dato no pudo ser agregado.";
        }
        return $strRet;
    }

    static function LeerJSON($path)
    {
        $Array = array();
        if (file_exists($path)) {
            $datos = file_get_contents($path);
            $json = json_decode($datos);
            if (!empty($json)) {
                foreach ($json as $DatoEspecifico) {
                    array_push($Array, $DatoEspecifico);
                }
            }
        } else {
            $file = fopen($path, "w+");
            fclose($file);
        }
        return $Array;
    }

    static function ExistePizzaDetalle($arrayPizza, $sabor, $tipo )
    {
        //var_dump($arrayPizza);
        $existeSabor = false;
        $existeTipo = false;

        foreach ($arrayPizza as $x => $val) {

            if ($val->tipo ==  $tipo && $val->sabor == $sabor  ) {
                return 1;
            } else if ($val->tipo ==  $tipo  && $val->sabor != $sabor) {
                $existeTipo = true;
                $existeSabor = false;
            } else if ($val->tipo !=  $tipo  && $val->sabor == $sabor) {
                // echo "existe el sabor, no el tipo";
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
    static function ExistePizzaStock($arrayPizza, $sabor, $tipo,$cantidad)
    {
        foreach ($arrayPizza as $x => $val) {

            if ($val->tipo ==  $tipo && $val->sabor == $sabor && $val->cantidad >= $cantidad  ) {
                return 1;
            } 
        }
        return 0;
    }
    static function RestarStock($arrayPizza, $sabor, $tipo, $cantidad, $path)
    {
        foreach ($arrayPizza as $x => $val) {
            if ($val->sabor ==  $sabor  && $val->tipo ==  $tipo) {
                $val->cantidad = $val->cantidad - $cantidad;

                break;
            }
        }
        self::GuardarJson($arrayPizza, $path, null);
    }
    static function ActualizarPizza($arrayPizza, $sabor, $precio, $tipo, $cantidad,  $path)
    {
        // var_dump($arrayPizza);
        foreach ($arrayPizza as $x => $val) {

            if ($val->tipo ==  $tipo && $val->sabor == $sabor) {

                $val->cantidad = $val->cantidad + $cantidad;
                $val->precio = $precio;
            }
        }
        // var_dump($arrayPizza);
        return  self::GuardarJson($arrayPizza, $path, null);
    }
    static function GuardarFotoPizza($file, $Nombre,$pathImagen)
    {
        echo $pathImagen;
        if (!is_dir($pathImagen)) {
            mkdir($pathImagen, 0777);
        }
        $dic = $pathImagen;
        $nameImagen = $file["archivo"]["name"];
        //echo $nameImagen;
        $explode = explode(".", $nameImagen);
        $tamaño = count($explode);
        $dic .= $Nombre;
        $dic .= ".";
        $dic .= $explode[$tamaño - 1];
        //echo $dic;
        $Retorno = false;
        $Retorno = move_uploaded_file($_FILES["archivo"]["tmp_name"], $dic);
        return $Retorno;
    }
    static function InsertarPizza($arrayPizza, $sabor, $precio, $tipo, $cantidad, $path,$archivo,$pathImagen)
    {
        // echo $sabor;
        // echo $tipo;
        $insertar = false;
        if (!empty($arrayPizza)) {
            if (self::ExistePizzaDetalle($arrayPizza, $sabor, $tipo, $cantidad) != 1) {
                $insertar = true;
            } else {
                self::ActualizarPizza($arrayPizza, $sabor, $precio, $tipo, $cantidad, $path);
                return "Cantidad actualizada.";
            }
        } else {
            $insertar = true;
        }
        if ($insertar) {
           // var_dump($archivo);
            $Pizza = new Pizza($sabor, $precio, $tipo, $cantidad);
            $Nombre=$tipo."-".$sabor;
            Pizza::GuardarFotoPizza($archivo, $Nombre,$pathImagen);
            return  self::GuardarJson($arrayPizza, $path, $Pizza);
        }
    }
    
    
}
