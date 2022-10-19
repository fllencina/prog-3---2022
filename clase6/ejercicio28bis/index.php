<!-- 
Aplicación No 28 ( Listado BD)
Archivo: listado.php
método:GET
Recibe qué listado va a retornar(ej:usuarios,productos,ventas)
cada objeto o clase tendrán los métodos para responder a la petición
devolviendo un listado <ul> o tabla de html <table>
Lencina Fernanda 
-->
<?php



switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET': 
        require_once 'controller/ListadoController.php';    
        break;
    case 'POST':
        require_once 'controller/UsuarioController.php';
        break;
}

?>
