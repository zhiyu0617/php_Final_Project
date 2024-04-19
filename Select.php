<?php
require_once 'Database.php';

function updateGameResult($pdo, $result, $livesUsed, $registrationOrder) {
    $stmt = $pdo->prepare("INSERT INTO score (scoreTime, result, livesUsed, registrationOrder) VALUES (NOW(), ?, ?, ?)");
    $stmt->bindParam(1, $result);
    $stmt->bindParam(2, $livesUsed);
    $stmt->bindParam(3, $registrationOrder);
    $stmt->execute();
}
?>
