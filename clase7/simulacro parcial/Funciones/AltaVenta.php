<?php

require_once "Venta.php";
require_once "pizza.php";

$path="Pizzas.json";
$arrayPizza=Pizza::LeerJSON($path);
// public $mail;
//     public $sabor;
//     public $tipo;
//     public $cantidad;
//     public $fechaPedido;
//     public $id;
//     public $imagen;
if (isset($_POST["sabor"], $_POST["tipo"], $_POST["cantidad"] , $_FILES["archivo"], $_POST["mail"])) {
    $sabor = $_POST["sabor"];
    $tipo = $_POST["tipo"];
    $cantidad = $_POST["cantidad"];
    $mail = $_POST["mail"];

    $archivo = $_FILES["archivo"];

    if ($tipo == "molde" || $tipo == "piedra") {
       
    echo Venta::ValidarVenta($arrayPizza,$mail,$sabor,$tipo,$cantidad,$path);
        
    }
    else{
        echo "Datos incorrectos";
    }
}
else  {
echo "no recibe datos";
}


?>

