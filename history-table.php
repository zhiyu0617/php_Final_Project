<head>
    <?php
        require "head.php";
    ?>
</head>
<body>
<nav>
<?php
 $connection = new mysqli(HOSTNAME, USERNAME, PASSWORD, DATABASE);

$query = "SELECT scoreTime, id, fName, lName, result, livesUsed FROM history ORDER BY scoreTime DESC"; 
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
$connection->close(); ?>
</nav>
</body>
<footer>
    <?php
        require "footer.php";
    ?>
</footer>
