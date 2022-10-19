<?php

class Auto 
	{
		private $_color;
		private $_precio;
		private $_marca;
		private $_fecha;

		
		function __construct($marca,$color,$precio=10000,$fecha=null)
		{
			$this->_color=$color;
			$this->_marca=$marca;
			$this->_precio=$precio;
			$this->_fecha=$fecha;
			
		}

		function AgregarImpustos($impuesto)
		{
			return  $this->_precio + $impuesto;
		}

		static function  MostrarAuto($auto)
		{
			$strRet = "<br>";
	        $strRet .= "Color: " . $auto->_color . "<br>";
	        $strRet .= "Precio: $ " . $auto->_precio . "<br>";
	        $strRet .= "Marca: " . $auto->_marca . "<br>";
	        if($auto->_fecha!=null)
	        {
	        	$strRet .= "Fecha: " . $auto->_fecha . "<br>";
	        }
	        else{
	        	$strRet .= "Fecha: " . " - " . "<br>";
	        }

	        return $strRet;
		}

		function Equals($auto2)
		{
			if($this->_marca==$auto2->_marca)
			{
				return true;
			}			
			return false;
		}
		static function  Add($auto1,$auto2)
		{
			$RespuestaAdd='';			
				if($auto1->Equals($auto2))
				{
					if($auto1->_color==$auto2->_color)
					{
						return "El precio de la suma de los autos es: $" . $auto1->_precio+$auto2->_precio;
					}
					else{
						$RespuestaAdd="Los autos no son del mismo color. ";
					}					
				}
				else{
					$RespuestaAdd="Los autos no son de la misma marca. ";
				}	
			
			$RespuestaAdd.= "$ 0.";
			return $RespuestaAdd;
		}

// 		Crear un método de clase para poder hacer el alta de un Auto, guardando los datos en un
// archivo autos.csv.
// Hacer los métodos necesarios en la clase Auto para poder leer el listado desde el archivo
// autos.csv

static function Guardarcsv($path,$Array)
{
	//var_dump($Array);
	$retorno=false;
	if(!file_exists($path))
	{
		$myfile = fopen($path, "w");
		fclose($myfile);
	}
	 if(file_exists($path))
	{
		$file=fopen($path,"w+");
		for($i=0;$i<count($Array);$i++)
		{
			
				$linea=array($Array[$i]->_color, $Array[$i]->_precio ,$Array[$i]->_marca ,$Array[$i]->_fecha);
				if( fputcsv($file, $linea))
				{			
					$retorno= true;		
				}	
			}	
			fclose($file);	
		
	}

	return $retorno;
}
static function Leercsv($path)
{
	$elementosArray=[];
	if(file_exists($path))
	{
		if(file_exists($path) )
		{ 	
			$file=fopen($path, "r");
			
			while (!feof($file)) {   				
  				$linea = fgets($file);
   				if(!empty($linea))
   				{
   					$datos=explode(",", $linea);  				
	   				$_color=$datos[0];
	   				$_precio=$datos[1];
	   				$_marca=$datos[2];
	   				$_fecha=$datos[3];

	  				$auto= new auto($_color,$_precio,$_marca,$_fecha);
	  				array_push($elementosArray, $auto);
	  			}
			}
			fclose($file);	
		}
		return $elementosArray;
	}
	return $elementosArray;
}


static function MostrarLista($Array)
	{
		$strRet="<ul>";
		//var_dump($Array) ;
		for($i=0;$i<count($Array);$i++)
		{
			$strRet.="<li>". "color: " .$Array[$i]->_color . ", precio: " .$Array[$i]->_precio . ", marca: " .$Array[$i]->_marca . ", fecha: " .$Array[$i]->_fecha."</li>";
				
			}
			$strRet.="</ul>";
			return $strRet;
		}
}
?>