<!-- Aplicación No 6 (Carga aleatoria)
Definir un Array de 5 elementos enteros y asignar a cada uno de ellos un número (utilizar la
función rand). Mediante una estructura condicional, determinar si el promedio de los números
son mayores, menores o iguales que 6. Mostrar un mensaje por pantalla informando el
resultado.

Lencina Fernanda -->

<?php

$Array=array((rand(0,9)),(rand(0,9)),(rand(0,9)),(rand(0,9)),(rand(0,9)));

//var_dump($Array);
$Acumulador=0;
foreach ($Array as  $value) {
	$Acumulador=$Acumulador+$value;
}

$promedio=$Acumulador/(count($Array));
$Resultado;
switch (true) {
	case ($promedio>6):
		$Resultado="Mayor";
		break;
	case ($promedio==6):
		$Resultado= "Igual";
		break;
		case ($promedio<6):
		$Resultado="Menor";
		break;
	default:
		# code...
		break;
}

echo "<br> el promedio de los valores del array es ",$promedio, " es ", $Resultado, " que 6";
?>
