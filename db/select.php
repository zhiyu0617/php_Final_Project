<?php
require 'database.php';

$connection = connectToDB();

// Select and display
$sqlCode = "SELECT * FROM player";
$selectRecords = $connection->query($sqlCode);

echo "<p>Find below all the rows currently recorded into the table 'player'.</p>";
while ($each_row = $selectRecords->fetch(PDO::FETCH_ASSOC)) {
    echo "<p>" . $each_row['fName'] . " " . $each_row['lName'] . " " . $each_row['userName'] . " " . $each_row['registrationTime'] . "</p>";
}

unset($connection);
?>

