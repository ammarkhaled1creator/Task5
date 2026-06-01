<?php
$host = "localhost";
$database= "task5";
$user="root";
$pass= "";
try{
    $connection = new PDO ("mysql:host=$host;dbname=$database",$user,$pass);
    $connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }
catch(PDOException $err){
        echo "connection Failed".$err->getMessage();
}