<!-- Aplicación No 23 (Registro JSON)
Archivo: registro.php
método:POST
Recibe los datos del usuario(nombre, clave,mail )por POST ,
crea un ID autoincremental(emulado, puede ser un random de 1 a 10.000). crear un dato
con la fecha de registro , toma todos los datos y utilizar sus métodos para poder hacer
el alta,
guardando los datos en usuarios.json y subir la imagen al servidor en la carpeta
Usuario/Fotos/.
retorna si se pudo agregar o no.
Cada usuario se agrega en un renglón diferente al anterior.
Hacer los métodos necesarios en la clase usuario.
Lencina Fernanda -->

<?php

require_once "manejoDeArchivos.php";
require_once "Usuario.php";
$arrayJson=[];
$arrayJson=LeerJSON("Usuarios.Json");
switch($_SERVER['REQUEST_METHOD'])
{
    case 'GET':
        echo "<br>peticion por get";
    break;
    case 'POST':
       
       
    if (isset ($_POST["nombre"],$_POST["mail"],$_POST["clave"] , $_FILES))
	{
        $nombre=$_POST["nombre"];
		$mail=$_POST["mail"];		
		$clave=$_POST["clave"];

        $foto=$_FILES;

        $login=new Usuario($nombre,$clave,$mail,$foto);
  
        GuardarJson($arrayJson, "Usuarios.Json", $login);
        array_push($arrayJson,$login);
    }
    else{
        echo "no recibe datos";
    }
    break;
    }



?>