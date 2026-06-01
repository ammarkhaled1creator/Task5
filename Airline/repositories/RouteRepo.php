<?php

function GetAllRoutesRepo($connection)
{
    $stmt = $connection->prepare("
        SELECT *
        FROM Route
    ");

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function AddRouteRepo(
    $connection,
    $origin,
    $destination,
    $distance,
    $classification
)
{
    $stmt = $connection->prepare("
        INSERT INTO Route
        (
            Origin,
            Destination,
            Distance,
            Classification
        )
        VALUES
        (
            ?,?,?,?
        )
    ");

    $stmt->execute([
        $origin,
        $destination,
        $distance,
        $classification
    ]);

    return $stmt->rowCount() > 0;
}

function AssignRouteRepo(
    $connection,
    $aircraftId,
    $routeId,
    $departure,
    $arrival,
    $passengers,
    $ticketPrice
)
{
    $stmt = $connection->prepare("
        INSERT INTO Aircraft_Route
        (
            AircraftID,
            RouteID,
            DepartureDateTime,
            ArrivalDateTime,
            NumberOfPassengers,
            TicketPrice
        )
        VALUES
        (
            ?,?,?,?,?,?
        )
    ");

    $stmt->execute([
        $aircraftId,
        $routeId,
        $departure,
        $arrival,
        $passengers,
        $ticketPrice
    ]);

    return $stmt->rowCount() > 0;
}