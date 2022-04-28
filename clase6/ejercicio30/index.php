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
require_once "Usuario.php";

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
     //echo  Usuario:: MostrarUsuariosSql();
        break;
    case 'POST':
        
        if (isset($_POST["nombre"], $_POST["apellido"], $_POST["mail"],$_POST["clave"], $_POST["localidad"],  $_FILES)) {
            $nombre = $_POST["nombre"];
            $mail = $_POST["mail"];
            $clave = $_POST["clave"];
            $apellido = $_POST["apellido"];
            $localidad = $_POST["localidad"];         
            $foto = $_FILES;
            $usuario = new Usuario($nombre,$apellido, $clave, $mail, $foto ,$localidad);         
           echo $usuario->InsertarUsuarioSQL();          
        }
        else if(isset($_POST["mail"],$_POST["clave"]))
        {
            $mail = $_POST["mail"];
           
            $clave = $_POST["clave"];
          

            $usuario = new Usuario(null,null, $clave, $mail);
           echo $usuario->ValidarUsuarioSQL();
        }

        else {
            echo "no recibe datos";
        }
        break;
}

?>
