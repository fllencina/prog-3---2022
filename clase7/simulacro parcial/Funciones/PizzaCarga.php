<?php

require_once "./Parte4/Pizza.php";
require_once "ManejadorArchivos.php";
$path="./Parte4/Pizzas.json";
$arrayPizza=LeerJSON($path);
$pathImagen="./ImagenesDePizzas/";
if (isset($_GET["sabor"], $_GET["tipo"], $_GET["cantidad"], $_GET["precio"])) {
    $sabor = $_GET["sabor"];
    $tipo = $_GET["tipo"];
    $cantidad = $_GET["cantidad"];
    $precio = $_GET["precio"];

    if ($tipo == "molde" || $tipo == "piedra") {
       
      echo Pizza::InsertarPizza($arrayPizza,$sabor,$tipo,$cantidad,$precio,$path);
        
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