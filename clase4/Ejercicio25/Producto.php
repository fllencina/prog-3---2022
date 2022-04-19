<?php
require_once "manejoDeArchivos.php";
class Producto
{

    public $cod_barras; //(6 sifras ) VALIDAR
    public $nombre;
    public $tipo;
    public $stock;
    public $precio;
    public $ID;

    function __construct($cod_barras, $nombre, $tipo, $stock, $precio)
    {
        $this->cod_barras = $cod_barras;
        $this->nombre = $nombre;
        $this->tipo = $tipo;
        $this->stock = $stock;
        $this->precio = $precio;
        
    }


    static function  ObtieneIDProducto()
    {
        if (!file_exists("ProductoID.txt")) {
            $file = fopen("ProductoID.txt", "w+");
            fwrite($file, 0);
            fclose($file);
        }

        $file = fopen("ProductoID.txt", "r");
        $idProducto = fgets($file);
        fclose($file);
        $file = fopen("ProductoID.txt", "w");
        fwrite($file, $idProducto + 1);
        fclose($file);
        return $idProducto + 1;
    }

    //         Retorna un :
    // “Ingresado” si es un producto nuevo
    // “Actualizado” si ya existía y se actualiza el stock.
    static function ValidarProducto($Array, $Producto, $path = null, $guardar = false)
    {
        //var_dump($Producto->cod_barras);
        $retorno = "no se pudo hacer";
        $arrayCodBarras  = array_map('intval', str_split($Producto->cod_barras));
        if (is_numeric($Producto->cod_barras) && count($arrayCodBarras)== 6) {
            $ProdExiste = false;
            foreach ($Array as $x => $val) {
                if ($val->cod_barras ==  $Producto->cod_barras) {
                    $val->stock = $val->stock + $Producto->stock;
                    $ProdExiste = true;
                    $retorno = "Actualizado";
                }
            }
            if (!$ProdExiste) {
                
                $Producto->ID = self::ObtieneIDProducto();
                array_push($Array, $Producto);
                $retorno = "Ingresado";
            }
            if ($guardar) {
               // var_dump($Array);
                GuardarJson($Array, $path, null);
            }
        } 
        return $retorno;
    }

    static function MostrarLista($ProductosArray)
    {
        $strRet = "<ul>";

        for ($i = 0; $i < count($ProductosArray); $i++) {


            $strRet .= "<li>" . "Codigo de barras: " . $ProductosArray[$i]->cod_barras . ", nombre: " . $ProductosArray[$i]->nombre . ", tipo: " . $ProductosArray[$i]->tipo . ", stock: " . $ProductosArray[$i]->stock . ", precio: " . $ProductosArray[$i]->precio . "" . "</li>";
        }
        $strRet .=  "</ul>";
        return $strRet;
    }
}
