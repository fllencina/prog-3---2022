<?php
require_once "Helado.php";
$path="Helados.json";
$pathImagen="./ImagenesDeHelado/";

$array=Helado::LeerJSON($path);

if (isset($_GET["sabor"], $_GET["tipo"], $_GET["cantidad"], $_GET["precio"])) {
    $sabor = $_GET["sabor"];
    $tipo = $_GET["tipo"];
    $cantidad = $_GET["cantidad"];
    $precio = $_GET["precio"];
//var_dump($_GET);
    if ($tipo == "agua" || $tipo == "crema") {
       
      echo Helado::InsertarHelado($array,$sabor, $precio, $tipo, $cantidad,$path,null,null);
        
    }
    else{
        echo "Datos incorrectos";
    }
}
var_dump($_POST);
if (isset($_POST["sabor"], $_POST["tipo"], $_POST["cantidad"], $_POST["precio"],$_FILES["archivo"])) {
    $sabor = $_POST["sabor"];
    $tipo = $_POST["tipo"];
    $cantidad = $_POST["cantidad"];
    $precio = $_POST["precio"];
    $archivo = $_FILES;

    if ($tipo == "agua" || $tipo == "crema") {
        
      echo Helado::InsertarHelado($array,$sabor, $precio, $tipo, $cantidad,$path,$archivo,$pathImagen);
        
    }
    else{
        echo "Datos incorrectos";
    }
}

?>