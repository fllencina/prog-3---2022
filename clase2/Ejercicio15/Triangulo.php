

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
	class  Triangulo extends FiguraGeometrica
	{
		private $_altura;
		private $_base;

		public function __construct($base, $altura)
		{
	        $this->_base = $base;
	        $this->_altura = $altura;
	        $this->CalcularDatos();
    	}

	    protected function CalcularDatos() {
	        $this->_superficie = number_format(($this->_base * $this->_altura) / 2,2);
	        //Asumo triangulo rectangulo
	        $this->_perimetro = number_format(sqrt(pow($this->_base, 2)+pow($this->_altura, 2)) + $this->_base + $this->_altura,2);
	    }

		

    	public function Dibujar() {
        $strRet = "";
        $asteriscosAux = 1;
        for ( $alturaFor = 0; $alturaFor < $this->_altura; $alturaFor++ ) {

            for ( $espaciosVacios = 0; $espaciosVacios < ($this->_base - $alturaFor); $espaciosVacios++ ) {
                $strRet .= "&nbsp;&nbsp;";
            }

            for ( $asteriscos = 0; $asteriscos < $asteriscosAux; $asteriscos++ ) {
                $strRet .= "*";
            }

            for ( $espaciosVacios = 0; $espaciosVacios < ($this->_base - $alturaFor); $espaciosVacios++ ) {
                $strRet .= "&nbsp;";
            }
            $strRet .= "\n<br>\n";
            $asteriscosAux += 2;
        }

        return $strRet;
    }
	}

?>

