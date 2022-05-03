
<?php
require_once "UsuarioController.php";
class usuario
{
	public $nombre;
    public $apellido;
    public $clave;
    public $mail;
    public $ID;
    public $fecha_de_registro;
    public $localidad;
    public $foto;

	function __construct($nombre = null,$apellido=null, $clave, $mail,$foto=null,$localidad=null,$fecha_de_registro=null, $pathFotoBkp=null,$marcaDeAgua=false)
	{
		$this->nombre = $nombre;
		$this->apellido = $apellido;

		$this->clave = $clave;
		$this->mail = $mail;
		$this->localidad = $localidad;
		$this->fecha_de_registro=self::ObtenerFecha();
		if($foto!=null)
		{guardarFoto($foto, $nombre,$pathFotoBkp,$marcaDeAgua);
		$dic = "./Fotos/";
		$nameImagen = $foto["archivo"]["name"];
	
		$explode = explode(".", $nameImagen);
		$tamaño = count($explode);
	
		$dic .= $nombre;
		$dic .= ".";
		$dic .= $explode[$tamaño - 1];
		$this->foto=base64_encode_image($dic);}
	}
	static function ObtenerFecha()
	{
			return date("Y-m-d");
	}
	//anda
	function InsertarUsuarioSQL()
	{	
		$UsuarioController=new UsuarioController();
		$UsuarioController->nombre= $this->nombre;
		$UsuarioController->apellido= $this->apellido ;
		$UsuarioController->clave= $this->clave ;
		$UsuarioController->mail = $this->mail ;
		$UsuarioController->localidad= $this->localidad ;
		$UsuarioController->foto= $this->foto ;

		$UsuarioController->fecha_de_registro= $this->fecha_de_registro; 
		try{
			$this->id=	$UsuarioController->InsertarUsuarioParametros();
				return "Insertado correctamente";
		}
		 catch(PDOException $ex)
		 {
			 return "No puso insertarse";
		 }
	}
	static function MostrarLista($UsuariosArray)
	{
		$strRet = "<ul>";

		for ($i = 0; $i < count($UsuariosArray); $i++) {
			
			$imgSrc = "data:image/jpeg;base64,".$UsuariosArray[$i]->foto;		
			$strRet .= "<li>" . "Nombre: " . $UsuariosArray[$i]->nombre . ", Apellido: " . $UsuariosArray[$i]->apellido . ", Localidad: " . $UsuariosArray[$i]->localidad . ", Clave: " . $UsuariosArray[$i]->clave . ", Email: " . $UsuariosArray[$i]->mail . ", foto: "."<img src='".$imgSrc."' alt="."'Foto Usuario'"." width="."'100'"." height="."'70'".">"."</li>";
		}
		$strRet .=  "</ul>";
		return $strRet;
	}
	static function ValidarUsuario($Array, $login)
    {
        $retorno = false;
        
        foreach ($Array as $x => $val) {          
            if ( $val->mail ==  $login->mail) {
                if ($val->clave == $login->clave) {
                    $retorno = "<br>Verificado";
                    break;
                } else {
                    $retorno = "Error en los datos <br>";
                    break;
                }
            } else {
                $retorno = "Usuario no registrado <br>";
            }
        }
    
        return $retorno;
    }
	static function ExisteUsuario($arrayUsuario, $usuarioID)
    {
        foreach ($arrayUsuario as $x => $val) {
            if ($val->ID ==  $usuarioID ) {
                return true;
            }
        }
        return false;
    }
	static function MostrarUsuariosSql()
	{
		$arrayUsuarios=UsuarioController::TraerTodoLosUsuarios();
		return self::MostrarLista($arrayUsuarios);
	}
	 function ValidarUsuarioSQL()
	{
		$retorno='';
		$usuario=UsuarioController::TraerUnUsuarioMail($this->mail);
		//var_dump($usuario);
		if(isset($usuario) && $usuario)
		{		
			if($usuario->clave== $this->clave)
			{
				$retorno = "<br>Verificado";
			}
			else{
				$retorno ="Error en los datos <br>" ;
			}
		}
		else{
			$retorno= "Usuario no registrado <br>";
		}
		return $retorno;
	}
	static function ExisteUsuarioSQL($idUsuario)
	{
		$UsuarioObtenido=UsuarioController::TraerUnUsuario($idUsuario);
		if(isset($UsuarioObtenido) && $UsuarioObtenido)
		{
			return true;
		}
		return false;
	}

	public function ModificarUsuarioSQL($claveNueva)
	{
		//var_dump($this);
		$Usuario= UsuarioController::TraerUnUsuarioPorMail($this->mail);
		var_dump($Usuario);
		//echo $Usuario->ID;
		if(isset($Usuario) && $Usuario && $Usuario->clave==$this->clave)
		{
			$UsuarioController = new UsuarioController();
			$UsuarioController->ID= $Usuario->ID;	
			
			$retorno=$UsuarioController->ModificarClaveUsuario($claveNueva);
			if($retorno==1)
			{
				return "Modificado correctamente";
			}
			else {
				return "no se pudo modificar";
			}
		}
		else{
			return "Datos incorrectos, no se pudo modificar.";
		}
		
		
	}
}



?>