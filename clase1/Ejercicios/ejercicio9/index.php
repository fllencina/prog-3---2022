<!-- Aplicación No 9 (Arrays asociativos)
Realizar las líneas de código necesarias para generar un Array asociativo $lapicera, que
contenga como elementos: ‘color’, ‘marca’, ‘trazo’ y ‘precio’. Crear, cargar y mostrar tres
lapiceras.
Lencina Fernanda -->

<?php

$Color=array('azul','negro','rojo','verde');
$Marca=array('PaperMate','Bic','Faber','Parker');
$Trazo=array('fino','grueso','medio');
$Precio=array(10,20,30,50,100);


$CantidadLapiceras=0;

//variable para mostrar datos
$resultadoMostrar='';

while($CantidadLapiceras<3)
{
    $lapicera=array("Color"=>$Color[random_int(0,3)],"Marca"=>$Marca[random_int(0,3)],"Trazo"=>$Trazo[random_int(0,2)],"Precio"=>$Precio[random_int(0,4)]);
    $CantidadLapiceras=$CantidadLapiceras+1;
    $resultadoMostrar=$resultadoMostrar. "Lapicera ".$CantidadLapiceras." => Color: ".$lapicera["Color"].", Marca: ".$lapicera["Marca"].", Trazo: ".$lapicera["Trazo"].", Precio: ".$lapicera["Precio"]. "<br>";
}

//muestro
echo $resultadoMostrar;
?>