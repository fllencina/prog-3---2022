<?php
require_once "AccesoDatos.php";
class UsuarioController
{
    public $nombre;
    public $apellido;
    public $clave;
    public $mail;
    public $ID;
    public $fecha_de_registro;
    public $localidad;
    public $foto;

    public function __construct()
    {
      
    }
    public function BorrarUsuario()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("
				delete 
				from usuario 				
				WHERE id=:id");
        $consulta->bindValue(':id', $this->id, PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->rowCount();
    }

    
    public function ModificarUsuario()
    {

        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("
				update usuario 
				set nombre='$this->nombre',
				clave='$this->clave',
				mail='$this->mail',
                foto='$this->foto',
                apellido='$this->apellido',
                localidad='$this->localidad'
                
				WHERE id='$this->id'");
        return $consulta->execute();
    }
    public function ModificarUsuarioParametros()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("
				update usuario 
				set nombre=:nombre,
				apellido=:apellido,
				mail=:mail,
				clave=:clave,
				localidad=:localidad,
				foto=:foto
				
				WHERE id=:id");
        $consulta->bindValue(':id', $this->id, PDO::PARAM_INT);
        $consulta->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);
        $consulta->bindValue(':apellido', $this->apellido, PDO::PARAM_STR);
        $consulta->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        $consulta->bindValue(':clave', $this->clave, PDO::PARAM_STR);
        $consulta->bindValue(':localidad', $this->localidad, PDO::PARAM_STR);
        $consulta->bindValue(':foto', $this->foto, PDO::PARAM_STR);
        
        return $consulta->execute();
    }

    
    public function InsertarUsuario()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("INSERT into usuario (nombre,apellido,clave,mail,foto,fecha_de_registro,localidad)values('$this->nombre','$this->apellido','$this->clave','$this->mail','$this->foto','$this->fecha_de_registro','$this->localidad')");
        $consulta->execute();
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
    }
    public function InsertarUsuarioParametros()
    {

        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("INSERT into usuario (nombre,apellido,clave,mail,foto,fecha_de_registro,localidad)values(:nombre,:apellido,:clave,:mail,:foto,:fecha_de_registro,:localidad)");
        $consulta->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);
        $consulta->bindValue(':apellido', $this->apellido, PDO::PARAM_STR); 
        $consulta->bindValue(':clave', $this->clave, PDO::PARAM_STR);
        $consulta->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        $consulta->bindValue(':foto', $this->foto, PDO::PARAM_STR);
        $consulta->bindValue(':fecha_de_registro', $this->fecha_de_registro, PDO::PARAM_STR);
        $consulta->bindValue(':localidad', $this->localidad, PDO::PARAM_STR);

      
        $consulta->execute();
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
    }



    public static function TraerTodoLosUsuarios()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("select * from usuario");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS, "UsuarioController");
    }

    public static function TraerUnCd($id)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("select * from usuario where id = $id");
        $consulta->execute();
        $cdBuscado = $consulta->fetchObject('usuario');
        return $cdBuscado;
    }

    public static function TraerUnUsuarioMail($mail)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("select  * from usuario  WHERE mail=?");
        $consulta->execute(array($mail));
        
        $cdBuscado = $consulta->fetchObject('usuariocontroller');
        return $cdBuscado;
    }

    public static function TraerUnCdAnioParamNombre($id, $anio)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("select  titel as titulo, interpret as cantante,jahr as año from cds  WHERE id=:id AND jahr=:anio");
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->bindValue(':anio', $anio, PDO::PARAM_STR);
        $consulta->execute();
        $cdBuscado = $consulta->fetchObject('cd');
        return $cdBuscado;
    }

    public static function TraerUnCdAnioParamNombreArray($id, $anio)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("select  titel as titulo, interpret as cantante,jahr as año from cds  WHERE id=:id AND jahr=:anio");
        $consulta->execute(array(':id' => $id, ':anio' => $anio));
        $consulta->execute();
        $cdBuscado = $consulta->fetchObject('cd');
        return $cdBuscado;
    }
}
