<?php

require __DIR__ . "/../connection.php";
require_once __DIR__ . "/../controllers/EmployeeController.php";

$method = $_SERVER["REQUEST_METHOD"];

if($method=="GET")
{
    SearchEmployee($connection);
}
elseif($method=="POST")
{
    AddEmployee($connection);
}