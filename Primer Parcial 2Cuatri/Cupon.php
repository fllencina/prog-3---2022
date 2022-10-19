<?php

class Cupon
{
    public $id;
    public $devolucion_ID;
    public $porcentajeDescuento;
    public $estado;

    function __construct()
    {
    }
    static function NuevoCupon($devolucion_ID, $porcentajeDescuento)
    {
        $cupon = new Cupon();
        $cupon->devolucion_ID = $devolucion_ID;
        $cupon->porcentajeDescuento = $porcentajeDescuento;
        $cupon->id = GeneradorID("cupon");
        $cupon->estado=0;
        return $cupon;
    }
    static  function CrearNuevoCupon($devolucion_ID)
    {
        $array = LeerJSON("cupones.json");

        foreach ($array as $x => $val) {
            if ($val->devolucion_ID == $devolucion_ID) {
                return "ya existe cupon";
            }
        }
        $cupon= self::NuevoCupon($devolucion_ID,10);
        GuardarJson($array,"cupones.json",$cupon); 
    }
    static function ObtenerCupon($id)
    {
        $array = LeerJSON("cupones.json");

        foreach ($array as $x => $val) {
            if ($val->id == $id) {
                return $val;
            }
        }
        return 0;
    }
    static function MarcarUsado($id)
    {
        $array = LeerJSON("cupones.json");

        foreach ($array as $x => $val) {
            if ($val->id == $id) {
                 $val->estado=1;
            }
        }
        GuardarJson($array,"cupones.json",null);
        return 0;
    }
    static function ListarCupones()
    {
        $array=LeerJSON("cupones.json");
        $tabla="<table><thead><th> <td>DevolucionID</td><td>Estado</td></th><tbody>";
        
        foreach ($array as $x => $val) {
           if($val->estado==0)
           {
            $estado="Sin uso";
           }
           else{
            $estado="Usado";
           }
           
            $tabla=$tabla."<tr><td>".$val->devolucion_ID."</td><td>".$estado."</td></tr>"  ; 
        }
        $tabla=$tabla."</tbody></thead></table>";
        return $tabla;
    }
}
