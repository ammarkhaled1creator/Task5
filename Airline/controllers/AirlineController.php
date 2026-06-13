<?php

require_once __DIR__ . "/../repositories/AirlineRepo.php";
require_once __DIR__ . "/../helper/response.php";

function GetAirlines($connection)
{
    $result = GetAllAirlinesRepo($connection);

    response(
        200,
        "Airlines Retrieved Successfully",
        $result
    );
}

function GetAirlineById($connection)
{
    if (!isset($_GET["id"]))
    {
        response(400, "Id Required");
    }

    $airline = GetAirlineByIdRepo(
        $connection,
        $_GET["id"]
    );

    if (!$airline)
    {
        response(404, "Airline Not Found");
    }

    response(
        200,
        "Airline Retrieved",
        $airline
    );
}

function GetAirlineByName($connection)
{
    if (!isset($_GET["name"]))
    {
        response(400, "Name Required");
    }

    $result = GetAirlineByNameRepo(
        $connection,
        $_GET["name"]
    );

    response(
        200,
        "Success",
        $result
    );
}

function AddAirline($connection)
{
    $data = json_decode(
        file_get_contents("php://input"),
        true
    );

    if (
        empty($data["AirlineName"])
    )
    {
        response(
            422,
            "AirlineName Required"
        );
    }

    $result = AddAirlineRepo(
        $connection,
        $data["AirlineName"],
        $data["Address"] ?? null,
        $data["ContactPerson"] ?? null,
        $data["PhoneNumber"] ?? null,
        $data["CurrentBalance"] ?? 0
    );

    if ($result)
    {
        response(
            200,
            "Airline Added Successfully"
        );
    }

    response(
        500,
        "Failed To Add Airline"
    );
}

function UpdateAirline($connection)
{
    $id = $_GET["id"] ?? null;

    if (!$id)
    {
        response(
            400,
            "Id Required"
        );
    }

    $oldAirline = GetAirlineByIdRepo(
        $connection,
        $id
    );

    if (!$oldAirline)
    {
        response(
            404,
            "Airline Not Found"
        );
    }

    $data = json_decode(
        file_get_contents("php://input"),
        true
    );

    $result = UpdateAirlineRepo(
        $connection,
        $id,
        $data["AirlineName"] ?? $oldAirline["AirlineName"],
        $data["Address"] ?? $oldAirline["Address"],
        $data["ContactPerson"] ?? $oldAirline["ContactPerson"],
        $data["PhoneNumber"] ?? $oldAirline["PhoneNumber"],
        $data["CurrentBalance"] ?? $oldAirline["CurrentBalance"]
    );

    if ($result)
    {
        response(
            200,
            "Airline Updated Successfully"
        );
    }

    response(
        500,
        "Failed To Update Airline"
    );
}

function DeleteAirline($connection)
{
    $id = $_GET["id"] ?? null;

    if (!$id)
    {
        response(
            400,
            "Id Required"
        );
    }

    $result = DeleteAirlineRepo(
        $connection,
        $id
    );

    if ($result)
    {
        response(
            200,
            "Airline Deleted Successfully"
        );
    }

    response(
        500,
        "Failed To Delete Airline"
    );
}