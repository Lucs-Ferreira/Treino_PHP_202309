<?php

    //  error_reporting(0);
    //  ini_set("display_errors", 0); 
     
include_once "Config.php";

try {
    if ($conexao = new mysqli(BD_SERVIDOR, BD_USUARIO, BD_SENHA, BD_BANCO))
    {
        //do something
    }
    else
    {
        throw new Exception("<script> alert('ERRO DE CONEXAO AO BANCO DE DADOS')</script>");
    }
} catch(Exception $e)
{
    echo $e->getMessage(); 
}
