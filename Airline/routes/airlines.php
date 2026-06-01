<?php

require __DIR__ . "/../connection.php";
require_once __DIR__ . "/../controllers/AirlineController.php";

$method = $_SERVER["REQUEST_METHOD"];

if($method=="GET" && isset($_GET["id"]))
{
    GetAirlineById($connection);
}
elseif($method=="GET" && isset($_GET["name"]))
{
    GetAirlineByName($connection);
}
elseif($method=="GET")
{
    GetAirlines($connection);
}
elseif($method=="POST")
{
    AddAirline($connection);
}
elseif($method=="PATCH")
{
    UpdateAirline($connection);
}
elseif($method=="DELETE")
{
    DeleteAirline($connection);
}