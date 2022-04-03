
<!-- Lencina Fernanda

Aplicación Nº 15 (Figuras geométricas)
La clase FiguraGeometrica posee: todos sus atributos protegidos, un constructor por defecto,
un método getter y setter para el atributo _color, un método virtual (ToString) y dos
métodos abstractos: Dibujar (público) y CalcularDatos (protegido).
CalcularDatos será invocado en el constructor de la clase derivada que corresponda, su
funcionalidad será la de inicializar los atributos _superficie y _perimetro.
Dibujar, retornará un string (con el color que corresponda) formando la figura geométrica del
objeto que lo invoque (retornar una serie de asteriscos que modele el objeto).
Ejemplo:

  *			*******
 *** 		*******
***** 		*******

Utilizar el método ToString para obtener toda la información completa del objeto, y luego
dibujarlo por pantalla. -->


<?php
include "Rectangulo.php";
include "Triangulo.php";


	abstract class FiguraGeometrica
	{
		protected $_color;
		protected $_perimetro;
		protected $_superficie;

		public function _constructor( ){
			 $_color = "";
       		 $_superficie = 0.0;
       		 $_perimetro = 0.0;
		}
		public function GetColor()
		{
			return $this->_color;
		}
		public function SetColor($_color)
		{
			return $this->_color= $_color;
		}
	
		public function ToString() 
		{
	        $strRet = "FiguraGeometrica <br>";
	        $strRet .= "Color: " . $this->_color . "<br>";
	        $strRet .= "Superficie: " . $this->_superficie . "<br>";
	        $strRet .= "Perimetro: " . $this->_perimetro . "<br>";

	        $strRet .= "Dibujo: <br>\n<br>" . $this->Dibujar() . "<br>";

        	return $strRet;
  	 	}

    	protected abstract function CalcularDatos();

    	public abstract function Dibujar();
	}
?>

