<?php

require_once __DIR__ . "/../repositories/RouteRepo.php";
require_once __DIR__ . "/../helper/response.php";

function GetRoutes($connection)
{
    $result = GetAllRoutesRepo($connection);

    response(200,"Success",$result);
}

function AddRoute($connection)
{
    $data = json_decode(file_get_contents("php://input"),true);

    if(
        empty($data["Origin"]) ||
        empty($data["Destination"]) ||
        empty($data["Distance"]) ||
        empty($data["Classification"])
    )
    {
        response(422,"Missing Required Fields");
    }

    $result = AddRouteRepo(
        $connection,
        $data["Origin"],
        $data["Destination"],
        $data["Distance"],
        $data["Classification"]
    );

    $result
        ? response(200,"Route Added")
        : response(500,"Failed");
}

function AssignRoute($connection)
{
    $data = json_decode(file_get_contents("php://input"),true);

    if(
        empty($data["AircraftID"]) ||
        empty($data["RouteID"])
    )
    {
        response(422,"Missing Required Fields");
    }

    $result = AssignRouteRepo(
        $connection,
        $data["AircraftID"],
        $data["RouteID"],
        $data["DepartureDateTime"],
        $data["ArrivalDateTime"],
        $data["NumberOfPassengers"],
        $data["TicketPrice"]
    );

    $result
        ? response(200,"Assigned Successfully")
        : response(500,"Failed");
}