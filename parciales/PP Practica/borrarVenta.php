


<?php
require_once "Venta.php";
$pathBackup="./ImagenesBackupVentas/";
$body = json_decode(file_get_contents("php://input"), true);
if(isset($body['numeroPedido']))
{
   echo Venta::EliminarVenta($body['numeroPedido'],$pathBackup);
}else{
//echo "Faltan datos";
}

?>