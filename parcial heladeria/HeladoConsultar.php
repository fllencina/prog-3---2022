<?php

require_once "Helado.php";
$path = "Helados.json";
$array = Helado::LeerJSON($path);
if (isset($_POST["sabor"], $_POST["tipo"])) {
    $sabor = $_POST["sabor"];
    $tipo = $_POST["tipo"];
//var_dump($_POST);

    if ($tipo == "agua" || $tipo == "crema") {
        
        switch(Helado::ExisteHeladoDetalle($array, $sabor,$tipo))
        {
            case 0: 
                echo "No hay Helado registrado";
                break;
            case 1:
                echo "Si hay Helado";

                break;
            case -1:
                echo "No exite el sabor";

                break;
            case -2:
                echo "No existe el tipo";

            break;

        }
          

    } else {
        echo "Datos incorrectos";
    }
} else {
    echo "no recibe datos";
}

?>