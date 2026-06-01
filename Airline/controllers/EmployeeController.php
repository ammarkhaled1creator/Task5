<?php

require_once __DIR__ . "/../repositories/EmployeeRepo.php";
require_once __DIR__ . "/../helper/response.php";

function SearchEmployee($connection)
{
    $name = $_GET["name"] ?? "";

    $result = GetEmployeeByNameRepo(
        $connection,
        $name
    );

    response(
        200,
        "Success",
        $result
    );
}

function AddEmployee($connection)
{
    $data = json_decode(
        file_get_contents("php://input"),
        true
    );

    if(
        empty($data["Name"]) ||
        empty($data["BirthDate"]) ||
        empty($data["Gender"]) ||
        empty($data["Position"]) ||
        empty($data["AirlineID"])
    )
    {
        response(
            422,
            "Missing Required Fields"
        );
    }

    $result = AddEmployeeRepo(
        $connection,
        $data["Name"],
        $data["BirthDate"],
        $data["Gender"],
        $data["Position"],
        $data["AirlineID"]
    );

    if($result)
    {
        response(
            200,
            "Employee Added"
        );
    }

    response(
        500,
        "Failed"
    );
}