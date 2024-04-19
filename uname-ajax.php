<?php

session_start();

define('HOSTNAME', 'localhost');
define('USERNAME', 'root');
define('PASSWORD', ''); 
define('DATABASE', 'kidsGames'); 

$connection = new mysqli(HOSTNAME, USERNAME, PASSWORD, DATABASE);
if (isset($_POST['username'])) {
    $username = $_POST['username'];
    if (!preg_match("/^[a-zA-Z]+$/", $username)) {
        echo "Must start with a letter a-z or A-Z，also can not with number";
    } elseif (strlen($username) < 8) {
        echo "Username must contain at least 8 characters.";
    } else {
        // Check for username uniqueness
        $stmt = $connection->prepare("SELECT userName FROM player WHERE userName = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            echo "Username already exists.";
        } else {
            echo "Valid!";
        }
    }
} else {
    echo "Username is required.";
}

?>
