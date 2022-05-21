<?php


require_once "Venta.php";
require_once "pizza.php";

$path="Pizzas.json";
$pathImagen="./ImagenesDeLaVenta/";
$arrayPizza=Pizza::LeerJSON($path);
// public $mail;
//     public $sabor;
//     public $tipo;
//     public $cantidad;
//     public $fechaPedido;
//     public $id;
//     public $imagen;
if (isset($_POST["sabor"], $_POST["tipo"], $_POST["cantidad"] , $_FILES["archivo"], $_POST["mail"],$_POST["numeroPedido"])) {
    $sabor = $_POST["sabor"];
    $tipo = $_POST["tipo"];
    $cantidad = $_POST["cantidad"];
    $mail = $_POST["mail"];
    $numeroPedido = $_POST["numeroPedido"];

    if ($tipo == "molde" || $tipo == "piedra") {
       
    echo Venta::ValidarVenta($arrayPizza,$mail,$sabor,$tipo,$cantidad,$numeroPedido,$path,$_FILES,$pathImagen);
        
    }
    else{
        echo "Datos incorrectos";
    }
}
else  {
echo "no recibe datos";
}
?>