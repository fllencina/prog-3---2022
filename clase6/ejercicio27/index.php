<!-- Aplicación No 27 (Registro BD)
Archivo: registro.php
método:POST
Recibe los datos del usuario( nombre,apellido, clave,mail,localidad )por POST ,
crear un objeto con la fecha de registro y utilizar sus métodos para poder hacer el alta,
guardando los datos la base de datos
retorna si se pudo agregar o no.
Lencina Fernanda 
-->
<?php
require_once "manejoDeArchivos.php";
require_once "Usuario.php";

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
    // echo  Usuario:: MostrarUsuariosSql();
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

        else {
            echo "no recibe datos";
        }
        break;
}

?>
