
<?php

class usuario
{
	public $nombre;
	public $clave;
	public $mail;

	function __construct($nombre, $clave, $mail)
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
		$strRet .= "</ul>";
		return $strRet;
	}
}



?>