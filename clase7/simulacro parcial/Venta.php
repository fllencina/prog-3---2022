a-(1 pts.) AltaVenta.php: (por POST)se recibe el email del usuario y el sabor,tipo y cantidad ,si el ítem existe en Pizza.json, y hay stock guardar en la base de datos con la fecha, número de pedido y id autoincremental) y se debe descontar la cantidad vendida del stock.
b-(1 pt) completar el alta con imagen de la venta , guardando la imagen con el tipo+sabor+mail(solo usuario hasta el @) y fecha de la venta en la carpeta /Imagenes DeLaVenta
<?php

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

    function __construct($mail, $sabor, $tipo, $cantidad, $imagen = null)
    {
        $this->mail =  $mail;
        $this->sabor =  $sabor;
        $this->tipo =  $tipo;
        $this->cantidad =  $cantidad;
        $this->fechaPedido =  self::ObtenerFecha();

        $this->imagen =  $imagen;
    

    }
    function guardarFoto($file, $postNombre,$pathFoto)
    {
        //echo "guarda Foto";
        if (!is_dir($pathFoto)) {
            mkdir($pathFoto, 0777);
        }
    
        $dic = $pathFoto;
        $nameImagen = $file["archivo"]["name"];
    
        $explode = explode(".", $nameImagen);
        $tamaño = count($explode);
    
        $dic .= $postNombre;
        $dic .= ".";
        $dic .= $explode[$tamaño - 1];
    
    
    
        $Retorno = false;
        if (!file_exists($dic)) {
            $Retorno = move_uploaded_file($_FILES["archivo"]["tmp_name"], $dic);
        } else {
    
            $Retorno = move_uploaded_file($_FILES["archivo"]["tmp_name"], $dic);
        }
    
        
        return $Retorno;
    }
    static function ObtenerFecha()
    {
        return date("Y-m-d");
    }
    function insertarSQL()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("INSERT into venta (mail,sabor,tipo,cantidad,fechaPedido)values(:mail,:sabor,:tipo,:cantidad,:fechaPedido)");
        $consulta->bindValue(':mail', $this->mail, PDO::PARAM_INT);
        $consulta->bindValue(':sabor', $this->sabor, PDO::PARAM_STR);
        $consulta->bindValue(':tipo', $this->tipo, PDO::PARAM_STR);
        $consulta->bindValue(':cantidad', $this->cantidad, PDO::PARAM_INT);
        $consulta->bindValue(':fechaPedido', $this->fechaPedido, PDO::PARAM_STR);


        $consulta->execute();
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
    }
    static function ValidarVenta($arrayPizza, $mail, $sabor, $tipo, $cantidad,$imagen, $path,$pathFoto)
    {
        if (Pizza::ExistePizza($arrayPizza, $sabor, $tipo, $cantidad)) {

            $Venta = new venta($mail, $sabor, $tipo, $cantidad,$imagen);
            $Venta->insertarSQL();
            
            $Nombre=$tipo."-".$sabor."-".explode("@", $mail)[0] ."-".$Venta->fechaPedido; 
            //Imagenes DeLaVenta
            $Venta-> guardarFoto($imagen, $Nombre,$pathFoto);
            Pizza::RestarStock($arrayPizza, $sabor, $tipo, $cantidad, $path);
            echo "venta realizada";
        } else {
            echo " no se puede vender la pizza";
        }
    }
}






?>