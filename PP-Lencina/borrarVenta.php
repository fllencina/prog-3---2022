
<!-- (2 pts.) borrarVenta.php(por DELETE), debe recibir un número de pedido,se borra la venta y la foto se mueve a
la carpeta /BACKUPVENTAS -->

<?php
require_once "Venta.php";
$pathBackup="./ImagenesBackupVentas/";
$body = json_decode(file_get_contents("php://input"), true);
if(isset($body['numeroPedido']))
{
   echo Venta::EliminarVenta($body['numeroPedido'],$pathBackup);
}else{
echo "Faltan datos";
}

?>