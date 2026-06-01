<?php

require_once __DIR__ . "/../repositories/TransactionRepo.php";
require_once __DIR__ . "/../helper/response.php";

function GetTransactions($connection)
{
    $result = GetTransactionsRepo($connection);

    response(200,"Success",$result);
}

function AddTransaction($connection)
{
    $data = json_decode(file_get_contents("php://input"),true);

    if(
        empty($data["TransactionType"]) ||
        empty($data["Amount"]) ||
        empty($data["AirlineID"])
    )
    {
        response(422,"Missing Required Fields");
    }

    $result = AddTransactionRepo(
        $connection,
        $data["TransactionType"],
        $data["Amount"],
        $data["Description"] ?? "",
        $data["AirlineID"]
    );

    $result
        ? response(200,"Transaction Added")
        : response(500,"Transaction Failed");
}

function TransactionSummaryController($connection)
{
    $result = TransactionSummaryRepo($connection);

    response(200,"Summary",$result);
}