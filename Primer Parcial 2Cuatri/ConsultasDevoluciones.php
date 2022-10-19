<?php
require_once "DevolucionVenta.php";
require_once "Cupon.php";


echo DevolucionVenta::ListarDevoluciones();

echo Cupon::ListarCupones();

echo DevolucionVenta::ListarDevolucionesConCupones();
     
?>
