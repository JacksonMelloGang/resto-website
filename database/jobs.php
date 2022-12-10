<?php
require_once "model\bd.inc.php";

function addFailedJobsIntoTable($connection, $queue, $payload, $exception){
    $sql = "INSERT INTO failed_jobs (connection, queue, payload, exception) VALUES (:connection, :queue, :payload, :exception)";
    $cnx = connexionPDO();

    $stmt = $cnx->prepare($sql);
    $stmt->bindParam(':connection',$connection->getAttribute(PDO::ATTR_DRIVER_NAME));
    $stmt->bindParam(':queue', $queue);
    $stmt->bindParam(':payload', $payload);
    $stmt->bindParam(':exception', $exception->getMessage());
    $result = $stmt->execute();

    return $result;
}
    