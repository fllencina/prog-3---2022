

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
	class  Rectangulo extends FiguraGeometrica
	{
		private $_ladoUno;
		private $_ladoDos;


		public function __construct($l1, $l2) 
		{
	        $this->_ladoUno = $l1;
	        $this->_ladoDos = $l2;
	        $this->CalcularDatos();
	   	}

	    protected function CalcularDatos() 
	    {
	        $this->_superficie = number_format($this->_ladoUno * $this->_ladoDos,2);
	        $this->_perimetro = number_format(($this->_ladoUno * 2) + ($this->_ladoDos * 2),2);
	    }
	     public function Dibujar() 
	    {
        	$strRet = "\n &nbsp;&nbsp;\n";

	        for ( $altura = 0; $altura < $this->_ladoDos; $altura++ ) {
	            for ( $base = 0; $base < $this->_ladoUno; $base++ ) {
	                $strRet .= "*";
	            }
	            $strRet .= "\n<br>&nbsp;&nbsp;\n";
	        }
        	return $strRet;
    	}
	}
?>

