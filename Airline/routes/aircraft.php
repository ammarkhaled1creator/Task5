<?php

require __DIR__ . "/../connection.php";
require_once __DIR__ . "/../controllers/AircraftController.php";

$method = $_SERVER["REQUEST_METHOD"];

if($method=="GET")
{
    GetAircrafts($connection);
}
elseif($method=="POST")
{
    AddAircraft($connection);
}