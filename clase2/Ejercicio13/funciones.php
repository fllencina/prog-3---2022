<?php

//calcula potencia de un numero recibe numero y exponente retorna resultado 
function CalcularPotencias($numero, $potencia)
{
    return pow($numero, $potencia);
    
}

//valida que un numero sea par
function EsPar($numero)
{
	if($numero%2==0)
	{
		 return true;
	}
	return false;
}
//valida len y exitencia de una palabra en array
function Validar($palabra, $max, $ListaPalabras)
{
	$aValidar= ucfirst(strtolower($palabra)) ;
	if (strlen($aValidar) < $max) {
		if (in_array($aValidar, $ListaPalabras)) {
			return 1;
		}
	}
	return 0;
}

    function InvertirCaracteres($Array)
	{
        $retorno='';
		$invertida=array_reverse($Array);
		$retorno=$retorno. "<br> Invertida: <br>";

	for($i=0;$i<count($invertida);$i++)
	{
		$retorno=$retorno. $invertida[$i];
	}
    return $retorno;
	}
