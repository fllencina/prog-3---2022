<?php
require_once "manejadorArchivos.php";
require_once "Venta.php";
require_once "Cupon.php";
require_once "AccesoDatos.php";

class DevolucionVenta
{
    public  $numeroPedido;
    public  $causa;
    public $id;



    function __contruct()
    {
    }
    function NuevaDevolucion($numeroPedido, $causa, $archivo, $pathFotoClienteDevolucion)
    {
        $devolucion = new DevolucionVenta();
        $devolucion->numeroPedido = $numeroPedido;
        $devolucion->causa = $causa;
        $devolucion->id = GeneradorID("DevolverHelado");


        GuardarFoto($archivo, "devolucion" . $numeroPedido, $pathFotoClienteDevolucion);
        return $devolucion;
    }
    static function DevolverVenta($numeroPedido, $causa, $archivo, $path, $pathFotoClienteDevolucion)
    {

        $array = LeerJSON($path);
       
        if (COUNT($array)>0) {
            foreach ($array as $x => $val) {
                if ($val->numeroPedido == $numeroPedido) {
                    return "ya existe devolucion del pedido.";
                }
            }
        }
            
            $venta = Venta::ObtenerUnaVenta($numeroPedido);

            
            if (isset($venta) && $venta) {
                if ($venta->eliminado != 1) {
                    $devolucion =  self::NuevaDevolucion($numeroPedido, $causa, $archivo, $pathFotoClienteDevolucion);
                    GuardarJson($array, $path, $devolucion);
                    Cupon::CrearNuevoCupon($devolucion->id);
                    return "devolucion generada.";
                } else {
                    return "No se puede realizar la devolucion, la venta fue eliminada.";
                }
            }
        }
    
}
