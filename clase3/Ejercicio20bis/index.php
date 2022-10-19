<?php

// Aplicación No 20 (Registro CSV)
// Archivo: registro.php
// método:POST
// Recibe los datos del usuario(nombre, clave,mail )por POST ,
// crear un objeto y utilizar sus métodos para poder hacer el alta,
// guardando los datos en usuarios.csv.
// retorna si se pudo agregar o no.
// Cada usuario se agrega en un renglón diferente al anterior.
// Hacer los métodos necesarios en la clase usuario

// Lencina Fernanda

require_once "Usuario.php";
require_once "ManejadorArchivos.php";

$path="./Usuarios.csv";
$arrayUsuarios=[];
switch($_SERVER['REQUEST_METHOD'])
{
    case 'GET':
    //echo "<br>peticion por get";
    break;
    case 'POST':
    echo "<br>peticion por post";
        if (isset($_POST["mail"], $_POST["nombre"], $_POST["clave"])) {
            $mail = $_POST["mail"];
            $Nombre = $_POST["nombre"];
            $Clave = $_POST["clave"];

            $usuario = new Usuario($Nombre, $Clave, $mail);

            array_push($arrayUsuarios, $usuario);
            Guardarcsv($path, $arrayUsuarios);
            $UsuariosLeidos = Leercsv($path);
            echo Usuario::MostrarLista($UsuariosLeidos);
        }
    
    break;
}


?>