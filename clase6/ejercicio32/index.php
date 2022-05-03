<!-- Aplicación No 32(Modificacion BD)
Archivo: ModificacionUsuario.php
método:POST
Recibe los datos del usuario(nombre, clavenueva, clavevieja,mail )por POST ,
crear un objeto y utilizar sus métodos para poder hacer la modificación,
guardando los datos la base de datos
retorna si se pudo agregar o no.
Solo pueden cambiar la clave

Lencina Fernanda -->

<?php

require_once "Usuario.php";

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
  
        break;
    case 'POST':
        
        if(isset($_POST["nombre"],$_POST["clavenueva"],$_POST["clavevieja"],$_POST["mail"]))
        {
            $nombre=$_POST["nombre"];
            $clavenueva=$_POST["clavenueva"];
            $clavevieja=$_POST["clavevieja"];
            $mail=$_POST["mail"];


            $Usuario= new Usuario(null,null,$clavevieja, $mail);
           
            echo $Usuario->ModificarUsuarioSQL($clavenueva);
           
        }

        else {
            echo "no recibe datos";
        }
        break;
}

?>
