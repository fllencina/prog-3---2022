<!-- 
Aplicación No 27 (Registro BD)
Archivo: registro.php
método:POST
Recibe los datos del usuario( nombre,apellido, clave,mail,localidad )por POST ,
crear un objeto con la fecha de registro y utilizar sus métodos para poder hacer el alta,
guardando los datos la base de datos
retorna si se pudo agregar o no.
Lencina Fernanda 
-->
<?php



switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET': 
        break;
    case 'POST':
        require_once 'controller/UsuarioController.php';
        break;
}

?>
