







<?php
require_once "Venta.php";


//var_dump($_GET);
if (isset($_GET["mail"]))
{
    $fecha=$_GET["fecha"];
    
    echo  "-a- La cantidad de Helados vendidos en un día en particular(se envía por parámetro), si no se pasa fecha, se
    muestran las del día de ayer <br>". Venta::TraerVentasDeUnDia($fecha);
}

// //-b- el listado de ventas de un usuario ingresado

if (isset($_GET["mail"]))
{
    $mail=$_GET["mail"];
    echo "-b- el listado de ventas de un usuario ingresado <br>". Venta::TraerVentasDeUnUsuario($mail);
}

//-c- El listado de ventas entre dos fechas ordenado por nombre.
if (isset($_GET["fechainicio"], $_GET["fechafin"]))
{
    $fechainicio=$_GET["fechainicio"];
    $fechafin=$_GET["fechafin"];
    echo "-c- El listado de ventas entre dos fechas ordenado por nombre. <br>". Venta::ObtenerVentasPorRango($fechainicio,$fechafin);
}
//-d- el listado de ventas de un sabor ingresado
if (isset($_GET["sabor"]))
{
    $sabor=$_GET["sabor"];
    echo "d- el listado de ventas de un sabor ingresado <br>".Venta::TraerVentasDeUnSabor($sabor);
}
?>