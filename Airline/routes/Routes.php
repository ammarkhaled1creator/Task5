<?php

require __DIR__ . "/../connection.php";
require_once __DIR__ . "/../controllers/RouteController.php";

$method = $_SERVER["REQUEST_METHOD"];

if($method=="GET")
{
    GetRoutes($connection);
}
elseif($method=="POST" && isset($_GET["assign"]))
{
    AssignRoute($connection);
}
elseif($method=="POST")
{
    AddRoute($connection);
}