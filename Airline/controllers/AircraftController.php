<?php

require_once __DIR__ . "/../repositories/AircraftRepo.php";
require_once __DIR__ . "/../helper/response.php";

function GetAircrafts($connection)
{
    $result = GetAllAircraftRepo($connection);

    response(200,"Success",$result);
}

function AddAircraft($connection)
{
    $data = json_decode(file_get_contents("php://input"),true);

    if(
        empty($data["Model"]) ||
        empty($data["Capacity"]) ||
        empty($data["AirlineID"])
    )
    {
        response(422,"Missing Required Fields");
    }

    $result = AddAircraftRepo(
        $connection,
        $data["Model"],
        $data["Capacity"],
        $data["AirlineID"]
    );

    if($result)
    {
        response(200,"Aircraft Added");
    }

    response(500,"Failed");
}