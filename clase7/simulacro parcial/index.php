<!-- PARTE 1 Lencina Fernanda -->

<?php




$caso = $_SERVER['REQUEST_METHOD'];
switch ($caso) {
    case "GET":
        switch (key($_GET)) {
            case 'cargarpizzaget':
                include_once "Funciones/PizzaCargar.php";
                break;
        }
        break;
    case "POST":
        
               // include_once "Funciones/PizzaConsultar.php";
                include_once "Funciones/AltaVenta.php";
        
        break;
}







?>