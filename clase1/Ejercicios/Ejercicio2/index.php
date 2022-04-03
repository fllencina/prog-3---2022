<!-- 
    Aplicación No 2 (Mostrar fecha y estación)
Obtenga la fecha actual del servidor (función date) y luego imprímala dentro de la página con
distintos formatos (seleccione los formatos que más le guste). Además indicar que estación del
año es. Utilizar una estructura selectiva múltiple.
Lencina Fernanda
 -->

 <?php

$hoy = date("F j, Y, g:i a");
echo $hoy ,'<br>';            
$hoy = date("m.d.y");      
echo $hoy ,'<br>';                 
$hoy = date("j, n, Y");   
echo $hoy ,'<br>';                    
$hoy = date("Ymd");       
echo $hoy ,'<br>';                 

$hoy = date('\i\t \i\s \t\h\e jS \d\a\y.'); 
echo $hoy ,'<br>';  
$hoy = date("D M j G:i:s T Y");      
echo $hoy ,'<br>';           
$hoy = date("Y-m-d H:i:s"); 
echo $hoy ,'<br>'; 

echo "--------------","<br>";
echo "Hoy es: ",date("d"), " / ",date("m"), " /",date("Y");
echo "<br>";

echo "--------------","<br>";

$dia=date("d");
$mes=date("m");

switch ($mes) {
	case '1':
	case '2':
		echo "Es Verano";	
		break;
	case '3':
		if($dia<21)
		{
			echo "Es Verano";
		}
		else{
			echo "Es Otoño";
		}
		break;
		case '4':
		case '5':
		echo "Es Otoño";
		break;
		case '6':
		if($dia<21)
		{
			echo "Es Otoño";
		}
		else{
			echo "Es Invierno";
		}
		break;
		case '7':
		case '8':
		echo "Es Invierno";
		break;
		case '9':
		if($dia<21)
		{
			echo "Es Invierno";
		}
		else{
			echo "Es Primavera";
		}
		break;
		case '10':
		case '11':
		echo "Es Primavera";
		break;
	case '12':
		if($dia<21)
		{
			echo "Es Primavera";
		}
		else{
			echo "Es Verano";
		}
		break;
	default:
		# code...
		break;
}


?>