<?php
class RealizarVentaController
{
    public $id_usuario;
    public $id_producto;
    public $cantidad;
    public $ID;
    public $fecha_de_venta;

    function __construct()
    {
    }
    public function InsertarVentaParametros()
    {
//var_dump($this);
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("INSERT into ventas (id_usuario,id_producto,cantidad,fecha_de_venta)values(:id_usuario,:id_producto,:cantidad,:fecha_de_venta)");
        $consulta->bindValue(':id_usuario', $this->id_usuario, PDO::PARAM_STR);
        $consulta->bindValue(':id_producto', $this->id_producto, PDO::PARAM_STR); 
        $consulta->bindValue(':cantidad', $this->cantidad, PDO::PARAM_STR);
        $consulta->bindValue(':fecha_de_venta', $this->fecha_de_venta, PDO::PARAM_STR);
        
        $consulta->execute();
        //echo $objetoAccesoDato->RetornarUltimoIdInsertado();
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
    }
}
