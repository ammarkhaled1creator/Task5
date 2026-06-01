<?php

function GetAllAircraftRepo($connection)
{
    $stmt = $connection->prepare("
        SELECT *
        FROM Aircraft
    ");

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function AddAircraftRepo(
    $connection,
    $model,
    $capacity,
    $airlineId
)
{
    $stmt = $connection->prepare("
        INSERT INTO Aircraft
        (
            Model,
            Capacity,
            AirlineID
        )
        VALUES
        (
            ?,?,?
        )
    ");

    $stmt->execute([
        $model,
        $capacity,
        $airlineId
    ]);

    return $stmt->rowCount() > 0;
}