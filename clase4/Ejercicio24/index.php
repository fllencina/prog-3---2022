<!-- Aplicación No 24 ( Listado JSON y array de usuarios)
Archivo: listado.php
método:GET
Recibe qué listado va a retornar(ej:usuarios,productos,vehículos,...etc),por ahora solo tenemos
usuarios).
En el caso de usuarios carga los datos del archivo usuarios.json.
se deben cargar los datos en un array de usuarios.
Retorna los datos que contiene ese array en una lista
<ul>
<li>apellido, nombre,foto</li>
<li>apellido, nombre,foto</li>
</ul>
Hacer los métodos necesarios en la clase usuario

Lencina Fernanda 
 -->
<?php



require_once "manejoDeArchivos.php";
require_once "Usuario.php";
$arrayJson=LeerJSON("Usuarios.Json");
$pathFoto="Fotos";

switch($_SERVER['REQUEST_METHOD'])
{
    case 'GET':
       
        echo Usuario::MostrarLista($arrayJson,$pathFoto);
    break;
    case 'POST':
       
       
    if (isset ($_POST["nombre"],$_POST["mail"],$_POST["clave"] , $_FILES))
	{
        $nombre=$_POST["nombre"];
		$mail=$_POST["mail"];		
		$clave=$_POST["clave"];

        $foto=$_FILES;
        //var_dump($_FILES);

        $login=new Usuario($nombre,$clave,$mail,$foto,$pathFoto);
        
        GuardarJson($arrayJson, "Usuarios.Json", $login);
        array_push($arrayJson,$login);
    }
    else{
        echo "no recibe datos";
    }
    break;
    }





?>