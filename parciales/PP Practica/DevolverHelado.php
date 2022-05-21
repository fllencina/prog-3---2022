<?php


require_once "Venta.php";
require_once "DevolucionVenta.php";

require_once "Helado.php";

$path="./devoluciones.Json";
$array=LeerJSON($path);
$pathFotoClienteDevolucion="./FotoClienteDevolucion/";
var_dump($_POST);

if (isset($_POST["numeroPedido"], $_POST["causa"], $_FILES["archivo"])) {
    
    $causa = $_POST["causa"];
    $numeroPedido = $_POST["numeroPedido"];
 echo "va a devolucion";
    echo DevolucionVenta::DevolverVenta($numeroPedido,$causa,$_FILES,$path,$pathFotoClienteDevolucion);
        
    
}
else  {
echo "no recibe datos";
}

?>