<!-- 
Aplicación No 18 (Auto - Garage)
Crear la clase Garage que posea como atributos privados:

_razonSocial (String)
_precioPorHora (Double)
_autos (Autos[], reutilizar la clase Auto del ejercicio anterior)

Realizar un constructor capaz de poder instanciar objetos pasándole como parámetros:

i. La razón social.
ii. La razón social, y el precio por hora.

Realizar un método de instancia llamado “MostrarGarage”, que no recibirá parámetros y
que mostrará todos los atributos del objeto.
Crear el método de instancia “Equals” que permita comparar al objeto de tipo Garaje con un
objeto de tipo Auto. Sólo devolverá TRUE si el auto está en el garaje.
Crear el método de instancia “Add” para que permita sumar un objeto “Auto” al “Garage”
(sólo si el auto no está en el garaje, de lo contrario informarlo).
Ejemplo: $miGarage->Add($autoUno);
Crear el método de instancia “Remove” para que permita quitar un objeto “Auto” del
“Garage” (sólo si el auto está en el garaje, de lo contrario informarlo).
Ejemplo: $miGarage->Remove($autoUno);
En testGarage.php, crear autos y un garage. Probar el buen funcionamiento de todos los
métodos.
Lencina Fernanda -->

<?php

require_once "Garage.php";
 
require_once "Auto.php";


$pathGarage1="C:\\xampp2\htdocs\\2022\clase3\Ejercicio20\garage1.csv";
$pathGarage2="C:\\xampp2\htdocs\\2022\clase3\Ejercicio20\garage2.csv";

function CrearAutosInsertarEnGarage($garage,$path)
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


$resultadoPruebas='Resultado de las pruebas <br>';
	$Garage=new Garage("Empresa_A");
	$Garage2=new Garage("Empresa_B",200);
	
    $resultadoPruebas=$resultadoPruebas."Ingresar autos en Garage <br>";
    $resultadoPruebas=$resultadoPruebas. CrearAutosInsertarEnGarage($Garage,$pathGarage1)."<br>";

    $resultadoPruebas=$resultadoPruebas. CrearAutosInsertarEnGarage($Garage2,$pathGarage2);

	 $resultadoPruebas=$resultadoPruebas. "<div style=display:inline-block;margin-top:50px><br>Control: Autos creados: <br>";

     $resultadoPruebas=$resultadoPruebas. "________________________<br></div>";
	
     $resultadoPruebas=$resultadoPruebas. "<br>Garage : <br>". $Garage->MostrarGarage() . "<br>";
	
     $resultadoPruebas=$resultadoPruebas. " ".$Garage2->MostrarGarage();


     $resultadoPruebas=$resultadoPruebas."<br><br> Ingresar Auto <br>";

	 $auto6 = new Auto("Ford","Blanco");
    
     $resultadoPruebas=$resultadoPruebas. $Garage->Add($auto6);
	
     $resultadoPruebas=$resultadoPruebas."<br><br> Eliminar auto de garage <br>";
     
     $auto1 = new Auto("Ford","Blanco",123456);
     $resultadoPruebas=$resultadoPruebas. $Garage->Remove($auto1)."<br>";
	
     $resultadoPruebas=$resultadoPruebas."<br> Como queda garage luego de la eliminacion<br>";
     $resultadoPruebas=$resultadoPruebas. $Garage->MostrarGarage();
	

    echo $resultadoPruebas;
    

?>