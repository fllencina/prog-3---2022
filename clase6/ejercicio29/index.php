<!-- Aplicación No 29( Login con bd)
Archivo: Login.php
método:POST
Recibe los datos del usuario(clave,mail )por POST ,
crear un objeto y utilizar sus métodos para poder verificar si es un usuario registrado en la
base de datos,
Retorna un :
“Verificado” si el usuario existe y coincide la clave también.
“Error en los datos” si esta mal la clave.
“Usuario no registrado si no coincide el mail“
Hacer los métodos necesarios en la clase usuario.
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
