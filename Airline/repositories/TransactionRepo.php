<?php

function GetTransactionsRepo($connection)
{
    $stmt = $connection->prepare("
        SELECT *
        FROM TransactionTable
        ORDER BY TransactionDate DESC
    ");

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function AddTransactionRepo(
    $connection,
    $type,
    $amount,
    $description,
    $airlineId
)
{
    try
    {
        $connection->beginTransaction();

        $stmt = $connection->prepare("
            INSERT INTO TransactionTable
            (
                TransactionType,
                Amount,
                Description,
                TransactionDate,
                AirlineID
            )
            VALUES
            (
                ?,?,?,NOW(),?
            )
        ");

        $stmt->execute([
            $type,
            $amount,
            $description,
            $airlineId
        ]);

        if($type == "Sell")
        {
            $sql = "
            UPDATE Airline
            SET CurrentBalance =
            CurrentBalance + ?
            WHERE AirlineID = ?";
        }
        else
        {
            $sql = "
            UPDATE Airline
            SET CurrentBalance =
            CurrentBalance - ?
            WHERE AirlineID = ?";
        }

        $update = $connection->prepare($sql);

        $update->execute([
            $amount,
            $airlineId
        ]);

        $connection->commit();

        return true;
    }
    catch(Exception $e)
    {
        $connection->rollBack();
        return false;
    }
}

function TransactionSummaryRepo($connection)
{
    $stmt = $connection->prepare("
        SELECT
            TransactionType,
            COUNT(*) AS TotalTransactions,
            SUM(Amount) AS TotalAmount
        FROM TransactionTable
        GROUP BY TransactionType
    ");

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}