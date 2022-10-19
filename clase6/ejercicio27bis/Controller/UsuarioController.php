<?php
require_once "Usuario.php";

if(isset($_POST['nombre'],$_POST['apellido'],$_POST['clave'],$_POST['mail'],$_POST['localidad']))
        {
            $nombre = $_POST["nombre"];
            $mail = $_POST["mail"];
            $clave = $_POST["clave"];
            $apellido = $_POST["apellido"];
            $localidad = $_POST["localidad"]; 
            
            $usuario=new Usuario($nombre,$apellido,$clave,$localidad,$mail);

           echo "Se ha creado un nuevo usuario. UserID= " . $usuario->InsertarUsuario();
        }
        else{
            echo "Faltan datos para poder insertar usuario.";
        }
?>