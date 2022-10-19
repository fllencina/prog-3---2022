
<?php

class usuario
{
	public $nombre;
	public $clave;
	public $mail;

	function __construct($nombre=null, $clave, $mail)
	{
		$this->nombre = $nombre;
		$this->clave = $clave;
		$this->mail = $mail;
	}
	

	static function MostrarLista($UsuariosArray)
	{
		$strRet = "<ul>";

		for ($i = 0; $i < count($UsuariosArray); $i++) {
			$strRet .= "<li>" . "nombre: " . $UsuariosArray[$i]->nombre . ", email: " . $UsuariosArray[$i]->mail . ", clave: " . $UsuariosArray[$i]->clave . "</li>";
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