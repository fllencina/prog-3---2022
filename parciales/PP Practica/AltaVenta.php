<?php


require_once "Venta.php";
require_once "Helado.php";

$path="heladeria.json";
$pathImagen="./ImagenesDeLaVenta/";
$array=LeerJSON($path);

if (isset($_POST["sabor"], $_POST["tipo"], $_POST["cantidad"] , $_FILES["archivo"], $_POST["mail"],$_POST["numeroPedido"])) {
    $sabor = $_POST["sabor"];
    $tipo = $_POST["tipo"];
    $cantidad = $_POST["cantidad"];
    $mail = $_POST["mail"];
    $numeroPedido = $_POST["numeroPedido"];
    $cuponID=$_POST["cuponID"];
    if ($tipo == "agua" || $tipo == "crema") {
       
    echo Venta::ValidarVenta($array,$mail,$sabor,$tipo,$cantidad,$numeroPedido,$path,$_FILES,$pathImagen,$cuponID);
        
    }
    else{
        echo "Datos incorrectos";
    }
}
else  {
echo "no recibe datos";
}
?>