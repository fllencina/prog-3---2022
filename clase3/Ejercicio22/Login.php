<?php

class Login
{
    public $clave;
    public $mail;

    function __construct($mail, $clave)
    {
        $this->clave = $clave;
        $this->mail = $mail;
    }
   
}
