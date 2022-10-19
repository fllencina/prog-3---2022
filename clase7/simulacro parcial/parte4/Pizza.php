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
    static function InsertarPizza($arrayPizza, $sabor, $precio, $tipo, $cantidad, $path,$archivo,$pathImagen)
    {
        // echo $sabor;
        // echo $tipo;
        $insertar = false;
        if (!empty($arrayPizza)) {
            if (self::ExistePizzaDetalle($arrayPizza, $sabor, $tipo, $cantidad) != 1) {
                $insertar = true;
            } else {
                self::ActualizarPizza($arrayPizza, $sabor, $precio, $tipo, $cantidad, $path);
                return "Cantidad actualizada.";
            }
        } else {
            $insertar = true;
        }
        if ($insertar) {
           // var_dump($archivo);
            $Pizza = new Pizza($sabor, $precio, $tipo, $cantidad);
            $Nombre=$tipo."-".$sabor;
            GuardarFoto($archivo, $Nombre,$pathImagen);
            return  GuardarJson($arrayPizza, $path, $Pizza);
        }
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
}
