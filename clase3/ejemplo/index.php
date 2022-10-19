<?php
echo "hola mundo";
switch($_SERVER['REQUEST_METHOD'])
{
    case 'GET':
    echo "<br>peticion por get<br>";
    echo "<br>" .$_GET['nombreusuario'] . ' - ' . $_GET['rol'];
    echo "<br>". json_encode($_GET,true);
    break;
    case 'POST':
    echo "<br>peticion por post";
    break;
}

?>
