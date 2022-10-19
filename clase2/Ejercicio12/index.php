
<!-- Aplicación Nº 12 (Invertir palabra)
Realizar el desarrollo de una función que reciba un Array de caracteres y que invierta el orden
de las letras del Array.
Ejemplo: Se recibe la palabra “HOLA” y luego queda “ALOH”.
Lencina Fernanda -->

<?php
require "funciones.php";

//Revisar  -- arreglado
$palabra=array("H","O","L","A");
$Mostrar= "Palabra: <br>";

	for($i=0;$i<count($palabra);$i++)
	{
		$Mostrar=$Mostrar. $palabra[$i];
	}

    $Mostrar=$Mostrar. "<br><br>Metodo 1...............";
	$Mostrar=$Mostrar. InvertirCaracteres($palabra);
    $Mostrar=$Mostrar. "<br><br>Metodo 2...............";
    $Mostrar=$Mostrar. InvertirCaracteresFor($palabra);
   echo $Mostrar;
  ?>





	
