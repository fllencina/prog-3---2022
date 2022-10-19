<?php
require_once "ManejadorArchivos.php";
class Pizza
{
    public $id;
    public $sabor;
    public $precio;
    public $tipo;
    public $cantidad;
    public $imagen;


    function __construct($sabor, $precio, $tipo, $cantidad, $imagen=null)
    {
        $this->sabor = $sabor;
        $this->tipo = $tipo;
        $this->precio = $precio;
        $this->cantidad = $cantidad;
        if($imagen!=null)
        {

        }
        $this->id = ObtieneID();
    }

   
   
    static function ExistePizza($arrayPizza, $sabor, $tipo,$cantidad)
    {
        foreach ($arrayPizza as $x => $val) {
            if ($val->tipo ==  $tipo && $val->sabor == $sabor) {
                return true;
            }        
        }
        return false;
    }
    static function InsertarPizza($arrayPizza, $sabor, $tipo, $cantidad, $precio, $path)
    {
        $retorno='';
        if (!self::ExistePizza($arrayPizza, $sabor, $tipo, $cantidad)) {
            $Pizza = new Pizza($sabor, $precio, $tipo, $cantidad);
              if(GuardarJson($arrayPizza, $path, $Pizza))
              {
                $retorno="Dato Agregado Correctamente.";
              }
             
        } else {

             self::ActualizarPizza($arrayPizza, $sabor, $tipo, $cantidad, $precio,$path);
             $retorno= "Datos actualizados";
        }
        return  $retorno;

    }
    static function ActualizarPizza($arrayPizza, $sabor, $tipo, $cantidad, $precio,$path)
    {
        // var_dump($arrayPizza);
        foreach ($arrayPizza as $x => $val) {
          
            if ($val->tipo ==  $tipo && $val->sabor == $sabor) {
               
                $val->cantidad = $val->cantidad + $cantidad;
                $val->precio = $precio;
            }
        }
        // var_dump($arrayPizza);
        return  GuardarJson($arrayPizza, $path, null);
    }
    
    static function ExistePizzaDetalle($arrayPizza, $sabor, $tipo)
    {
        $haySabor=false;
        $hayTipo=false;
        $retorno='';
        foreach ($arrayPizza as $x => $val) {
           
            if ($val->tipo ==  $tipo && $val->sabor == $sabor) {
                $haySabor=$hayTipo=true;
                $retorno = "Si hay";
                break;
            }        
            else if($val->tipo ==  $tipo  && $val->sabor != $sabor)
            {
                $haySabor=false;
                $hayTipo=true;

                
            }
            else if($val->tipo !=  $tipo  && $val->sabor == $sabor)
            {
                $haySabor=true;
                $hayTipo=false;
                
            }
        }

        if($haySabor && !$hayTipo)
        {
            $retorno= "No existe tipo";
        }
        if(!$haySabor && $hayTipo)
        {
            $retorno= "No existe sabor";
        }
        
        return $retorno;
       
       
    }
    static function ExistePizzaStock($arrayPizza, $sabor, $tipo,$cantidad)
    {
        foreach ($arrayPizza as $x => $val) {

            if ($val->tipo ==  $tipo && $val->sabor == $sabor && $val->cantidad >= $cantidad  ) {
                return 1;
            } 
        }
        return 0;
    }
    static function RestarStock($arrayPizza, $sabor, $tipo, $cantidad, $path)
    {
        foreach ($arrayPizza as $x => $val) {
            if ($val->sabor ==  $sabor  && $val->tipo ==  $tipo) {
                $val->cantidad = $val->cantidad - $cantidad;

                break;
            }
        }
        GuardarJson($arrayPizza, $path, null);
    }
}
