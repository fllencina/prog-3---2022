<!-- Aplicación No 30 ( AltaProducto BD)
Archivo: altaProducto.php
método:POST
Recibe los datos del producto(código de barra (6 sifras ),nombre ,tipo, stock, precio )por POST
, carga la fecha de creación y crear un objeto ,se debe utilizar sus métodos para poder
verificar si es un producto existente,
si ya existe el producto se le suma el stock , de lo contrario se agrega .
Retorna un :
“Ingresado” si es un producto nuevo
“Actualizado” si ya existía y se actualiza el stock.
“no se pudo hacer“si no se pudo hacer
Hacer los métodos necesarios en la clase
Lencina Fernanda 
-->
<?php
require_once "manejoDeArchivos.php";
require_once "Producto.php";

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
  
        break;
    case 'POST':
        
       if(isset($_POST["codBarras"],$_POST["nombre"],$_POST["tipo"],$_POST["stock"],$_POST["precio"]))
        {
            $codBarras = $_POST["codBarras"];
            $nombre = $_POST["nombre"];
            $tipo = $_POST["tipo"];
            $stock = $_POST["stock"];
            $precio = $_POST["precio"];
            
            
            $producto = new Producto($codBarras ,$nombre, $tipo, $stock,$precio);
            
            
           echo $producto->ValidarProductoSQL();
           
        }

        else {
            echo "no recibe datos";
        }
        break;
}

?>
