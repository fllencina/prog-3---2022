<?php
require_once "Producto.php";
require_once "Usuario.php";
require_once "RealizarVentaController.php";
require_once "AccesoDatos.php";



class RealizarVenta
{

    public $usuarioID;
    public $codBarras;
    public $cantidadItems;
    public $fecha_de_venta;
    public $ID;

    function __construct($usuarioID, $codBarras, $cantidadItems)
    {
        $this->usuarioID = $usuarioID;
        $this->codBarras = $codBarras;
        $this->cantidadItems = $cantidadItems;
        $this->fecha_de_venta = self::ObtenerFecha();
    }
    static function ObtenerFecha()
    {
        return date("Y-m-d");
    }
    // static function  ObtieneIDVenta()
    // {
    //     if (!file_exists("VentaID.txt")) {
    //         $file = fopen("VentaID.txt", "w+");
    //         fwrite($file, 0);
    //         fclose($file);
    //     }

    //     $file = fopen("VentaID.txt", "r");
    //     $idVenta = fgets($file);
    //     fclose($file);
    //     $file = fopen("VentaID.txt", "w");
    //     fwrite($file, $idVenta + 1);
    //     fclose($file);
    //     return $idVenta + 1;
    // }


    static function ValidarVenta($arrayProducto, $ArrayUsuarios, $RealizarVenta, $pathVentas)
    {
        $retorno = '';
        $arrayVentas = LeerJSON($pathVentas);
        $existeProducto = Producto::ExisteProducto($arrayProducto, $RealizarVenta->producto_cod_barras, $RealizarVenta->cantidadItems);
        $existeUsuario = Usuario::ExisteUsuario($ArrayUsuarios, $RealizarVenta->usuarioID);
        if ($existeProducto && $existeUsuario) {
            $RealizarVenta->ID = self::ObtieneIDVenta();
            GuardarJson($arrayVentas, $pathVentas, $RealizarVenta);

            $retorno = "Venta Realizada";
        } else {
            $retorno = "No se pudo hacer";
        }
        return $retorno;
    }
    function ValidarVentaSQL()
    {
        //echo "llega a validarVentaSQL";
        $Producto = Producto::ObtenerUnProducto($this->codBarras);
        $existeUsuario = Usuario::ExisteUsuarioSQL($this->usuarioID);
        if (!isset($Producto) || !$Producto) {
            return "No existe producto";
        }
        if (!$existeUsuario) {
            return "No existe usuario";
        }
        if (isset($Producto) && $Producto  && $Producto->stock > $this->cantidadItems && $existeUsuario) {

            $ProductoController = new ProductoController();
            $ProductoController->ID = $Producto->ID;
            $ProductoController->codBarras = $Producto->codBarras;
            $ProductoController->nombre = $Producto->nombre;
            $ProductoController->tipo = $Producto->tipo;
            $ProductoController->stock = ($Producto->stock - $this->cantidadItems);
            $ProductoController->precio = $Producto->precio;
            $ProductoController->fecha_modificado = self::ObtenerFecha();
            $retorno = $ProductoController->ModificarProductoParametros();
            if ($retorno == 1) {
                $RealizarVentaController = new RealizarVentaController();
                $RealizarVentaController->id_usuario = $this->usuarioID;
                $RealizarVentaController->id_producto = $Producto->ID;
                $RealizarVentaController->cantidad = $this->cantidadItems;
                $RealizarVentaController->fecha_de_venta = self::ObtenerFecha();
                $RealizarVentaController->InsertarVentaParametros();
                return "Venta Realizada";
            } else {
                return "no se pudo actualizar stock producto";
            }
        } else {
            return "No se pudo realizar";
        }
    }

    static function MostrarLista($VentasArray)
    {
        $strRet = "<ul>";

        for ($i = 0; $i < count($VentasArray); $i++) {
            $strRet .= "<li>" . "Codigo de barras: " . $VentasArray[$i]->cod_barras . ", usuarioID: " . $VentasArray[$i]->usuarioID . ", cantidad: " . $VentasArray[$i]->cantidadItems . "</li>";
        }
        $strRet .=  "</ul>";
        return $strRet;
    }
}
