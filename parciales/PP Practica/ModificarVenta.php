
<?php

require_once "Venta.php";
require_once "Helado.php";
$path="heladeria.json";

$array=LeerJSON($path);
$body = json_decode(file_get_contents("php://input"), true);

//var_dump($body);
    if(isset($body['sabor'],$body['mail'],$body['tipo'],$body['cantidad'],$body['numeroPedido'])){
    
        $numeroPedido=$body['numeroPedido'];
        $sabor=$body['sabor'];
        $mail=$body['mail'];
        $tipo=$body['tipo'];
        $cantidad=$body['cantidad'];
            
      echo   Venta::ModificarVenta($numeroPedido ,$sabor,$mail, $tipo,$cantidad,$array,$path);
       
        
    }else{
       // echo 'Faltan datos';
    }
?>