<!-- Aplicación No 10 (Arrays de Arrays)
Realizar las líneas de código necesarias para generar un Array asociativo y otro indexado que
contengan como elementos tres Arrays del punto anterior cada uno. Crear, cargar y mostrar los
Arrays de Arrays.
Lencina Fernanda -->


<?php

$Color=array('azul','negro','rojo','verde');
$Marca=array('PaperMate','Bic','Faber','Parker');
$Trazo=array('fino','grueso','medio');
$Precio=array(10,20,30,50,100);
$ArrayIndexadoLapiceras=array();
$CantidadLapiceras=0;
$ArrayIndexado;
while($CantidadLapiceras<3)
{
	$lapicera=array("Color"=>$Color[random_int(0,3)],"Marca"=>$Marca[random_int(0,3)],"Trazo"=>$Trazo[random_int(0,2)],"Precio"=>$Precio[random_int(0,4)]);
	array_push($ArrayIndexadoLapiceras, $lapicera);
	$CantidadLapiceras=$CantidadLapiceras+1;
}


//para mostrar
$CantidadLapiceras=1;
$resultadoMostrar='';
foreach ($ArrayIndexadoLapiceras as $i => $lapicera) {
    $resultadoMostrar= $resultadoMostrar. "Lapicera ".$CantidadLapiceras.": <br>";


	foreach ($lapicera as $key => $value) {
        $resultadoMostrar= $resultadoMostrar . $key.": ".$value. "<br>";
        
	}
	$resultadoMostrar=$resultadoMostrar.'..........................................<br><br>';
    $CantidadLapiceras=$CantidadLapiceras+1;
}

echo $resultadoMostrar;



?>