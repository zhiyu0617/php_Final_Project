<?php
require 'Database.php';

$connection = connectToDB();

function checkUsernameExists($connection, $username) {
    $stmt = $connection->prepare("SELECT userName FROM player WHERE userName = ?");
    $stmt->bindParam(1, $username);  // PDO uses bindParam with positional placeholders.
    $stmt->execute();
    $exists = $stmt->rowCount() > 0;  // Use rowCount to check how many rows were returned.
    $stmt->closeCursor();
    return $exists;
}

function insertNewUser($connection, $fname, $lname, $username, $hashedPassword) {
    // Start transaction
    $connection->beginTransaction();
    try {
        // Insert into player table
        $insertPlayerStmt = $connection->prepare("INSERT INTO player (fName, lName, userName, registrationTime) VALUES (?, ?, ?, NOW())");
        $insertPlayerStmt->bindParam(1, $fname);
        $insertPlayerStmt->bindParam(2, $lname);
        $insertPlayerStmt->bindParam(3, $username);
        $insertPlayerStmt->execute();
        $insertPlayerStmt->closeCursor();

        // Get the last inserted registrationOrder
        $registrationOrder = $connection->lastInsertId();

        // Insert into authenticator table
        $insertAuthenticatorStmt = $connection->prepare("INSERT INTO authenticator (passCode, registrationOrder) VALUES (?, ?)");
        $insertAuthenticatorStmt->bindParam(1, $hashedPassword);
        $insertAuthenticatorStmt->bindParam(2, $registrationOrder);
        $insertAuthenticatorStmt->execute();
        $insertAuthenticatorStmt->closeCursor();

        // Commit transaction
        $connection->commit();
        return true;
    } catch (Exception $e) {
        // Rollback transaction if something goes wrong
        $connection->rollBack();
        return false;
    }
}
?>