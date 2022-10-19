<!-- a-(1 pts.) AltaVenta.php: (por POST)se recibe el email del usuario y el sabor,tipo y cantidad ,si el ítem existe en Pizza.json, y hay stock guardar en la base de datos con la fecha, número de pedido y id autoincremental) y se debe descontar la cantidad vendida del stock.
b-(1 pt) completar el alta con imagen de la venta , guardando la imagen con el tipo+sabor+mail(solo usuario hasta el @) y fecha de la venta en la carpeta /Imagenes DeLaVenta -->
<?php

require_once "ManejadorArchivos.php";
require_once "AccesoDatos.php";
class Venta
{

    public $mail;
    public $sabor;
    public $tipo;
    public $cantidad;
    public $fechaPedido;
    public $id;
    public $imagen;

    function __contruct()
    {
        // echo "llega a constructor";
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
        return $venta;
    }
   
    static function ObtenerFecha()
    {
        return date("Y-m-d");
    }
    function insertarSQL()
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
        $retorno = Pizza::ExistePizzaStock($arrayPizza, $sabor, $tipo, $cantidad);

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
            GuardarFoto($archivo, $Nombre, $pathImagen);
            Pizza::RestarStock($arrayPizza, $sabor, $tipo, $cantidad, $path);
            echo "venta realizada";
        } else {
            echo " no se puede vender la pizza";
        }
    }

    static function CantidadPizzasVendidas()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("select sum(venta.cantidad) as totalVendidas from venta");
        $consulta->execute();
        return $consulta->fetch(PDO::FETCH_ASSOC)['totalVendidas'];
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
    static function MostrarLista($Array)
    {
        $strRet = "<ul>";

        for ($i = 0; $i < count($Array); $i++) {
            $strRet .= "<li>" . "mail: " . $Array[$i]->mail . ", sabor: " . $Array[$i]->sabor . ", tipo: " . $Array[$i]->tipo . ", cantidad: " . $Array[$i]->cantidad . ", fechaPedido: " . $Array[$i]->fechaPedido .  ", numeroPedido: " . $Array[$i]->numeroPedido  . "</li>";
        }
        $strRet .=  "</ul>";
        return $strRet;
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
        return  $consulta->fetchAll(PDO::FETCH_CLASS, 'venta');
    }
}






?>