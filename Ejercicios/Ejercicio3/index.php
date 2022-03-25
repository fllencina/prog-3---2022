

<!-- Aplicación No 3 (Obtener el valor del medio)
Dadas tres variables numéricas de tipo entero $a, $b y $c realizar una aplicación que muestre
el contenido de aquella variable que contenga el valor que se encuentre en el medio de las tres
variables. De no existir dicho valor, mostrar un mensaje que indique lo sucedido.
Ejemplo 1: $a = 6; $b = 9; $c = 8; => se muestra 8.
Ejemplo 2: $a = 5; $b = 1; $c = 5; => se muestra un mensaje “No hay valor del medio”
Lencina Fernanda -->


<?php
$a = 1;
$b = 5;
$c = 1;

if($a == $b || $a == $c || $b == $c)
{
	echo "No hay valor en el medio";
}
else
{
	//$a es el valor del medio
	if($b > $a && $a > $c || $c > $a && $a > $b)
	{
		echo "El valor del medio es:" , $a;
	}
	//$b es el valor del medio
	if($c > $b && $b > $a || $a > $b && $b > $c)
	{
		echo "El valor del medio es:" , $b;
	}
	//$c es el valor del medio
	if($a > $c && $c > $b || $b > $c && $c > $a)
	{
		echo "El valor del medio es:" , $c;

	}
}

?>