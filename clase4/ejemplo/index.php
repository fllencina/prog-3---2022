<?php


var_dump($_FILES);

foreach($_FILES["archivos"]["name"] as $archivo=>$nombre){
    $datosFiles=explode(".",$nombre);
    $extension=$datosFiles[1];
    $destino="upload/".$datosFiles[0]."@".date("d-m.y").'.' .$extension;
    move_uploaded_file($_FILES["archivos"]["tmp_name"][$archivo], $destino);
}






    // $string= explode('.',$_FILES["archivo"]["name"]);
    
    // $string[0].date("d-m.y").'.' .$string[1];
    // $destino = "upload/" . $string;
    // if (!is_file($destino)) {
        
    //     move_uploaded_file($_FILES["archivo"]["tmp_name"], $destino);

    // } else {
    //     move_uploaded_file($_FILES["archivo"]["tmp_name"], $destino);
    // }



//si la carpeta no existe entonces falla porque no encuentra la ruta
//sobreescribe? si sobreescribe validar primero si hay doc con mismo nombre para evitar pisar





//si no existe la carpeta la crea, y da permisos

// if (!is_dir('archivos')) {
//     mkdir('archivos', 0777);
// }
