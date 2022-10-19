<!-- 

Aplicación Nº 11 (Potencias de números)
Mostrar por pantalla las primeras 4 potencias de los números del uno 1 al 4 (hacer una función
que las calcule invocando la función pow).

Lencina Fernanda
 -->


<?php

 require_once "funciones.php";
$retorno='';
$CantidadNumeros=4;
$CantidadPotencias=4;
	for ($n= 1 ; $n<=$CantidadNumeros;$n++) {
		$retorno = $retorno."<br>Potencias del numero ". $n;
		$retorno=$retorno. "<br>............. <br>";
		for($i=1;$i<=$CantidadPotencias;$i++)
		{			
			$retorno=$retorno."Exponente :".$i ." - Resultado: " ; 
			$Resultado= CalcularPotencias($n, $i);
			$retorno=$retorno. $Resultado."<br>............. <br>";
		}
	}


echo $retorno;

?>

