<?php
require_once "Helado.php";
$path="heladeria.json";
$pathImagen="./ImagenesDeHelados/";

$array=Helado::LeerJSON($path);

if (isset($_POST["sabor"], $_POST["tipo"], $_POST["stock"], $_POST["precio"],$_FILES["archivo"])) {
    $sabor = $_POST["sabor"];
    $tipo = $_POST["tipo"];
    $stock = $_POST["stock"];
    $precio = $_POST["precio"];
    $archivo = $_FILES;

    if ($tipo == "agua" || $tipo == "crema") {
        
      echo Helado::InsertarHelado($array,$sabor, $precio, $tipo, $stock,$path,$archivo,$pathImagen);
        
    }
    else{
        echo "Datos incorrectos";
    }
}

?>