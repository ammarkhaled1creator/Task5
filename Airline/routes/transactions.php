<?php

require __DIR__ . "/../connection.php";
require_once __DIR__ . "/../controllers/TransactionController.php";

$method = $_SERVER["REQUEST_METHOD"];

if($method=="GET" && isset($_GET["summary"]))
{
    TransactionSummaryController($connection);
}
elseif($method=="GET")
{
    GetTransactions($connection);
}
elseif($method=="POST")
{
    AddTransaction($connection);
}