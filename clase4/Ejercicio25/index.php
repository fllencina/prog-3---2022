<!-- Aplicación No 25 ( AltaProducto)
Archivo: altaProducto.php
método:POST
Recibe los datos del producto(código de barra (6 cifras ),nombre ,tipo, stock, precio )por POST
,
crea un ID autoincremental(emulado, puede ser un random de 1 a 10.000). crear un
objeto y utilizar sus métodos para poder verificar si es un producto existente, si ya existe
el producto se le suma el stock , de lo contrario se agrega al documento en un nuevo
renglón
Retorna un :
“Ingresado” si es un producto nuevo
“Actualizado” si ya existía y se actualiza el stock.
“no se pudo hacer“si no se pudo hacer
Hacer los métodos necesarios en la clase
Lencina Fernanda -->

<?php



require_once "manejoDeArchivos.php";
require_once "Producto.php";
$path="Productos.json";
$arrayJson=LeerJSON($path);

switch($_SERVER['REQUEST_METHOD'])
{
    case 'GET':
       
        echo Producto::MostrarLista($arrayJson);
    break;
    case 'POST':
       
       
    if (isset ($_POST["cod_barras"],$_POST["nombre"],$_POST["stock"] , $_POST["precio"],$_POST["tipo"]))
	{
        $nombre=$_POST["nombre"];
		$cod_barras=$_POST["cod_barras"];		
		$tipo=$_POST["tipo"];
        $stock=$_POST["stock"];
        $precio=$_POST["precio"];

        //var_dump($_FILES);
       
        $producto=new producto($cod_barras,$nombre,$tipo,$stock,$precio);
        echo Producto::ValidarProducto($arrayJson,$producto,$path,true);
       // GuardarJson($arrayJson, "Productos.Json", $producto);
        array_push($arrayJson,$producto);
    }
    else{
        echo "no recibe datos";
    }
    break;
    }





?>