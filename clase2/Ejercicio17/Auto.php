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
	}
?>