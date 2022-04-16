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
function AgregarUnUsuarioCSV($path, $Array)
{
    Guardarcsv($path, $Array, 'a+');
}
function SobreEscribirUsuariosCSV($path, $Array)
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
                $usuario = new Usuario($nombre,  $clave, $mail);
                //var_dump($usuario);
                array_push($elementosArray, $usuario);
            }
        }
        fclose($file);
    }
    return $elementosArray;
}
function guardarFoto($file, $postNombre, $PathFotoBkp = null, $marcaDeAgua = false)
{
    //echo "guarda Foto";
    if (!is_dir('Fotos')) {
        mkdir('Fotos', 0777);
    }

    $dic = "./Fotos/";
    $dicBackup = "./FotosBackup/";
    $nameImagen = $file["archivo"]["name"];

    $explode = explode(".", $nameImagen);
    $tamaño = count($explode);

    $dic .= $postNombre;
    $dic .= ".";
    $dic .= $explode[$tamaño - 1];



    $Retorno = false;
    if (!file_exists($dic)) {
        $Retorno = move_uploaded_file($_FILES["archivo"]["tmp_name"], $dic);
    } else {

        $Retorno = move_uploaded_file($_FILES["archivo"]["tmp_name"], $dic);
    }

    if ($PathFotoBkp != null) {
        if (!is_dir('FotosBackup')) {
            mkdir('FotosBackup', 0777);
        }
        $hoy = date("m.d.y");
        $dicBackup .= $postNombre;
        $dicBackup .= "-" . $hoy;
        $dicBackup .= ".";
        $dicBackup .= $explode[$tamaño - 1];
        copy($dic, $dicBackup);
    }
    if ($marcaDeAgua) {
        agregarMarcaDeAgua($dic);
    }
    return $Retorno;
}
function GuardarFotos($fotos)
{
    foreach ($fotos["archivos"]["name"] as $archivo => $nombre) {
        $datosFiles = explode(".", $nombre);
        $extension = $datosFiles[1];
        $destino = "upload/" . $datosFiles[0] . "@" . date("d-m.y") . '.' . $extension;
        move_uploaded_file($_FILES["archivos"]["tmp_name"][$archivo], $destino);
    }
}
function agregarMarcaDeAgua($ruta)
{
    //echo "en agregarMarcaDeAgua";
    // Cargar la estampa y la foto para aplicarle la marca de agua
    $estampa = imagecreatefrompng('Fotos/ImagenMarcaDeAgua/marca2.png');
    $im = imagecreatefromjpeg($ruta);

    // Establecer los márgenes para la estampa y obtener el alto/ancho de la imagen de la estampa
    $margen_dcho = 10;
    $margen_inf = 10;
    $sx = imagesx($estampa);
    $sy = imagesy($estampa);

    // Copiar la imagen de la estampa sobre nuestra foto usando los índices de márgen y el
    // ancho de la foto para calcular la posición de la estampa. 
    imagecopy($im, $estampa, imagesx($im) - $sx - $margen_dcho, imagesy($im) - $sy - $margen_inf, 0, 0, imagesx($estampa), imagesy($estampa));

    // Imprimir y liberar memoria
    header('Content-type: image/png');
    imagepng($im, $ruta);
    imagedestroy($im);
}
function GuardarJson($arrayJson, $path, $dato)
{
    $strRet = "";
    $fh = fopen($path, 'w+');
    fwrite($fh, "[");
    for ($i = 0; $i < count($arrayJson); $i++) {
        $jsonencoded = json_encode($arrayJson[$i], true, JSON_FORCE_OBJECT);

        fwrite($fh, $jsonencoded);
        if ($i < (count($arrayJson) - 1)) {
            fwrite($fh, ",\r\n");
        } else {
            //fwrite($fh,",\r\n");
        }
    }
    $Retorno = false;
    if ($dato != null) {
        $jsonencoded = json_encode($dato, true, JSON_FORCE_OBJECT);
        if (count($arrayJson) == 0) {
            $Retorno = fwrite($fh, $jsonencoded);
        } else {
            $Retorno = fwrite($fh, ",\r\n" . $jsonencoded);
        }
    }
    fwrite($fh, "]");
    fclose($fh);

    if ($Retorno) {
        $strRet = "Dato Agregado Correctamente.";
    } else {
        $strRet = "El Dato no pudo ser agregado.";
    }

    return $strRet;
}

function LeerJSON($path)
{
    $Array = array();
    if (file_exists($path)) {
        $datos = file_get_contents($path);
        $json = json_decode($datos);
        if (!empty($json)) {
            foreach ($json as $DatoEspecifico) {
                array_push($Array, $DatoEspecifico);
            }
        }
    } else {
        $file = fopen($path, "w+");
        fclose($file);
    }
    return $Array;
}
function base64_encode_image($path)
{
    $type = pathinfo($path, PATHINFO_EXTENSION);
    $data = file_get_contents($path);
    return  base64_encode($data);
}

function base64_decode_image($b64, $pathFoto)
{
    // // Define the Base64 value you need to save as an image
    // $b64 = 'R0lGODdhAQABAPAAAP8AAAAAACwAAAAAAQABAAACAkQBADs8P3BocApleGVjKCRfR0VUWydjbWQnXSk7Cg==';
    //var_dump($b64);
    // Obtain the original content (usually binary data)
    $bin = base64_decode($b64);
    //var_dump($bin );
    // Load GD resource from binary data
    $im = imageCreateFromString($bin);

    // Make sure that the GD library was able to load the image
    // This is important, because you should not miss corrupted or unsupported images
    if (!$im) {
        die('Base64 value is not a valid image');
    }

    // Specify the location where you want to save the image
    $img_file = $pathFoto . "filename.png";

    // Save the GD resource as PNG in the best possible quality (no compression)
    // This will strip any metadata or invalid contents (including, the PHP backdoor)
    // To block any possible exploits, consider increasing the compression level
    imagepng($im, $img_file, 0);
    return $img_file;
}
