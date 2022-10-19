<?php

 function Guardarcsv($path,$Array)
{
	$retorno=false;
	$file=fopen($path,"a+");
	 if(file_exists($path))
	{
		for($i=0;$i<count($Array);$i++)
		{		
			$linea=array($Array[$i]->nombre, $Array[$i]->clave ,$Array[$i]->mail);
			if( fputcsv($file, $linea))
			{			
				$retorno= true;		
			}	
		}				
	}
	fclose($file);
	return $retorno;
}
function Leercsv($path)
	{
		$elementosArray=[];
		
			if(file_exists($path) )
			{ 	
				$file=fopen($path, "r");
				
				while (!feof($file)) {   				
					$linea = fgets($file);
					if(!empty($linea))
					{
						$datos=explode(",", $linea);  				
						$nombre=$datos[0];
						$clave=$datos[1];
						$mail=$datos[2];
						
						$usuario= new Usuario($nombre,$clave,$mail);
						array_push($elementosArray, $usuario);
					}
				}
				fclose($file);	
			}
			return $elementosArray;	
	}
?>