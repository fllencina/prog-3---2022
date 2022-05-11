<!-- 6- (2 pts.) ModificarVenta.php(por PUT), debe recibir el número de pedido, el email del usuario, el sabor,tipo y
cantidad, si existe se modifica , de lo contrario informar. -->

<?php

require_once "Venta.php";
$body = json_decode(file_get_contents("php://input"), true);

//var_dump($body);
    if(isset($body['sabor']) && isset($body['mail']) && isset($body['tipo']) && isset($body['cantidad']) && 
    isset($body['numeroPedido'])){
    
        $numeroPedido=$body['numeroPedido'];
        $sabor=$body['sabor'];
        $mail=$body['mail'];
        $tipo=$body['tipo'];
        $cantidad=$body['cantidad'];
            
      echo   Venta::ModificarVenta($numeroPedido ,$sabor,$mail, $tipo,$cantidad);
       
        
    }else{
        echo 'Faltan datos';
    }
?>