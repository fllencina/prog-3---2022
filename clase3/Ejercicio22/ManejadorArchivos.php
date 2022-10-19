<?php
 function Guardarcsv($path, $Array, $modoApertura)
{
	$retorno = false;
	$aperturaOK = false;
	switch ($modoApertura) {
		case 'a+':
			$file = fopen($path, "a+");
			$aperturaOK = true;
			break;
		case 'w+':
			$file = fopen($path, "w+");
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
 function AgregarUnElementoCSV($path, $Array)
{
	Guardarcsv($path, $Array, 'a+');
}
 function SobreEscribirCSV($path, $Array)
{
	Guardarcsv($path, $Array, 'w+');
}
 function Leercsv($path)
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
				array_push($elementosArray, $usuario);
			}
		}
		fclose($file);
	}
	return $elementosArray;
}

?>