<?php
require_once "AccesoDatos.php";
class Venta
{
    public $mail;
    public $sabor;
    public $tipo;
    public $cantidad;
    public $fechaPedido;
    public $numeroPedido;
    public $imagen;
    public $eliminado;

    function __contruct()
    {
       
    }
    function nuevaVenta($mail, $sabor, $tipo, $cantidad,  $numeroPedido, $pathImagen)
    {
       
        $venta = new Venta();
        $venta->mail = $mail;
        $venta->sabor = $sabor;
        $venta->tipo = $tipo;
        $venta->cantidad = $cantidad;
        $venta->fechaPedido = self::ObtenerFecha();
        $venta->numeroPedido = $numeroPedido;
        $venta->imagen = $pathImagen;
        $venta->eliminado=0;
        return $venta;
    }
    static function ObtenerFecha()
    {
        return date("Y-m-d");
    }

    function InsertarSQL()
    {
        //var_dump($this);
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("INSERT into Venta(mail,sabor,tipo,cantidad,fechaPedido,numeroPedido,imagen) values(:mail,:sabor,:tipo,:cantidad,:fechaPedido,:numeroPedido,:imagen)");
        $consulta->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        $consulta->bindValue(':sabor', $this->sabor, PDO::PARAM_STR);
        $consulta->bindValue(':tipo', $this->tipo, PDO::PARAM_STR);
        $consulta->bindValue(':cantidad', $this->cantidad, PDO::PARAM_INT);
        $consulta->bindValue(':fechaPedido', $this->fechaPedido, PDO::PARAM_STR);
        $consulta->bindValue(':numeroPedido', $this->numeroPedido, PDO::PARAM_INT);
        $consulta->bindValue(':imagen', $this->imagen, PDO::PARAM_STR);

        // $consulta->bindValue(':numeroPedido', $this->numeroPedido, PDO::PARAM_INT);

        $consulta->execute();
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
    }

    static function ValidarVenta($arrayPizza, $mail, $sabor, $tipo, $cantidad, $numeroPedido, $path, $archivo, $pathImagen)
    {
        $retorno = Helado::ExisteHeladoStock($arrayPizza, $sabor, $tipo, $cantidad);

        if ($retorno == 1) {

            $Venta = self::nuevaVenta($mail, $sabor, $tipo, $cantidad, $numeroPedido, $pathImagen);

            $Nombre = $tipo . "-" . $sabor . "-" . explode("@", $mail)[0] . "-" . $Venta->fechaPedido;
            $nameImagen = $archivo["archivo"]["name"];
            $explode = explode(".", $nameImagen);
            $tamaño = count($explode);
            $extension = $explode[$tamaño - 1];
            $Venta->imagen = $pathImagen . $Nombre . '.' . $extension;

            $Venta->insertarSQL();
            //echo $Nombre;
            $Venta->GuardarFoto($archivo, $Nombre, $pathImagen);
            Helado::RestarStock($arrayPizza, $sabor, $tipo, $cantidad, $path);
            echo "venta realizada";
        } else {
            echo " no se puede realizar la venta";
        }
    }
    function GuardarFoto($file, $Nombre, $pathImagen)
    {
        if (!is_dir($pathImagen)) {
            mkdir($pathImagen, 0777);
        }
        $dic = $pathImagen;
        $nameImagen = $file["archivo"]["name"];
        //echo $nameImagen;
        $explode = explode(".", $nameImagen);
        $tamaño = count($explode);
        $dic .= $Nombre;
        $dic .= ".";
        $dic .= $explode[$tamaño - 1];
        //echo $dic;
        $Retorno = false;
        $Retorno = move_uploaded_file($_FILES["archivo"]["tmp_name"], $dic);
        return $Retorno;
    }

