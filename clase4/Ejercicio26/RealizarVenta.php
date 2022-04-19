<?php
require_once "Producto.php";
require_once "Usuario.php";

class RealizarVenta {
    public $usuarioID;
    public $producto_cod_barras;
    public $cantidadItems;
    public $ID;

    function __construct($usuarioID,$producto_cod_barras,$cantidadItems){
        $this->usuarioID=$usuarioID;
        $this->producto_cod_barras=$producto_cod_barras;
        $this->cantidadItems=$cantidadItems;
        
    }

    static function  ObtieneIDVenta()
    {
        if (!file_exists("VentaID.txt")) {
            $file = fopen("VentaID.txt", "w+");
            fwrite($file, 0);
            fclose($file);
        }

        $file = fopen("VentaID.txt", "r");
        $idVenta = fgets($file);
        fclose($file);
        $file = fopen("VentaID.txt", "w");
        fwrite($file, $idVenta + 1);
        fclose($file);
        return $idVenta + 1;
    }

   
  static function ValidarVenta($arrayProducto,$ArrayUsuarios,$RealizarVenta,$pathVentas)
  {
    $retorno='';
    $arrayVentas=LeerJSON($pathVentas);
    $existeProducto=Producto::ExisteProducto($arrayProducto,$RealizarVenta->producto_cod_barras,$RealizarVenta->cantidadItems);
    $existeUsuario=Usuario::ExisteUsuario($ArrayUsuarios,$RealizarVenta->usuarioID);
    if($existeProducto && $existeUsuario)
    {
        $RealizarVenta->ID=self::ObtieneIDVenta();
        GuardarJson($arrayVentas,$pathVentas,$RealizarVenta);
      
        $retorno= "Venta Realizada";
    }
    else{
        $retorno= "No se pudo hacer";
    }
    return $retorno;
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





?>