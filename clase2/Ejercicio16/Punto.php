<!-- La clase Punto ha de tener dos atributos privados con acceso de sólo lectura (sólo con
getters), que serán las coordenadas del punto. Su constructor recibirá las coordenadas del
punto. -->
<?php

 class Punto {

    private $coordenadaX;
    private $coordenadaY;

    
    public function __construct($X,$Y){
        
        $this->coordenadaX = $X;
        $this->coordenadaX = $Y;
    }

    public function GetCoordenadaX(){
        return $this->coordenadaX;
    }

    public function GetCoordenadaY(){
        return $this->coordenadaY;
    }
}


?>