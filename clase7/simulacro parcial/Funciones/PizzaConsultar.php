<?php

require_once "./Parte1/Pizza.php";
require_once "ManejadorArchivos.php";
$path="./Parte1/Pizzas.json";
$arrayPizza = LeerJSON($path);
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