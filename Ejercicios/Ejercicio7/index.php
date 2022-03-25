
<!--
 Lencina Fernanda
Aplicación Nº 7 (Mostrar impares)
Generar una aplicación que permita cargar los primeros 10 números impares en un Array.
Luego imprimir (utilizando la estructura f or ) cada uno en una línea distinta (recordar que el
salto de línea en HTML es la etiqueta < br/> ). Repetir la impresión de los números utilizando
las estructuras w hile y f oreach .

 -->

 <?php

$cantidad=0;
$contador=1;
$ArrayImpares=array();
do{
	if ($contador%2!=0){
   		array_push($ArrayImpares, $contador) ;
   		$cantidad++;
	}	
    $contador++;
} while($cantidad<10);

echo "Muestro numeros del array con estructura condicional for <br><br>";

for ($i=0; $i <count($ArrayImpares) ; $i++) { 
	echo $ArrayImpares[$i], "<br>";	
}
echo "------------------------------------------<br> Muestro numeros del array con estructura condicional foreach <br><br>";

foreach ($ArrayImpares as  $value) {
	echo $value,"<br>" ;	
}
echo "------------------------------------------<br> Muestro numeros del array con estructura condicional While <br><br>";

$indice=0;
while ($indice<count($ArrayImpares))
{
	echo $ArrayImpares[$indice],'<br>';
	$indice=$indice+1;	
}

?>
