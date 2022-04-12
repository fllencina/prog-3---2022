<?php
echo "hola mundo";
switch($_SERVER['REQUEST_METHOD'])
{
    case 'GET':
    echo "peticion por get";
    break;
    case 'POST':
    echo "peticion por post";
    break;
}

?>
