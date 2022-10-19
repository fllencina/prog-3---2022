<?php

require_once "./parte2/Venta.php";
require_once "./parte2/pizza.php";
require_once "ManejadorArchivos.php";
$path="./parte2/Pizzas.json";
$pathImagen="./ImagenesDeLaVenta/";
$arrayPizza=LeerJSON($path);

if (isset($_POST["sabor"], $_POST["tipo"], $_POST["cantidad"] , $_FILES["archivo"], $_POST["mail"],$_POST["numeroPedido"])) {
    $sabor = $_POST["sabor"];
    $tipo = $_POST["tipo"];
    $cantidad = $_POST["cantidad"];
    $mail = $_POST["mail"];
    $numeroPedido = $_POST["numeroPedido"];
    $archivo = $_FILES["archivo"];

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

