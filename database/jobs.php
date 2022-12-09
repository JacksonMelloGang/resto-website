<?php
require_once "model\authentification.inc.php";

function addFailedJobsIntoTable($connection, $queue, $payload, $exception){
    $sql = "INSERT INTO failed_jobs (connection, queue, payload, exception) VALUES (:connection, :queue, :payload, :exception)";
    
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':connection', $connection);
    $stmt->bindParam(':queue', $queue);
    $stmt->bindParam(':payload', $payload);
    $stmt->bindParam(':exception', $exception);
    $result = $stmt->execute();

    return $result;
}
    