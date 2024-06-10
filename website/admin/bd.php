<?php
$servidor="localhost";
$baseDeDatos="website";
$usuarios="root";
$contrasenia="";
try{
    $conexion=new PDO("mysql:host=$servidor;dbname=$baseDeDatos",$usuarios,$contrasenia);
    
}catch(exception $error){
    echo $error->getMessage();
}
?>