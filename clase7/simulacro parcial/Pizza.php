<?php

class Pizza
{
    public $id;
    public $sabor;
    public $precio;
    public $tipo;
    public $cantidad;
    public $imagen;


    function __construct($sabor, $precio, $tipo, $cantidad, $imagen=null)
    {
        $this->sabor = $sabor;
        $this->tipo = $tipo;
        $this->precio = $precio;
        $this->cantidad = $cantidad;
        if($imagen!=null)
        {

        }
        $this->id = self::ObtieneIDPizza();
    }


    static function  ObtieneIDPizza()
    {
        if (!file_exists("PizzaID.txt")) {
            $file = fopen("PizzaID.txt", "w+");
            fwrite($file, 0);
            fclose($file);
        }

        $file = fopen("PizzaID.txt", "r");
        $idPizza = fgets($file);
        fclose($file);
        $file = fopen("PizzaID.txt", "w");
        fwrite($file, $idPizza + 1);
        fclose($file);
        return $idPizza + 1;
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

    static function ExistePizza($arrayPizza, $sabor, $tipo,$cantidad)
    {
        foreach ($arrayPizza as $x => $val) {
            if ($val->tipo ==  $tipo && $val->sabor == $sabor  && $val->cantidad > $cantidad) {
                return true;
            }        
        }
        return false;
    }
    static function InsertarPizza($arrayPizza, $sabor, $tipo, $cantidad, $precio, $path)
    {
        if (!self::ExistePizza($arrayPizza, $sabor, $tipo, $cantidad)) {
            $Pizza = new Pizza($sabor, $precio, $tipo, $cantidad);
            return  self::GuardarJson($arrayPizza, $path, $Pizza);
        } else {

             self::ActualizarPizza($arrayPizza, $sabor, $tipo, $cantidad, $precio,$path);
        }
    }
    static function ActualizarPizza($arrayPizza, $sabor, $tipo, $cantidad, $precio,$path)
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
    static function ExistePizzaDetalle($arrayPizza, $sabor, $tipo)
    {
        
        foreach ($arrayPizza as $x => $val) {
            if ($val->tipo ==  $tipo && $val->sabor == $sabor) {
                return "Si hay";
            }        
            else if($val->tipo ==  $tipo  && $val->sabor != $sabor)
            {
                return "No existe sabor";
            }
            else if($val->tipo !=  $tipo  && $val->sabor == $sabor)
            {
               return "No existe tipo";
            }
        }
       
       
    }

    function guardarFoto($file, $postNombre)
{
    //echo "guarda Foto";
    if (!is_dir('Fotos')) {
        mkdir('Fotos', 0777);
    }

    $dic = "./Fotos/";
    $nameImagen = $file["archivo"]["name"];

    $explode = explode(".", $nameImagen);
    $tamaño = count($explode);

    $dic .= $postNombre;
    $dic .= ".";
    $dic .= $explode[$tamaño - 1];



    $Retorno = false;
    if (!file_exists($dic)) {
        $Retorno = move_uploaded_file($_FILES["archivo"]["tmp_name"], $dic);
    } else {

        $Retorno = move_uploaded_file($_FILES["archivo"]["tmp_name"], $dic);
    }

    
    return $Retorno;
}
function base64_encode_image($path)
{
    $type = pathinfo($path, PATHINFO_EXTENSION);
    $data = file_get_contents($path);
    return  base64_encode($data);
}

function base64_decode_image($b64, $pathFoto)
{
    
    $bin = base64_decode($b64);
    
    $im = imageCreateFromString($bin);

    
    if (!$im) {
        die('Base64 value is not a valid image');
    }

    
    $img_file = $pathFoto . "filename.png";


    imagepng($im, $img_file, 0);
    return $img_file;
}

static function RestarStock($arrayPizza, $sabor,$tipo,$cantidad, $path)
{
    foreach ($arrayPizza as $x => $val) {
        if ($val->sabor ==  $sabor  && $val->tipo ==  $tipo) {
            $val->cantidad = $val->cantidad - $cantidad;

            break;
        }
    }
      self::GuardarJson($arrayPizza, $path, null);
}
}
