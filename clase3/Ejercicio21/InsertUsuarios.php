<?php
    require_once "Usuario.php";

    function InsertarUsuario($path)
    {
        $arrayUsuarios=[];
        $Usuario1=new Usuario("juan","123","juan@mail.com");
        $Usuario2=new Usuario("pedro","456","pedro@mail.com");
        $Usuario3=new Usuario("jose","789","jose@mail.com");
        $Usuario4=new Usuario("ana","147","ana@mail.com");
        $Usuario5=new Usuario("maria","258","maria@mail.com");

        array_push($arrayUsuarios, $Usuario1);
        array_push($arrayUsuarios, $Usuario2);
        array_push($arrayUsuarios, $Usuario3);
        array_push($arrayUsuarios, $Usuario4);
        array_push($arrayUsuarios, $Usuario5);
        
        Usuario::Guardarcsv($path,$arrayUsuarios);
        return $arrayUsuarios;
    }
?>