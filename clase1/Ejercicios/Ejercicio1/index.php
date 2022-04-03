<!-- 
  Aplicación No 1 (Sumar números)
Confeccionar un programa que sume todos los números enteros desde 1 mientras la suma no
supere a 1000. Mostrar los números sumados y al finalizar el proceso indicar cuantos números
se sumaron.
Lencina Fernanda
 -->
<?php


$numero=1;
$sumar=1;
$Maximo=1000;
$Contador=0; 
	do{		
      echo '<br> numeros sumados: ', $numero ;
      echo ' + ', $sumar ;
        $numero=$numero+$sumar;
        $sumar++;
        $Contador++;
        
        echo '<br> - Resultado de la suma:', $numero ;
	}while($numero+$sumar<$Maximo);
	
	echo ' <br> Cantidad de numeros que se sumaron:', $Contador ;
    
	
  
?>