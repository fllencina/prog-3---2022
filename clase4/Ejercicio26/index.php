<!-- Aplicación No 26 (RealizarVenta)
Archivo: RealizarVenta.php
método:POST
Recibe los datos del producto(código de barra), del usuario (el id )y la cantidad de ítems
,por POST .
Verificar que el usuario y el producto exista y tenga stock.
crea un ID autoincremental(emulado, puede ser un random de 1 a 10.000).
carga los datos necesarios para guardar la venta en un nuevo renglón.
Retorna un :
“venta realizada”Se hizo una venta
“no se pudo hacer“si no se pudo hacer
Hacer los métodos necesaris en las clases
Lencina Fernanda -->

<?php



require_once "manejoDeArchivos.php";
require_once "Usuario.php";
require_once "Producto.php";
require_once "RealizarVenta.php";
$pathProductos = "Productos.json";
$pathUsuarios = "Usuarios.Json";
$pathVentas = "Ventas.Json";
$arrayJsonProducto = LeerJSON($pathProductos);
$arrayJsonUsuarios = LeerJSON($pathUsuarios);
$arrayJsonVentas = LeerJSON($pathVentas);

$pathFoto = "Fotos";

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':

        echo Usuario::MostrarLista($arrayJsonUsuarios, $pathFoto);
        echo Producto::MostrarLista($arrayJsonProducto);
        echo RealizarVenta::MostrarLista($arrayJsonVentas);

        break;
    case 'POST':


        if (isset($_POST["nombre"], $_POST["mail"], $_POST["clave"], $_FILES)) {
            $nombre = $_POST["nombre"];
            $mail = $_POST["mail"];
            $clave = $_POST["clave"];

            $foto = $_FILES;
            //var_dump($_FILES);

            $login = new Usuario($nombre, $clave, $mail, $foto, $pathFoto);

            GuardarJson($arrayJsonUsuarios, $pathUsuarios, $login);
            array_push($arrayJsonUsuarios, $login);
        }

        else if (isset($_POST["cod_barras"], $_POST["nombre"], $_POST["stock"], $_POST["precio"], $_POST["tipo"])) {
            $nombre = $_POST["nombre"];
            $cod_barras = $_POST["cod_barras"];
            $tipo = $_POST["tipo"];
            $stock = $_POST["stock"];
            $precio = $_POST["precio"];

            //var_dump($_FILES);

            $producto = new producto($cod_barras, $nombre, $tipo, $stock, $precio);
            echo Producto::ValidarProducto($arrayJsonProducto, $producto, $pathProductos, true);
            array_push($arrayJsonProducto, $producto);
        } 
        else if(isset($_POST["cod_barras"],$_POST["cantidadItems"],$_POST["UsuarioID"]))
        {
            $producto_cod_barras=$_POST["cod_barras"];
            $cantidadItems=$_POST["cantidadItems"];
            $UsuarioID=$_POST["UsuarioID"];

           $Venta= new RealizarVenta($UsuarioID,$producto_cod_barras,$cantidadItems);
           echo RealizarVenta::ValidarVenta($arrayJsonProducto,$arrayJsonUsuarios,$Venta,$pathVentas);
        }
        else {
            echo "no recibe datos";
        }
        break;
}






?>