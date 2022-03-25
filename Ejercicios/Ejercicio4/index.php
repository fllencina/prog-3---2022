<!-- Aplicación No 4 (Calculadora)
Escribir un programa que use la variable $operador que pueda almacenar los símbolos
matemáticos: ‘+’, ‘-’, ‘/’ y ‘*’; y definir dos variables enteras $op1 y $op2. De acuerdo al
símbolo que tenga la variable $operador, deberá realizarse la operación indicada y mostrarse el
resultado por pantalla.
Lencina Fernanda -->


<?php
$operador;

$randomOperador=random_int ( 1 , 4 );
$op1=random_int ( 0, 100 );
$op2=random_int ( 0, 100 );

$resultado;


switch ($randomOperador) {
	case 1:
		$operador='+';
		echo $op1 ,$operador,$op2  ;
		$resultado=$op1 + $op2;
		break;
		case 2:
		$operador='-';
		echo $op1 ,$operador,$op2  ;
		$resultado=$op1 - $op2;
		break;
		case 3:
		$operador='*';
		echo $op1 ,$operador,$op2  ;
		$resultado=$op1 * $op2;
		
		break;
		case 4:	
		if($op2!=0)
		{
			$operador='/';
			echo $op1 ,$operador,$op2  ;
			$resultado=$op1 / $op2;
		}
		else
		{
			echo "Error matematico, no se puede dividir por cero.";
		}
		break;	
	default:
		$operador='+';
		break;
	}


echo " = ", $resultado;

?>
