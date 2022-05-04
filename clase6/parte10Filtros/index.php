<!-- Funciones de filtrado:
se deben realizar la funciones que reciban datos por parámetros y puedan
ejecutar la consulta para responder a los siguientes requerimientos

A. Obtener los detalles completos de todos los usuarios y poder ordenarlos
alfabéticamente de forma ascendente o descendente.
B. Obtener los detalles completos de todos los productos y poder ordenarlos
alfabéticamente de forma ascendente y descendente.
C. Obtener todas las compras filtradas entre dos cantidades.
D. Obtener la cantidad total de todos los productos vendidos entre dos fechas.
E. Mostrar los primeros “N” números de productos que se han enviado.
F. Mostrar los nombres del usuario y los nombres de los productos de cada venta.
G. Indicar el monto (cantidad * precio) por cada una de las ventas.
H. Obtener la cantidad total de un producto (ejemplo:1003) vendido por un usuario
(ejemplo: 104).
I. Obtener todos los números de los productos vendidos por algún usuario filtrado por
localidad (ejemplo: ‘Avellaneda’).
J. Obtener los datos completos de los usuarios filtrando por letras en su nombre o
apellido.
K. Mostrar las ventas entre dos fechas del año.

Lencina Fernanda -->




<?php
require_once "Usuario.php";
require_once "Producto.php";
 require_once "RealizarVenta.php";


switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
    //    echo "A. Obtener los detalles completos de todos los usuarios y poder ordenarlos
    //    alfabéticamente de forma ascendente o descendente.<br><br> " . Usuario::MostrarUsuariosSql("DESC");

//      echo  "<br> B. Obtener los detalles completos de todos los productos y poder ordenarlos
// alfabéticamente de forma ascendente y descendente. <br><br> " .Producto::MostrarProductosSQL("DESC");

// $min=6;
// $max=10;
// echo "<br> C. Obtener todas las compras filtradas entre dos cantidades. <br><br>" . RealizarVenta::MostrarVentas($min,$max);


        break;
    case 'POST':
       
        break;
}



?>