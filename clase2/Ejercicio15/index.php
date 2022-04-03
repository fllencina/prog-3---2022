

<!-- Lencina Fernanda

Aplicación Nº 15 (Figuras geométricas)
La clase FiguraGeometrica posee: todos sus atributos protegidos, un constructor por defecto,
un método getter y setter para el atributo _color, un método virtual (ToString) y dos
métodos abstractos: Dibujar (público) y CalcularDatos (protegido).
CalcularDatos será invocado en el constructor de la clase derivada que corresponda, su
funcionalidad será la de inicializar los atributos _superficie y _perimetro.
Dibujar, retornará un string (con el color que corresponda) formando la figura geométrica del
objeto que lo invoque (retornar una serie de asteriscos que modele el objeto).
Ejemplo:

  *			*******
 *** 		*******
***** 		*******

Utilizar el método ToString para obtener toda la información completa del objeto, y luego
dibujarlo por pantalla. -->

<?php
	include "FiguraGeometrica.php";

	$rectangulo = new Rectangulo(5, 3);
	$rectangulo->Setcolor("green");

	 echo "<div style=display:inline-block;margin-left:20px;color:",$rectangulo->Getcolor()," >",$rectangulo->ToString(),"</div>";
	
	$triangulo = new Triangulo(7, 3);
	$triangulo->SetColor("blue");
	echo "<div style=display:inline-block;margin-left:30px;color:",$triangulo->Getcolor()," >",$triangulo->ToString(),"</div>" ;

?>

