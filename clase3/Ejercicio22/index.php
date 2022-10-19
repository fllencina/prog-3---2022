<!-- Aplicación No 22 ( Login)
Archivo: Login.php
método:POST
Recibe los datos del usuario(clave,mail )por POST ,
crear un objeto y utilizar sus métodos para poder verificar si es un usuario registrado,
Retorna un :
“Verificado” si el usuario existe y coincide la clave también.
“Error en los datos” si esta mal la clave.
“Usuario no registrado si no coincide el mail“
Hacer los métodos necesarios en la clase usuario

Lencina Fernanda -->

<?php
require_once "Usuario.php";

//require_once "insertUsuarios.php";
require_once "ManejadorArchivos.php";

$path=".\Usuarios.csv";


//InsertarUsuario($path);

switch($_SERVER['REQUEST_METHOD'])
{
    case 'GET':
        echo "<br>peticion por get";
    break;
    case 'POST':
    //echo "<br>peticion por post";
    $arrayUsuarios= Leercsv($path);
    echo Usuario::MostrarLista($arrayUsuarios);
    
    if (isset ($_POST["mail"],$_POST["clave"]))
	{
		$mail=$_POST["mail"];		
		$clave=$_POST["clave"];

        $login=new Usuario(null,$clave,$mail);
        echo Usuario::ValidarUsuario($arrayUsuarios,$login);
    }
    else{
        echo "no recibe datos";
    }
    break;
    }


?>