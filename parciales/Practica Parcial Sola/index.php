<?php

$method = $_SERVER['REQUEST_METHOD'];


switch ($method) {
    case 'GET':
        switch (key($_GET)) {
            case 'Cargar':
                include 'PizzaCarga.php';
                break;
            }
        break;
    case 'POST':
        switch (key($_GET)) {
            case 'Consultas':
                include 'PizzaConsultar.php';
                break;
            case 'Venta':
                include 'AltaVenta.php';
                break;
            case 'ConsultasVentas':
                include 'ConsultasVentas.php';
                break;
            case 'Cargar':
                include 'PizzaCarga.php';
                break;
            }
        break;
    case 'PUT':
        include 'ModificarVenta.php';
        break;
    case 'DELETE':
        include 'BorrarVenta.php';
        break;
}


?>