    static function MostrarLista($Array)
    {
        $strRet = "<ul>";

        for ($i = 0; $i < count($Array); $i++) {
            $strRet .= "<li>" . "mail: " . $Array[$i]->mail . ", sabor: " . $Array[$i]->sabor . ", tipo: " . $Array[$i]->tipo . ", cantidad: " . $Array[$i]->cantidad . ", fechaPedido: " . $Array[$i]->fechaPedido .  ", numeroPedido: " . $Array[$i]->numeroPedido  . "</li>";
        }
        $strRet .=  "</ul>";
        return $strRet;
    }
    public static function TraerVentasDeUnDia($fecha=null)
    {   
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        
        if($fecha==null)
        {

           $fecha = date('Y-m-d', time() - 60 * 60 * 24);
        }
        $consulta = $objetoAccesoDato->RetornarConsulta("select * from venta where fechaPedido ='$fecha'");
        $consulta->execute();
        $ventas = $consulta->fetchAll(PDO::FETCH_CLASS, 'venta');

        return Venta::MostrarLista($ventas);
    }
    
    static function ObtenerVentasPorRango($fechainicio, $fechafin)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $query = $objetoAccesoDato->RetornarConsulta("SELECT * FROM venta
        WHERE fechapedido BETWEEN :fechainicio AND :fechafin
        ORDER BY sabor;");
        $query->bindValue(':fechainicio', $fechainicio, PDO::PARAM_STR);
        $query->bindValue(':fechafin', $fechafin, PDO::PARAM_STR);
        $query->execute();
        $Array = $query->fetchAll(PDO::FETCH_CLASS, "Venta");
        return Venta::MostrarLista($Array);
    }
    public static function TraerVentasDeUnUsuario($mail)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("select * from venta where mail ='$mail'");
        $consulta->execute();
        $ventas = $consulta->fetchAll(PDO::FETCH_CLASS, 'venta');

        return Venta::MostrarLista($ventas);
    }

    public static function TraerVentasDeUnSabor($sabor)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("select * from venta where sabor ='$sabor'");
        $consulta->execute();
        $ventas = $consulta->fetchAll(PDO::FETCH_CLASS, 'venta');

        return Venta::MostrarLista($ventas);
    }
    static function ObtenerUnaVenta($numeroPedido)
    {

        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("select * from venta where numeroPedido =$numeroPedido");
        $consulta->execute();
        return  $consulta->fetchObject('venta');
    }
    static function ModificarVenta($numeroPedido, $sabor, $mail, $tipo, $cantidad)
    {
        $venta = self::ObtenerUnaVenta($numeroPedido);
        if (isset($venta) && $venta) {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE venta
        SET 
        mail = :mail,
        tipo = :tipo,
        sabor = :sabor,
        cantidad = :cantidad
        WHERE numeroPedido = :numeroPedido");
            $consulta->bindValue(':mail', $mail, PDO::PARAM_STR);
            $consulta->bindValue(':tipo', $tipo, PDO::PARAM_STR);
            $consulta->bindValue(':sabor', $sabor, PDO::PARAM_STR);
            $consulta->bindValue(':cantidad', $cantidad, PDO::PARAM_INT);
            $consulta->bindValue(':numeroPedido', $numeroPedido, PDO::PARAM_INT);
            $consulta->execute();
            $consulta->rowCount();
            if ($consulta->rowCount() >= 1) {
                return "Modificacion correcta";
            }
        }
        return "La venta a modificar no esta registrada.";
    }
    static function EliminarVenta($numeroPedido,$pathBKP)
    {
        $venta = self::ObtenerUnaVenta($numeroPedido);
        //var_dump($venta);
        $eliminado=1;
        if (isset($venta) && $venta) {
           
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta("
            UPDATE venta
            SET  eliminado = :eliminado				
				WHERE numeroPedido=:numeroPedido");
            $consulta->bindValue(':numeroPedido', $numeroPedido, PDO::PARAM_INT);
            $consulta->bindValue(':eliminado', $eliminado, PDO::PARAM_INT);

            $consulta->execute();
            echo $consulta->rowCount();
            if ($consulta->rowCount() >= 1) {
                if (!is_dir($pathBKP)) {
                    mkdir($pathBKP, 0777);
                }
                $destino =$pathBKP.str_replace("./ImagenesDeLaVenta/", "",$venta->imagen );
            //   echo $venta->imagen;
            //   echo $destino;
              if( !rename($venta->imagen, $destino) ) {  
                return "Eliminacion correcta, no se pudo mover la imagen a Backup";
            }  
            else {  
                return "Eliminacion correcta"; 
            }
                                   
            }   
            return "La venta a eliminar no esta registrada.";
        }
    
    }
    
    

}
