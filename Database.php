<?php
//login
define('HOSTNAME', 'localhost');
define('USERNAME', 'root');
define('PASSWORD', '');
define('DATABASE', 'kidsGames');


try {
    $connection = new PDO("mysql:host=".HOSTNAME, USERNAME, PASSWORD);
} catch (PDOException $error) {
    die("Connection to MySQL failed! <br>" . $error);
}

//Create
//2-CREATE THE DATABASE STRUCTURE IF IT DOESN'T EXIST YET
try {
    $connection->exec(file_get_contents("3-database-entity.sql"));
    echo "The database, tables, and view stuctures were successfully created.";
} catch (PDOException $error) {
    die("Creation of Database and Tables failed! <br>" . $error);
}

//3-DISCONNECT FROM THE DATABASE MANAGEMENT SYSTEM (DBMS) MYSQL
try {
    unset($connection);
} catch (PDOException $error) {
    die("Disconnection from MySQL failed!<br/>" . $error);
}


// Insert

try {
    $connection = new PDO("mysql:host=".HOSTNAME.";dbname=".DATABASE, USERNAME, PASSWORD);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully to the database ".DATABASE."<br/>";
} catch (PDOException $error) {
    die("Connection to MySQL failed! <br>" . $error);
}

//check player exist

try {
    $sqlCode = "DESC player";
    $describeTable = $connection->query($sqlCode);
    echo "Table 'player' exists.<br/>";
} catch (PDOException $error) {
    die("Checking the 'player' table failed!<br/>" . $error->getMessage());
}


//Insert record

try {
    $sqlCode = "INSERT INTO player(fName, lName, userName, registrationTime)
                VALUES(:fName, :lName, :userName, NOW())";
    $stmt = $connection->prepare($sqlCode);
    $stmt->execute([
        ':fName' => 'Patrick',
        ':lName' => 'Saint-Louis',
        ':userName' => 'sonic12345'
    ]);
    echo "A new row was successfully recorded into the table 'player'.<br/>";
} catch (PDOException $error) {
    die("Data insertion into the 'player' table failed!<br>" . $error->getMessage());
}

//Disconnect
try{
    unset($connection);
}
catch (PDOException $error) {
    //If the disconnection failed, display error message and stop the script
    die("Disconnection from MySQL failed!<br/>" . $error);
}


//UPDATE 

try {
    $connection = new PDO("mysql:host=".HOSTNAME.";dbname=".DATABASE, USERNAME, PASSWORD);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully to the database " . DATABASE . ".<br/>";
} catch (PDOException $error) {
    die("Connection to MySQL failed! <br>" . $error->getMessage());
}

//Update data
$newFName = 'NewFirstName';
$newLName = 'NewLastName';
$userName = 'sonic12345';

//execute the update statement
try {
    $sqlCode = "UPDATE player SET fName = :newFName, lName = :newLName WHERE userName = :userName";
    $stmt = $connection->prepare($sqlCode);
    $stmt->execute([
        ':newFName' => $newFName,
        ':newLName' => $newLName,
        ':userName' => $userName
    ]);
    // Check if the update was successful
    if ($stmt->rowCount() > 0) {
        echo "The record was successfully updated.<br/>";
    } else {
        echo "No record was updated. This could mean the username does not exist or the new data is the same as the old data.<br/>";
    }
} catch (PDOException $error) {
    die("Error updating record in the 'player' table:<br>" . $error->getMessage());
}

// Disconnect

try {
    unset($connection);
    echo "Disconnected successfully from the database.";
} catch (PDOException $error) {
    die("Disconnection from MySQL failed!<br/>" . $error->getMessage());
}

//Select

try {
    $connection = new PDO("mysql:host=".HOSTNAME.";dbname=".DATABASE, USERNAME, PASSWORD);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully to the database " . DATABASE . ".<br/>";
} catch (PDOException $error) {
    die("Connection to MySQL failed! <br>" . $error->getMessage());
}

//check table exists
try {
    $sqlCode = "DESC player";
    $describeTable = $connection->query($sqlCode);
    echo "Table 'player' exists.<br/>";
} catch (PDOException $error) {
    die("Checking the 'player' table failed!<br/>" . $error->getMessage());
}

//select and display
$sqlCode = "SELECT * FROM player";
$selectRecords = $connection->query($sqlCode);

//calculate the rows 

$number_of_rows = $selectRecords->rowCount();

// Use a loop to display the records one by one in HTML

echo "</p>Find below all the rows currently recorded into the table kidsGames.</p>";
    while ($each_row = $selectRecords->fetch(PDO::FETCH_ASSOC)) {
        // Display each record corresponding to each column
        echo "<p>" . $each_row['fName'] . "</p>";
        echo "<p>" . $each_row['lName'] . "</p>";
        echo "<p>" . $each_row['userName'] . "</p>";
        echo "<p>" . $each_row['registrationTime'] . "</p>";
        echo "<p>" . $each_row['id'] . "</p>";
        echo "<p>" . $each_row['registrationOrder'] . "</p>";
    }

try {
    unset($connection);
    echo "Disconnected successfully from the database.";
} catch (PDOException $error) {
    die("Disconnection from MySQL failed!<br/>" . $error->getMessage());
}

