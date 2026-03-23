<?php
class conexion{
    public function Conectar ()
    {
$server="localhost";
$user="root";
$password="";
$database="soa";
try
{
$conn=new PDO("mysql:host=$server;dbname=$database;",$user,$password); //BD  se trabaja con PDO con respecto a los servicios
 //echo("ok se conecto");
}
catch (Exception $e)
{
    die("fallo necexion".$e->getMessage());
}
return $conn;
    }
}
?>