<?php
require 'database.php';

$connection = connectToDB();

// Insert record
try {
    $sqlCode = "INSERT INTO player (fName, lName, userName, registrationTime)
                VALUES (:fName, :lName, :userName, NOW())";
    $stmt = $connection->prepare($sqlCode);
    $stmt->execute([
        ':fName' => 'Patrick',
        ':lName' => 'Saint-Louis',
        ':userName' => 'sonic12345'
    ]);
    echo "A new row was successfully recorded into the table 'player'.<br/>";
    unset($connection);
} catch (PDOException $error) {
    die("Data insertion into the 'player' table failed!<br>" . $error->getMessage());
}
?>

