<?php

function GetAllAirlinesRepo($connection)
{
    $stmt = $connection->prepare(
        "SELECT * FROM Airline"
    );

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function GetAirlineByIdRepo($connection, $id)
{
    $stmt = $connection->prepare(
        "SELECT * FROM Airline
         WHERE AirlineID = ?"
    );

    $stmt->execute([$id]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function GetAirlineByNameRepo($connection, $name)
{
    $stmt = $connection->prepare(
        "SELECT * FROM Airline
         WHERE AirlineName LIKE ?"
    );

    $stmt->execute(["%$name%"]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function AddAirlineRepo(
    $connection,
    $name,
    $address,
    $contact,
    $phone,
    $balance
)
{
    $stmt = $connection->prepare("
        INSERT INTO Airline
        (
            AirlineName,
            Address,
            ContactPerson,
            PhoneNumber,
            CurrentBalance
        )
        VALUES (?,?,?,?,?)
    ");

    $stmt->execute([
        $name,
        $address,
        $contact,
        $phone,
        $balance
    ]);

    return $stmt->rowCount() > 0;
}

function UpdateAirlineRepo(
    $connection,
    $id,
    $name,
    $address,
    $contact,
    $phone,
    $balance
)
{
    $stmt = $connection->prepare("
        UPDATE Airline
        SET
            AirlineName=?,
            Address=?,
            ContactPerson=?,
            PhoneNumber=?,
            CurrentBalance=?
        WHERE AirlineID=?
    ");

    $stmt->execute([
        $name,
        $address,
        $contact,
        $phone,
        $balance,
        $id
    ]);

    return $stmt->rowCount() > 0;
}

function DeleteAirlineRepo($connection, $id)
{
    $stmt = $connection->prepare(
        "DELETE FROM Airline
         WHERE AirlineID=?"
    );

    $stmt->execute([$id]);

    return $stmt->rowCount() > 0;
}