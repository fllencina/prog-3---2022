<?php
//require_once "manejoDeArchivos.php";
require_once "ProductoController.php";

class Producto
{

    public $codBarras; //(6 sifras ) VALIDAR
    public $nombre;
    public $tipo;
    public $stock;
    public $precio;
    public $ID;
    public $fecha_creado;
    public $fecha_modificado;



    function __construct($cod_barras, $nombre, $tipo, $stock, $precio,$fecha_creado=null,$fecha_modificado=null)
    {
        $this->codBarras = $cod_barras;
        $this->nombre = $nombre;
        $this->tipo = $tipo;
        $this->stock = $stock;
        $this->precio = $precio;
        $this->fecha_creado = self::ObtenerFecha();
        $this->fecha_modificado = $fecha_modificado;

    }
    static function ObtenerFecha()
    {
        return date("Y-m-d");
    }

    function InsertarProductoSQL()
    {
        //echo "entra en insertar producto sql";
        $ProductoController = new ProductoController();

        $ProductoController->codBarras = $this->codBarras;
        $ProductoController->nombre = $this->nombre;
        $ProductoController->tipo = $this->tipo;
        $ProductoController->stock = $this->stock;
        $ProductoController->precio = $this->precio;
        $ProductoController->fecha_creado = $this->fecha_creado;
        try {
            $this->id = $ProductoController->InsertarProductoParametros();
            return "Insertado correctamente";
        } catch (PDOException $ex) {
            return "No pudo insertarse";
        }
    }
    // static function  ObtieneIDProducto()
    // {
    //     if (!file_exists("ProductoID.txt")) {
    //         $file = fopen("ProductoID.txt", "w+");
    //         fwrite($file, 0);
    //         fclose($file);
    //     }

    //     $file = fopen("ProductoID.txt", "r");
    //     $idProducto = fgets($file);
    //     fclose($file);
    //     $file = fopen("ProductoID.txt", "w");
    //     fwrite($file, $idProducto + 1);
    //     fclose($file);
    //     return $idProducto + 1;
    // }

    //         Retorna un :
    // “Ingresado” si es un producto nuevo
    // “Actualizado” si ya existía y se actualiza el stock.
    static function ValidarCodigoDeBarras($Dato)
    {
        //echo "entra a validar cod barras";
        $arrayCodBarras  = array_map('intval', str_split($Dato));
        if (is_numeric($Dato) && count($arrayCodBarras) == 8) {
            return true;
        }
        return false;
    }
    static function ValidarProducto($Array, $Producto, $path = null, $guardar = false)
    {
        //var_dump($Producto->cod_barras);
        $retorno = "no se pudo hacer";
        $arrayCodBarras  = array_map('intval', str_split($Producto->cod_barras));
        if (is_numeric($Producto->cod_barras) && count($arrayCodBarras) == 6) {
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

    public function ValidarProductoSQL()
    {
        //echo "entra en validar producto  sql de producto";
        if (self::ValidarCodigoDeBarras($this->codBarras)) {
            $Producto = self::ObtenerUnProducto($this->codBarras);
            if (isset($Producto) && $Producto) {
                //sumar stock y modificar
                if ($this->codBarras == $Producto->codBarras) {
                    $Producto->stock = $Producto->stock + $this->stock;
                    $ProductoController=new ProductoController();
                    $ProductoController->ID=$Producto->ID;
                    $ProductoController->codBarras=$Producto->codBarras;
                    $ProductoController->nombre=$Producto->nombre;
                    $ProductoController->tipo=$Producto->tipo;
                    $ProductoController->stock=$Producto->stock;
                    $ProductoController->precio=$this->precio;
                    
                    $ProductoController->fecha_modificado=self::ObtenerFecha();

                    $retorno=$ProductoController->ModificarProductoParametros();
                    if( $retorno==1)
                    {
                        return "Actualizado";
                    }
                }
            } else {
                //insertar
                return  self::InsertarProductoSQL();

              

            }
        }
        else{
            return "Datos incorrectos";
        }
    }

    static function ObtenerUnProducto($codBarras)
    {
       // echo "entra al obtener un producto de producto";
        return ProductoController::TraerUnProducto($codBarras);
    }
    

    static function MostrarLista($ProductosArray)
    {
        $strRet = "<ul>";

        for ($i = 0; $i < count($ProductosArray); $i++) {
            $strRet .= "<li>" . "Codigo de barras: " . $ProductosArray[$i]->codBarras . ", nombre: " . $ProductosArray[$i]->nombre . ", tipo: " . $ProductosArray[$i]->tipo . ", stock: " . $ProductosArray[$i]->stock . ", precio: " . $ProductosArray[$i]->precio . "" . "</li>";
        }
        $strRet .=  "</ul>";
        return $strRet;
    }

    static function ExisteProducto($arrayProductos, $codBarras, $cantidad)
    {
        foreach ($arrayProductos as $x => $val) {
            if ($val->cod_barras ==  $codBarras && $val->stock > $cantidad) {
                return true;
            }
        }
        return false;
    }
    static function RestarStock($arrayProductos, $codBarras, $cantidad, $path)
    {
        foreach ($arrayProductos as $x => $val) {
            if ($val->cod_barras ==  $codBarras && $val->stock > $cantidad) {
                $val->stock = $val->stock - $cantidad;

                break;
            }
        }
        return  GuardarJson($arrayProductos, $path, null);
    }
}
