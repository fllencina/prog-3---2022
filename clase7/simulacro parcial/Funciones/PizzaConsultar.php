<?php

require_once "Pizza.php";
$path = "Pizzas.json";
$arrayPizza = Pizza::LeerJSON($path);
if (isset($_POST["sabor"], $_POST["tipo"])) {
    $sabor = $_POST["sabor"];
    $tipo = $_POST["tipo"];


    if ($tipo == "molde" || $tipo == "piedra") {

        echo Pizza::ExistePizzaDetalle($arrayPizza, $sabor,$tipo);
          

    } else {
        echo "Datos incorrectos";
    }
} else {
    echo "no recibe datos";
}

?>