<!-- Aplicación No 5 (Números en letras)
Realizar un programa que en base al valor numérico de una variable $num, pueda mostrarse
por pantalla, el nombre del número que tenga dentro escrito con palabras, para los números
entre el 20 y el 60.
Por ejemplo, si $num = 43 debe mostrarse por pantalla “cuarenta y tres”.

Lencina Fernanda -->

<?php
$num = random_int(20, 60);

$unidad = $num % 10;
$decena = ($num - $unidad) / 10;

	

$stringRetorno;
switch ($decena) {
	case 2:
		if($unidad==0)
		{
			$stringRetorno= "Veinte";
		}
		else
		{
			$stringRetorno= "Veinti";
		}
		break;
		case 3:
		
			$stringRetorno= "Treinta";
		
		break;
		case 4:
		
			$stringRetorno= "Cuarenta";
		
		break;
		case 5:
		
			$stringRetorno= "Cincuenta";
		
		break;
		case 6:	
			$stringRetorno= "Sesenta";
		break;
	default:
		echo "Debe ingresar un numero entre 20 y 60";
		break;
}
if($decena != 2 && $unidad!=0 )
{
	$stringRetorno.= ' y '; 
}

	switch ($unidad)
	{
		case 9:
		{
			$stringRetorno.= "nueve";
			break;
		}
		case 8:
		{
			$stringRetorno.= "ocho";
			break;
		}
		case 7:
		{
			$stringRetorno.= "siete";
			break;
		}
		case 6:
		{
			$stringRetorno.= "seis";
			break;
		}
		case 5:
		{
			$stringRetorno.= "cinco";
			break;
		}
		case 4:
		{
			$stringRetorno.= "cuatro";
			break;
		}
		case 3:
		{
			$stringRetorno.= "tres";
			break;
		}
		case 2:
		{
			$stringRetorno.= "dos";
			break;
		}
		case 1:
		{
			$stringRetorno.= "uno";
			break;
		}
		case 0:
		{
			$stringRetorno.= "";
			break;
		}
	}
	//echo $numuni;
    echo "numero: ",$num ,'<br>' , "decena: ",$decena ,'<br>',"unidad: ",$unidad ,'<br>Numero en letras: ',$stringRetorno;
	


?>


