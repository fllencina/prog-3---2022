<!-- Aplicación No 16 (Rectangulo - Punto)
Codificar las clases Punto y Rectangulo.

La clase Punto ha de tener dos atributos privados con acceso de sólo lectura (sólo con
getters), que serán las coordenadas del punto. Su constructor recibirá las coordenadas del
punto.
La clase Rectangulo tiene los atributos privados de tipo Punto _vertice1, _vertice2, _vertice3
y _vertice4 (que corresponden a los cuatro vértices del rectángulo).
La base de todos los rectángulos de esta clase será siempre horizontal. Por lo tanto, debe tener
un constructor para construir el rectángulo por medio de los vértices 1 y 3.
Los atributos ladoUno, ladoDos, área y perímetro se deberán inicializar una vez construido el
rectángulo.
Desarrollar una aplicación que muestre todos los datos del rectángulo y lo dibuje en la página.

Lencina Fernanda -->

<?php
//require_once "Punto.php";
require_once "Rectangulo.php";

$Punto1 = new Punto(4,10);
 $Punto3 = new Punto(10,14);    
 $Mostrar='';
 $Mostrar =$Mostrar."Coordenadas punto 1: ". $Punto1->GetCoordenadaX().",".$Punto1->GetCoordenadaY()."<br>";
 
 $Mostrar=$Mostrar. "Coordenadas punto 3: ".$Punto3->GetCoordenadaX().",".$Punto3->GetCoordenadaY();
	
	$Rectangulo = new Rectangulo($Punto1,$Punto3);
	$Mostrar=$Mostrar. "<br>-------------<br>";
    $Mostrar=$Mostrar. "lado uno: ". $Rectangulo->ladoUno;
    $Mostrar= $Mostrar."<br>lado dos: ". $Rectangulo->ladoDos;

    $Mostrar=$Mostrar. "<br>Area: ". $Rectangulo->area;
    $Mostrar=$Mostrar. "<br>perimetro: " . $Rectangulo->perimetro;

    $Mostrar=$Mostrar. "<br>-----------<br>";


	$Mostrar=$Mostrar. "<br>Dibujo: <br><br>" . $Rectangulo->Dibujar() . "<br>";
 echo $Mostrar;
?>
