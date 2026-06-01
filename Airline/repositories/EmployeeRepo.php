<?php

function GetEmployeeByNameRepo($connection,$name)
{
    $stmt = $connection->prepare("
        SELECT *
        FROM Employee
        WHERE Name LIKE ?
    ");

    $stmt->execute(["%$name%"]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function AddEmployeeRepo(
    $connection,
    $name,
    $birthDate,
    $gender,
    $position,
    $airlineId
)
{
    $stmt = $connection->prepare("
        INSERT INTO Employee
        (
            Name,
            BirthDate,
            Gender,
            Position,
            AirlineID
        )
        VALUES
        (
            ?,?,?,?,?
        )
    ");

    $stmt->execute([
        $name,
        $birthDate,
        $gender,
        $position,
        $airlineId
    ]);

    return $stmt->rowCount() > 0;
}