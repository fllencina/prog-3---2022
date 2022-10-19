<?php

require_once "Auto.php";
//Crear dos objetos “Auto” de la misma marca y distinto color.
function CrearArrayAutos()
{
    $Autos=array();
	
$path="./auto.csv";
$auto = new Auto("Ford","Blanco");
array_push($Autos, $auto);	

$auto = new Auto("Ford","Negro");
array_push($Autos, $auto);	

$auto= new Auto ("Chevrolet","Gris",700000);
array_push($Autos, $auto);	

$auto= new Auto ("Chevrolet","Gris",800000);
array_push($Autos, $auto);	

$auto = new Auto ("Audi","Azul",1000000,date('d/m/Y'));	
array_push($Autos, $auto);	


return  $Autos;
}

function MostrarAutosCreados($Array)
{
    $retorno='';
    $retorno= "<div style=display:inline-block;margin-top:50px>Control: Autos creados: <br>";
for($i=0;$i<count($Array);$i++)
{
    $retorno=$retorno. "<br>________________________<br> Auto ".($i+1).": ";
 $retorno=$retorno.Auto::MostrarAuto($Array[$i]);
}

$retorno=$retorno. "<br>________________________<br></div>";
return $retorno;
}

//Utilizar el método “AgregarImpuesto” en los últimos tres objetos, agregando $ 1500 al atributo precio.
function SumarImpuestosYMostrar($Array, $impuestos)
{
    $retorno='';
    $retorno= "<div style=display:inline-block;vertical-align:top;margin-left:50px;margin-top:50px>Autos precio con impuestos: <br> ";


for($i=2;$i<count($Array);$i++)
{
    $retorno=$retorno. "<br>________________________<br> Auto ".($i+1).": ";
    $retorno=$retorno. Auto::MostrarAuto($Array[$i]);
$autoPrecioImpuesto=$Array[$i]->AgregarImpustos($impuestos);
$retorno=$retorno. "<br> Precio con impuesto: $" .$autoPrecioImpuesto;
}
$retorno=$retorno. "<br>________________________<br></div>";
return $retorno;

}

function CompararAutos($Array)
{
    
//Comparar el primer “Auto” con el segundo y quinto objeto e informar si son iguales o no.
$retorno='';
$retorno= "<br><br>";
    $strComparacion1='';
    $strComparacion2='';
    if($Array[0]->Equals($Array[1]))
    {
    $strComparacion1="<br>Los autos comparados son iguales";
    }
    else{
    $strComparacion1="<br>Los autos comparados no son iguales";
    }
    if($Array[0]->Equals($Array[4]))
    {
    $strComparacion2="<br>Los autos comparados son iguales";
    }
    else{
    $strComparacion2="<br>Los autos comparados no son iguales";
    }
    $retorno=$retorno. "<br> Comparacion entre el 1er y 2do auto: ". $strComparacion1 ;
    $retorno=$retorno. "<br><br>";
    $retorno=$retorno. "<br> Comparacion entre el 1er y 5to auto: ". $strComparacion2 . "</div>";


   

    // for($i=0;$i<count($Array);$i++)
    // {
    //     if(($i+1)%2!=0)
    //     {
    //         $retorno=$retorno. "<br>________________________<br> Auto ".($i+1).": ";
    //         $retorno=$retorno. Auto::MostrarAuto($Array[$i]);
    //     }
    return $retorno;
    //}
}

function MostrarAutosImpares($Array)
{
    $retorno='';
    $retorno=$retorno. "<div style=display:inline-block;vertical-align:top;margin-left:50px;margin-top:50px> Autos Impares <br> ";
    for($i=0;$i<count($Array);$i++)
    {
        if(($i+1)%2!=0)
        {          
            $retorno=$retorno. "<br>________________________<br> Auto ".($i+1).": ";
            $retorno=$retorno. Auto::MostrarAuto($Array[$i]);
        }
    
    }
    return $retorno;
}

?>


