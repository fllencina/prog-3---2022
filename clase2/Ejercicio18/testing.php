<?php
require_once "garage.php";
require_once "Auto.php";



function CrearAutosInsertarEnGarage($garage)
{
    $retorno='Insertando en garage: '.$garage->MostrarRazonSocial()."<br>";
     $auto = new Auto("Ford","Blanco");
     $retorno=$retorno. $garage->Add($auto)."Auto 1<br>";
        
    $auto2 = new Auto("Ford","Negro");
    $retorno=$retorno. $garage->Add($auto2)."Auto2<br>";

    $auto3= new Auto ("Chevrolet","Gris",700000);
    $retorno=$retorno. $garage->Add($auto3)."Auto3<br>";

     $auto4= new Auto ("Chevrolet","Gris",800000);
     $retorno=$retorno. $garage->Add($auto4)."Auto4<br>";
    
    $auto5 = new Auto ("Audi","Azul",1000000,"31/03/22");			
    $retorno=$retorno. $garage->Add($auto5)."Auto5<br>";
    return $retorno;
}



?>
