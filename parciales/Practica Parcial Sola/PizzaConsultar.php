<?php

require_once "Pizza.php";
$path = "Pizzas.json";
$arrayPizza = Pizza::LeerJSON($path);
if (isset($_POST["sabor"], $_POST["tipo"])) {
    $sabor = $_POST["sabor"];
    $tipo = $_POST["tipo"];


    if ($tipo == "molde" || $tipo == "piedra") {

        switch(Pizza::ExistePizzaDetalle($arrayPizza, $sabor,$tipo))
        {
            case 0: 
                echo "No hay Pizza registrada";
                break;
            case 1:
                echo "Si hay Pizza";

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