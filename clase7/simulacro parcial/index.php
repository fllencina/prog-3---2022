<!-- PARTE 2 Lencina Fernanda -->

<?php

$verbo = $_SERVER['REQUEST_METHOD'];
switch ($verbo) {
    case "GET":

                include_once "Funciones/PizzaCarga.php";

        break;
    case "POST":
        
                switch (key($_GET)) {
                        case 'Consultas':
                                include 'Funciones/PizzaConsultar.php';
                                break;
                        case 'Venta':
                                include 'Funciones/AltaVenta.php"';
                                break;
                        case 'ConsultasVentas':
                                include 'Funciones/ConsultasVentas.php';
                                break;
                        case 'Cargar':
                                include 'Funciones/PizzaCarga.php';
                                break;
                        }
        break;
}


?>