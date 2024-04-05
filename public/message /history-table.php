<?php
require_once 'config.php'; 

$query = "SELECT scoreTime, id, fName, lName, result, livesUsed FROM history"; 
$result = $connection->query($query);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>Date</th><th>Player ID</th><th>First Name</th><th>Last Name</th><th>Result</th><th>Lives Used</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . htmlspecialchars($row['scoreTime']) . "</td>
                <td>" . htmlspecialchars($row['id']) . "</td>
                <td>" . htmlspecialchars($row['fName']) . "</td>
                <td>" . htmlspecialchars($row['lName']) . "</td>
                <td>" . htmlspecialchars($row['result']) . "</td>
                <td>" . htmlspecialchars($row['livesUsed']) . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p>No history available.</p>";
}

$result->close();
$connection->close(); 
