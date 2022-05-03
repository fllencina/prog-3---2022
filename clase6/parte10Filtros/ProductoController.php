<?php
require_once "AccesoDatos.php";
class ProductoController
{
    public $codBarras; //(6 sifras ) VALIDAR
    public $nombre;
    public $tipo;
    public $stock;
    public $precio;
    public $ID;
    public $fecha_creado;
    public $fecha_modificado;

    public function __construct()
    {
      
    }
    public function BorrarProducto()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("
				delete 
				from producto 				
				WHERE id=:id");
        $consulta->bindValue(':id', $this->ID, PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->rowCount();
    }

    
    public function ModificarProducto()
    {     
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("
				update producto 
				set codBarras=$this->codBarras,
                nombre='$this->nombre',
				tipo='$this->tipo',
				stock='$this->stock',
				precio='$this->precio',

                fecha_modificado='$this->fecha_modificado'
                          
				WHERE id='$this->ID'");
        return $consulta->execute();
    }
    public function ModificarProductoParametros()
    {
        //echo "llega al controller a modificar producto";
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("
				update producto 
				set 
				nombre=:nombre,
				tipo=:tipo,
				stock=:stock,
				precio=:precio,

				fecha_modificado=:fecha_modificado			
				WHERE id=:id");
        $consulta->bindValue(':id', $this->ID, PDO::PARAM_INT);
       // $consulta->bindValue(':codBarras', $this->codBarras, PDO::PARAM_INT);
        $consulta->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);
        $consulta->bindValue(':tipo', $this->tipo, PDO::PARAM_STR);
        $consulta->bindValue(':stock', $this->stock, PDO::PARAM_INT);
        $consulta->bindValue(':precio', $this->precio, PDO::PARAM_STR);

        $consulta->bindValue(':fecha_modificado', $this->fecha_modificado, PDO::PARAM_STR);
                
        return $consulta->execute();
    }

    
    
    public function InsertarProductoParametros()
    {
       
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("INSERT into producto (codBarras,nombre,tipo,stock,precio,fecha_creado)values(:codBarras,:nombre,:tipo,:stock,:precio,:fecha_creado)");
        $consulta->bindValue(':codBarras', $this->codBarras, PDO::PARAM_INT);
        $consulta->bindValue(':nombre', $this->nombre, PDO::PARAM_STR); 
        $consulta->bindValue(':tipo', $this->tipo, PDO::PARAM_STR);
        $consulta->bindValue(':stock', $this->stock, PDO::PARAM_INT);
        $consulta->bindValue(':precio', $this->precio, PDO::PARAM_STR);
        $consulta->bindValue(':fecha_creado', $this->fecha_creado, PDO::PARAM_STR);
        
        $consulta->execute();
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
    }



    public static function TraerTodoLosProductos($orden)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("select * from producto order by nombre $orden");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS, "ProductoController");
    }

    public static function TraerUnProducto($codBarras)
    {
        //echo "entra al traer un producto de controller";
       // var_dump($codBarras);
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("select * from producto where codBarras = $codBarras");
        $consulta->execute();
        $ProdBuscado = $consulta->fetchObject('productocontroller');
        //echo "<br> producto buscado<br>";
        //var_dump($ProdBuscado);
        return $ProdBuscado;
    }

    

}
