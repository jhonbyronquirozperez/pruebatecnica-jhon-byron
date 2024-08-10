<?php

### Concexión BD  con PDO ###
$host="localhost:33065";
$bd="crud_app";
$usuario="root";
$contraseña="";

try{
        $conexion = new PDO("mysql:host=$host;dbname=$bd",$usuario,$contraseña);
        
}catch(Exception  $ex){

    echo $ex -> getMessage();
}

?>