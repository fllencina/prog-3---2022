<?php

require_once "Pizza.php";
$path="Pizzas.json";
$pathImagen="./ImagenesDePizzas/";

$arrayPizza=Pizza::LeerJSON($path);
if (isset($_GET["sabor"], $_GET["tipo"], $_GET["cantidad"], $_GET["precio"])) {
    $sabor = $_GET["sabor"];
    $tipo = $_GET["tipo"];
    $cantidad = $_GET["cantidad"];
    $precio = $_GET["precio"];
//var_dump($_GET);
    if ($tipo == "molde" || $tipo == "piedra") {
       
      echo Pizza::InsertarPizza($arrayPizza,$sabor, $precio, $tipo, $cantidad,$path);
        
    }
    else{
        echo "Datos incorrectos";
    }
}
else if(isset($_POST["sabor"], $_POST["tipo"], $_POST["cantidad"], $_POST["precio"], $_FILES["archivo"])) {
    $sabor = $_POST["sabor"];
    $tipo = $_POST["tipo"];
    $cantidad = $_POST["cantidad"];
    $precio = $_POST["precio"];
    $archivo = $_FILES;

//var_dump($_POST);
    if ($tipo == "molde" || $tipo == "piedra") {
       
      echo Pizza::InsertarPizza($arrayPizza,$sabor, $precio, $tipo, $cantidad,$path,$archivo,$pathImagen);
        
    }
    else{
        echo "Datos incorrectos";
    }
}
else  {
echo "no recibe datos";
}

?>