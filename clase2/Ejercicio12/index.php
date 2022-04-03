
<!-- Aplicación Nº 12 (Invertir palabra)
Realizar el desarrollo de una función que reciba un Array de caracteres y que invierta el orden
de las letras del Array.
Ejemplo: Se recibe la palabra “HOLA” y luego queda “ALOH”.
Lencina Fernanda -->

<?php
//Revisar  -- arreglado
$palabra=array("H","O","L","A");
echo "Palabra: <br>";
	for($i=0;$i<count($palabra);$i++)
	{
		echo $palabra[$i];
	}

	function InvertirCaracteresReverse($Array)
	{

		$invertida=array_reverse($Array);
		echo "<br> Invertida: <br>";

	for($i=0;$i<count($invertida);$i++)
	{
		echo $invertida[$i];
	}
	}

    InvertirCaracteresReverse($palabra);
    
    function InvertirCaracteresFor($Array)
	{
        
		
		echo "<br> Invertida: <br>";
        //echo(count($Array));
	for($i=count($Array) - 1;$i>=0;$i--)
	{
        //echo $i;
		echo $Array[$i];
	}
	}

	
	
    InvertirCaracteresFor($palabra);
    ?>





	
