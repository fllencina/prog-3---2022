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
}
