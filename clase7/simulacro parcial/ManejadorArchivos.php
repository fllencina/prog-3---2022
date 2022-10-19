<?php

 function GuardarJson($arrayJson, $path, $dato = null)
{
    
    $strRet = "";
    $fh = fopen($path, 'w+');
    fwrite($fh, "[");
    for ($i = 0; $i < count($arrayJson); $i++) {
        $jsonencoded = json_encode($arrayJson[$i], true, JSON_FORCE_OBJECT);

        fwrite($fh, $jsonencoded);
        if ($i < (count($arrayJson) - 1)) {
            fwrite($fh, ",\r\n");
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

   

    return $Retorno;
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

 function  ObtieneID()
    {
        if (!file_exists("ID.txt")) {
            $file = fopen("ID.txt", "w+");
            fwrite($file, 0);
            fclose($file);
        }

        $file = fopen("ID.txt", "r");
        $id = fgets($file);
        fclose($file);
        $file = fopen("ID.txt", "w");
        fwrite($file, $id + 1);
        fclose($file);
        return $id + 1;
    }
    function GuardarFoto($file, $Nombre, $pathImagen)
    {
        if (!is_dir($pathImagen)) {
            mkdir($pathImagen, 0777);
        }
        $dic = $pathImagen;
        $nameImagen = $file["archivo"]["name"];
        //echo $nameImagen;
        $explode = explode(".", $nameImagen);
        $tamaño = count($explode);
        $dic .= $Nombre;
        $dic .= ".";
        $dic .= $explode[$tamaño - 1];
        //echo $dic;
        $Retorno = false;
        $Retorno = move_uploaded_file($_FILES["archivo"]["tmp_name"], $dic);
        return $Retorno;
    }


?>
