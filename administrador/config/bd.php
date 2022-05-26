<?php

$host="localhost";
$db="riveraco1";
$usuario="root";
$pass="admin";

try {
    $conexion=new PDO("mysql:host =$host;dbname=$db",$usuario,$pass);
    if($conexion){echo "";}
    $conexion->exec("SET CHARACTER SET utf8");
} catch (Exception $ex) {
    echo $ex->getMessage();
}
    //throw $th;    ?>