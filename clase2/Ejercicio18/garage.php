<?php
require_once "Auto.php";

class Garage{

   private $_razonSocial;
   private $_precioPorHora ;
   private $_autos;

   function __construct($razonSocial,$precioPorHora=300)
	{
		$this->_razonSocial=$razonSocial;
		$this->_precioPorHora=$precioPorHora;
		$this->_autos=array();		
	}
    function  MostrarGarage()
	{
		$strRet = "<br>";
	    $strRet .= "_razonSocial: " . $this->_razonSocial . "<br>";
	    $strRet .= "_precioPorHora: $ " . $this->_precioPorHora . "<br>";
	    $strRet .= "_autos: <br>";
	   

        foreach ($this->_autos as $auxAuto) {
            $strRet=$strRet."<br>". Auto::MostrarAuto($auxAuto) ;
        }

	    return $strRet;
	}
     function MostrarRazonSocial()
     {
         return $this->_razonSocial;
     }
     
	function Equals($auto2)
	{      
		$autoExistente=false;

		foreach ($this->_autos as $auxAuto) {
			if($auxAuto->Equals($auto2)){
                
				$autoExistente=true;
				break;
			}
		}
		return $autoExistente;			
	}

		function Add($auto)
		{			
			if(!$this->Equals($auto))
			{
				array_push($this->_autos, $auto);
				return "Auto ingresado al garage correctamente";
			}
			else{
				return "El Auto ya existe en el garage";
			}
		}
		function Remove($auto)
		{
			for($i=0;$i<count($this->_autos);$i++)
			{
				if($this->_autos[$i]->Equals($auto))
				{
					unset($this->_autos[$i]);	
					//$salida = array_slice($this->_autos,		
					return "Auto eliminado del garage correctamente"; 
				}				
			}
			return "El auto no estaba en el garage";
		}


}


?>
