




<?php
require_once "./parte3/Venta.php";
//-a- la cantidad de pizzas vendidas
echo Venta::CantidadPizzasVendidas();

//-b- el listado de ventas entre dos fechas ordenado por sabor.
if (isset($_POST["fechainicio"], $_POST["fechafin"]))
{
    $fechainicio=$_POST["fechainicio"];
    $fechafin=$_POST["fechafin"];
    echo Venta::ObtenerVentasPorRango($fechainicio,$fechafin);
}

//-c- el listado de ventas de un usuario ingresado

if (isset($_POST["mail"]))
{
    $mail=$_POST["mail"];
    echo Venta::TraerVentasDeUnUsuario($mail);
}

//-d- el listado de ventas de un sabor ingresado
if (isset($_POST["sabor"]))
{
    $sabor=$_POST["sabor"];
    echo Venta::TraerVentasDeUnSabor($sabor);
}
?>