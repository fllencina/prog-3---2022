<?php

class Auto 
	{
		private $_color;
		private $_precio;
		private $_marca;
		private $_fecha;

		
		function __construct($marca,$color,$precio=null,$fecha=null)
		{
			$this->_color=$color;
			$this->_marca=$marca;	
			if($precio==null)	
			{
				$this->_precio=10500;
			}		
			else{
				$this->_precio=$precio;	
			}		
			if($fecha==null)	
			{
				$this->_fecha=date("m/d/y");
			}
			else{
				$this->_fecha=$fecha;
			}
					
		}

		function AgregarImpustos($impuesto)
		{
			return  $this->_precio + $impuesto;
		}
		
		static function  MostrarAuto($auto)
		{
			$strRet='';
			if(isset($auto)){
				
				$strRet .= "Color: " . $auto->_color . "<br>";
				$strRet .= "Precio: " . $auto->_precio . "<br>";
				$strRet .= "Marca: " . $auto->_marca . "<br>";
				if($auto->_fecha!=null)
	        	{
	        		$strRet .= "Fecha: " . $auto->_fecha . "<br>";
	        	}
	       		else{
	        		$strRet .= "Fecha: " . " - " . "<br>";
	       		}
			}
			else{
				$strRet .= "ERROR: No se recibió datos.<br>";
			}

	        return $strRet;
		}

		function Equals($auto2)
		{
			if(isset($auto2)){
			// echo $this->_marca."<br>";
			// echo $auto2->_marca."<br>";
				if (strcmp($this->_marca,$auto2->_marca) === 0) 
				{
					return true;
				}
			}	
			return false;
		}
		static function  Add($auto1,$auto2)
		{
			$RespuestaAdd='';			
				if($auto1->Equals($auto2))
				{
					if(strcmp($auto1->_color,$auto2->_color))
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
	}
?>