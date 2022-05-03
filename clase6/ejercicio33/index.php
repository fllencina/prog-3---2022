<!-- Aplicación No 33 ( ModificacionProducto BD)
Archivo: modificacionproducto.php
método:POST
Recibe los datos del producto(código de barra (6 sifras ),nombre ,tipo, stock, precio )por POST
,
crear un objeto y utilizar sus métodos para poder verificar si es un producto existente,
si ya existe el producto el stock se sobrescribe y se cambian todos los datos excepto:
el código de barras .
Retorna un :
“Actualizado” si ya existía y se actualiza
“no se pudo hacer“si no se pudo hacer
Hacer los métodos necesarios en la clase

Lencina Fernanda -->

<?php
require_once "Producto.php";

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
  
        break;
    case 'POST':
        var_dump($_POST);
       if(isset($_POST["codBarras"],$_POST["nombre"],$_POST["tipo"],$_POST["stock"],$_POST["precio"]))
        {
            $codBarras = $_POST["codBarras"];
            $nombre = $_POST["nombre"];
            $tipo = $_POST["tipo"];
            $stock = $_POST["stock"];
            $precio = $_POST["precio"];
            
            
            $producto = new Producto($codBarras ,$nombre, $tipo, $stock,$precio);
            
           echo $producto->ModificarProductoSQL();
          
           
        }

        else {
            echo "no recibe datos";
        }
        break;
}


?>