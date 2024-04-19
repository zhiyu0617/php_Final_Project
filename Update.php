<?php
require 'Database.php';

function updatePassword($username, $newPassword) {
    $connection = connectToDB();
    // Check if username exists and get registrationOrder
    $userStmt = $connection->prepare("SELECT registrationOrder FROM player WHERE userName = ?");
    $userStmt->bindParam(1, $username);
    $userStmt->execute();
    
    if ($userStmt->rowCount() == 0) {
        return ["Username does not exist."];
    } else {
        $registrationOrder = $userStmt->fetch(PDO::FETCH_ASSOC)['registrationOrder'];
        // Update password
        $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $updateStmt = $connection->prepare("UPDATE authenticator SET passCode = ? WHERE registrationOrder = ?");
        $updateStmt->bindParam(1, $hashedNewPassword);
        $updateStmt->bindParam(2, $registrationOrder);
        $updateStmt->execute();

        if ($updateStmt->rowCount() > 0) {
            return ["success" => "Password successfully changed."];
        } else {
            return ["An error occurred while updating the password, please try again."];
        }
    }
}
?>
