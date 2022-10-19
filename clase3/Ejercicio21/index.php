<!-- Aplicación No 21 ( Listado CSV y array de usuarios)
Archivo: listado.php
método:GET
Recibe qué listado va a retornar(ej:usuarios,productos,vehículos,...etc),por ahora solo tenemos
usuarios).
En el caso de usuarios carga los datos del archivo usuarios.csv.
se deben cargar los datos en un array de usuarios.
Retorna los datos que contiene ese array en una lista
<ul>
<li>Coffee</li>
<li>Tea</li>
<li>Milk</li>
</ul>
Hacer los métodos necesarios en la clase usuario
Lencina Fernanda -->
<?php

require_once "insertUsuarios.php";
require_once "ManejadorArchivos.php";


switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $path = "./Usuarios.csv";
        // InsertarUsuario($path);
        $arrayUsuarios = Leercsv($path);
        echo Usuario::MostrarLista($arrayUsuarios);
        break;
    case 'POST':
        echo "<br>peticion por post";
        break;
}


?>