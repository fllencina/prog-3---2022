<?php
require_once "AccesoDatos.php";
class Usuario{
   public  $nombre;
   public  $apellido;
   public  $clave;
   public  $localidad;
   public  $mail;
   public $fecha_de_registro;

   function __construct($nombre,$apellido,$clave,$localidad,$mail)
{
    $this->nombre=$nombre;
    $this->apellido=$apellido;
    $this->clave=$clave;
    $this->localidad=$localidad;
    $this->mail=$mail;
    $this->fecha_de_registro=self::ObtenerFecha();


}
static function ObtenerFecha()
	{
			return date("Y-m-d");
	}

 function InsertarUsuario()
{
    $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("INSERT into usuario (nombre,apellido,clave,mail,fecha_de_registro,localidad)values(:nombre,:apellido,:clave,:mail,:fecha_de_registro,:localidad)");
        $consulta->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);
        $consulta->bindValue(':apellido', $this->apellido, PDO::PARAM_STR); 
        $consulta->bindValue(':clave', $this->clave, PDO::PARAM_STR);
        $consulta->bindValue(':mail', $this->mail, PDO::PARAM_STR);       
        $consulta->bindValue(':fecha_de_registro', $this->fecha_de_registro, PDO::PARAM_STR);
        $consulta->bindValue(':localidad', $this->localidad, PDO::PARAM_STR);
     
        $consulta->execute();
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
    
}

}


?>