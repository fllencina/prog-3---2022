<?php


class Helado{
public $sabor;
public $precio;
public $tipo;
public $stock;
public $id;
function __contruct()
{

}

function NuevoHelado($sabor,$precio,$tipo,$stock){
    $elemento= new Helado();

    $elemento->sabor=$sabor;
    $elemento->precio=$precio;
    $elemento->tipo=$tipo;
    $elemento->stock=$stock;
    $elemento->id=self::GeneradorID();
    return $elemento;
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
    static function InsertarHelado($array, $sabor, $precio, $tipo, $stock, $path,$archivo=null,$pathImagen=null)
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
            $Nombre=$tipo."-".$sabor;
           Helado::GuardarFoto($archivo, $Nombre,$pathImagen);
            return  self::GuardarJson($array, $path, $elemento);
        }
    }
    static function ExisteHeladoDetalle($array, $sabor, $tipo )
    {  
        $existeSabor = false;
        $existeTipo = false;
        
        foreach ($array as $x => $val) {

            if ($val->tipo ==  $tipo && $val->sabor == $sabor  ) {
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

                $val->cantidad = $val->stock + $stock;
                $val->precio = $precio;
            }
        }
        
        return  self::GuardarJson($array, $path, null);
    }
    static function GuardarFoto($file, $Nombre,$pathImagen)
    {
        //echo $pathImagen;
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
    static function ExisteHeladoStock($array, $sabor, $tipo,$stock)
    {
        foreach ($array as $x => $val) {

            if ($val->tipo ==  $tipo && $val->sabor == $sabor && $val->stock >= $stock  ) {
                return 1;
            } 
        }
        return 0;
    }
    static function RestarStock($array, $sabor, $tipo, $stock, $path)
    {
        foreach ($array as $x => $val) {
            if ($val->sabor ==  $sabor  && $val->tipo ==  $tipo) {
                $val->cantidad = $val->stock - $stock;

                break;
            }
        }
        self::GuardarJson($array, $path, null);
    }


}

?>