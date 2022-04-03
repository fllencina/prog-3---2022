<!-- Aplicación No 13 (Invertir palabra)
Crear una función que reciba como parámetro un string ($palabra) y un entero ($max). La
función validará que la cantidad de caracteres que tiene $palabra no supere a $max y además
deberá determinar si ese valor se encuentra dentro del siguiente listado de palabras válidas:
“Recuperatorio”, “Parcial” y “Programacion”. Los valores de retorno serán:
1 si la palabra pertenece a algún elemento del listado.
0 en caso contrario.
Lencina Fernanda -->

<?php
require "funciones.php";
$arrayPalabras=array("Recuperatorio", "Parcial", "Programacion");
	$Palabra_a_Validar="Recuperatorio";
	echo "Palabra: ",$Palabra_a_Validar ,"<br>";

	$retorno= Validar($Palabra_a_Validar,15,$arrayPalabras);
	switch ($retorno) {
		case '1':
			echo "retorna: ",$retorno, " (la palabra pertenece a la lista )";
			break;
		case '0':
			echo "retorna: ",$retorno, " (la palabra no pertenece a la lista) ";
			break;
		default:
			# code...
			break;
	}

    ?>
