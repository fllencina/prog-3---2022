
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
	static function Guardarcsv($path, $Array, $modoApertura)
	{
		$retorno = false;
		$aperturaOK = false;
		switch ($modoApertura) {
			case 'a+':
				$file = fopen($path, "a+");
				$aperturaOK = true;
				break;
			case 'w+':
				$file = fopen($path, "a+");
				$aperturaOK = true;
				break;
			default:

				echo "No selecciono modo de apertura valido";
				return $retorno;
				break;
		}
		if ($aperturaOK) {
			for ($i = 0; $i < count($Array); $i++) {
				$linea = array($Array[$i]->nombre, $Array[$i]->clave, $Array[$i]->mail);
				if (fputcsv($file, $linea)) {
					$retorno = true;
				}
			}
			fclose($file);
		}

		return $retorno;
	}
	static function AgregarUnUsuarioCSV($path, $Array)
	{
		self::Guardarcsv($path, $Array, 'a+');
	}
	static function SobreEscribirUsuariosCSV($path, $Array)
	{
		self::Guardarcsv($path, $Array, 'w+');
	}
	static function Leercsv($path)
	{
		$elementosArray = [];

		if (file_exists($path)) {
			$file = fopen($path, "r");

			while (!feof($file)) {
				$linea = fgets($file);
				if (!empty($linea)) {
					$datos = explode(",", $linea);
					$nombre = $datos[0];
					$clave = $datos[1];
					$mail = trim(preg_replace('/\s+/', ' ', $datos[2]));				
					$usuario = new Usuario($nombre,  $clave,$mail);
					//var_dump($usuario);
					array_push($elementosArray, $usuario);
				}
			}
			fclose($file);
		}
		return $elementosArray;
	}

	static function MostrarLista($UsuariosArray)
	{
		$strRet = "<ul>";

		for ($i = 0; $i < count($UsuariosArray); $i++) {
			$strRet .= "<li>" . "nombre: " . $UsuariosArray[$i]->nombre . ", email: " . $UsuariosArray[$i]->clave . ", clave: " . $UsuariosArray[$i]->mail . "</li>";
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