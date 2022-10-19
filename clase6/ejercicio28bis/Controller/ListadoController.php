<?php

if(isset($_GET['tipoListado']))
{
    $tipoListado=$_GET['tipoListado'];
    switch($tipoListado)
    {
        case 'Usuarios':
            require_once 'Usuario.php';
           echo Usuario::MostrarUsuariosSql();
            break;
            case 'Productos':
                break;
                case 'Ventas':
                    break;
    }
}
else{
 echo "no es posible mostrar listado, falta parametro";
}

?>