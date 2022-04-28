<!-- Aplicación No 28 ( Listado BD)
Archivo: listado.php
método:GET
Recibe qué listado va a retornar(ej:usuarios,productos,ventas)
cada objeto o clase tendrán los métodos para responder a la petición
devolviendo un listado <ul> o tabla de html <table>
Lencina Fernanda 
-->
<?php
require_once "manejoDeArchivos.php";
require_once "Usuario.php";

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
     echo  Usuario:: MostrarUsuariosSql();
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
