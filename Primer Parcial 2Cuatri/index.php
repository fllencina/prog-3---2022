<?php
//Lencina Fernanda
$method = $_SERVER['REQUEST_METHOD'];


switch ($method) {
    case 'GET':
        switch (key($_GET)) {
            case 'ConsultasVentas':
                include 'ConsultasVentas.php';
                break;
        }
        break;

    case 'POST':
        switch (key($_GET)) {
            case 'Cargar':
                include 'HeladeriaAlta.php';
                break;
            case 'Consultas':
                include 'HeladoConsultar.php';
                break;
            case 'Venta':
                include 'AltaVenta.php';
                break;
                case 'DevolverHelado':             
                    include 'DevolverHelado.php';
                    break;
                case 'ConsultasDevoluciones':             
                    include 'ConsultasDevoluciones.php';
                    break;
           
        }
    case 'PUT':
        include 'ModificarVenta.php';
        break;

    case 'DELETE':
        include 'BorrarVenta.php';
        break;
}
