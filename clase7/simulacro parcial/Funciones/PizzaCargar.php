<?php

require_once "Pizza.php";
$path="Pizzas.json";
$arrayPizza=Pizza::LeerJSON($path);
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
else  {
echo "no recibe datos";
}

?>