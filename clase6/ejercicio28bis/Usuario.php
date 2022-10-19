<?php
require_once "AccesoDatos.php";
 class Usuario{
    public $id;
   public  $nombre;
   public  $apellido;
   public  $mail;
   public  $clave;
   public  $localidad;
  
   public $fecha_de_registro;

function __construct($id=null,$nombre=null,$apellido=null,$mail=null,$clave=null,$localidad=null,$fecha_de_registro=null)
{$this->id=$id;
    $this->nombre=$nombre;
    $this->apellido=$apellido;
    $this->clave=$clave;
    $this->localidad=$localidad;
    $this->mail=$mail;
    // if($fecha_de_registro==null)
    // {
         $this->fecha_de_registro=self::ObtenerFecha();
    // }
    // else{
       //  $this->fecha_de_registro=$fecha_de_registro;//
    // }
    
}
static function ObtenerFecha()
	{
			return date("Y-m-d");
	}

 function InsertarUsuario()
{
    $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("INSERT into usuario (nombre,apellido,clave,mail,fecha_de_registro)values(:nombre,:apellido,:clave,:mail,:fecha_de_registro)");
        $consulta->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);
        $consulta->bindValue(':apellido', $this->apellido, PDO::PARAM_STR); 
        $consulta->bindValue(':clave', $this->clave, PDO::PARAM_STR);
        $consulta->bindValue(':mail', $this->mail, PDO::PARAM_STR);
       // $consulta->bindValue(':localidad', $this->localidad, PDO::PARAM_STR);       
        $consulta->bindValue(':fecha_de_registro', $this->fecha_de_registro, PDO::PARAM_STR);
        
     
        $consulta->execute();
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
    
}

public static function TraerTodoLosUsuarios()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("select nombre, apellido,clave,mail,localidad from Usuario");
        $consulta->execute();
       
        return $consulta->fetchAll(PDO::FETCH_CLASS, "Usuario");
    }

    public static function MostrarUsuariosSql()
	{
		$arrayUsuarios=self::TraerTodoLosUsuarios();
        var_dump($arrayUsuarios);
		return self::MostrarLista($arrayUsuarios);
	}
  public   static function MostrarLista($UsuariosArray)
	{
		$strRet = "<ul>";

		for ($i = 0; $i < count($UsuariosArray); $i++) {
	
			$strRet .= "<li>" . "Nombre: " . $UsuariosArray[$i]->nombre . ", Apellido: " . $UsuariosArray[$i]->apellido . ", Localidad: " . $UsuariosArray[$i]->localidad . ", Clave: " . $UsuariosArray[$i]->clave . ", Email: " . $UsuariosArray[$i]->mail ;
		}
		$strRet .=  "</ul>";
		return $strRet;
	}

}


?>