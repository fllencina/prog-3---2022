
<?php

class usuario{
    public $nombre;
    public $clave;
    public $mail;

function __construct($nombre,$clave,$mail)
{
    $this->nombre=$nombre;
    $this->clave=$clave;
    $this->mail=$mail;

}
    static function Guardarcsv($path,$Array)
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
	static function Leercsv($path)
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

	static function MostrarLista($UsuariosArray)
	{
		$strRet="<ul>";
		for($i=0;$i<count($UsuariosArray);$i++)
		{
			$strRet.="<li>". "nombre: " .$UsuariosArray[$i]->nombre . ", email: " .$UsuariosArray[$i]->clave . ", clave: " .$UsuariosArray[$i]->mail . "</li>";
				
		}
		$strRet.="</ul>";
		return $strRet;
	}


}



?>