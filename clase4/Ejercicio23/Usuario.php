
<?php

class usuario
{
	public $nombre;
	public $clave;
	public $mail;
	public $foto;
	public $ID;
	public $fecha_de_registro;

	function __construct($nombre=null, $clave, $mail,$foto)
	{
		$this->nombre = $nombre;
		$this->clave = $clave;
		$this->mail = $mail;
		$this->fecha_de_registro=self::ObtenerFecha();
		$this->ID=self::ObtieneIDUsuario();
		
		guardarFoto($foto, $nombre);
	}
	static function ObtenerFecha()
	{
			return date("Y-m-d");
	}
	static function  ObtieneIDUsuario()
		{
			if(!file_exists("UsuarioID.txt")){
				$file=fopen("UsuarioID.txt","w+");
				fwrite($file, 0);
				fclose($file);					
			}

			$file=fopen("UsuarioID.txt","r");
			$idUsuario = fgets($file);
			fclose($file);
			$file=fopen("UsuarioID.txt","w");
			fwrite($file, $idUsuario+1);
			fclose($file);
			return $idUsuario+1;
		}	
	static function MostrarLista($UsuariosArray)
	{
		$strRet = "<ul>";

		for ($i = 0; $i < count($UsuariosArray); $i++) {
			$ruta="Foto/".$UsuariosArray[$i]->nombre.".jpeg";
			//echo $ruta;
			$strRet .= "<li>" . "nombre: " . $UsuariosArray[$i]->nombre . ", clave: " . $UsuariosArray[$i]->clave . ", email: " . $UsuariosArray[$i]->mail . ", foto: "."<img src='".$ruta."' alt="."'Foto Usuario'"." width="."'500'"." height="."'600'".">"."</li>";
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


}



?>