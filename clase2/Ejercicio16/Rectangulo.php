<!-- La clase Rectangulo tiene los atributos privados de tipo Punto _vertice1, _vertice2, _vertice3
y _vertice4 (que corresponden a los cuatro vértices del rectángulo).
La base de todos los rectángulos de esta clase será siempre horizontal. Por lo tanto, debe tener
un constructor para construir el rectángulo por medio de los vértices 1 y 3.
Los atributos ladoUno, ladoDos, área y perímetro se deberán inicializar una vez construido el
rectángulo.
Desarrollar una aplicación que muestre todos los datos del rectángulo y lo dibuje en la página. -->

<?php

require "Punto.php";
class Rectangulo 
{
    
   private $_vertice1;
   private $_vertice2;
   private $_vertice3;
   private $_vertice4;
    public $ladoUno;
    public $ladoDos;
    public $area;
    public $perimetro;

function __construct ($punto1,$punto3)
{
    $this->_vertice1=$punto1;
    $this->_vertice3=$punto3;

    $punto2=new Punto($punto3->GetCoordenadaX(),$punto1->GetCoordenadaY());
    $punto4=new Punto($punto1->GetCoordenadaX(),$punto3->GetCoordenadaY());

    $this->_vertice2=$punto2;
    $this->_vertice4=$punto4;

    $this->ladoUno=$punto3->GetCoordenadaX()-$punto1->GetCoordenadaY();
    $this->ladoDos=$punto3->GetCoordenadaX()-$punto1->GetCoordenadaY();

    $this->CalcularDatos();

}
protected function CalcularDatos() 
{  
    $this->area=$this->ladoUno*$this->ladoDos;
    $this->perimetro = ($this->ladoUno * 2) + ($this->ladoDos * 2);
}
 public function Dibujar() 
{
    $strRet = "\n &nbsp;&nbsp;\n";

    for ( $altura = 0; $altura < $this->ladoDos; $altura++ ) {
        for ( $base = 0; $base < $this->ladoUno; $base++ ) {
            $strRet .= "*";
        }
        $strRet .= "\n<br>&nbsp;&nbsp;\n";
    }
    return $strRet;
}


}



?>