<!-- Aplicación No 31 (RealizarVenta BD )
Archivo: RealizarVenta.php
método:POST
Recibe los datos del producto(código de barra), del usuario (el id )y la cantidad de ítems ,por
POST .
Verificar que el usuario y el producto exista y tenga stock.
Retorna un :
“venta realizada”Se hizo una venta
“no se pudo hacer“si no se pudo hacer
Hacer los métodos necesarios en las clases 
Lencina Fernanda
-->


<?php
 require_once "Producto.php";
 require_once "Usuario.php";
 require_once "RealizarVenta.php";


switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
  
        break;
    case 'POST':
        
        if(isset($_POST["UsuarioID"],$_POST["codBarras"],$_POST["cantidadItems"]))
        {
            $codBarras=$_POST["codBarras"];
            $cantidadItems=$_POST["cantidadItems"];
            $UsuarioID=$_POST["UsuarioID"];

            $Venta= new RealizarVenta($UsuarioID ,$codBarras, $cantidadItems);
            //var_dump($Venta);
           echo $Venta->ValidarVentaSQL();
            
           //echo $producto->ValidarProductoSQL();
           
        }

        else {
            echo "no recibe datos";
        }
        break;
}


?>
