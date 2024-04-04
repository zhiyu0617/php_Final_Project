<?php
    define('HOSTNAME', 'localhost');
    define('USERNAME', 'root');
    define('PASSWORD', '');
    define('DB_NAME', 'kidsGames');
    
    $connection = new mysqli(HOSTNAME, USERNAME, PASSWORD, DB_NAME);

    if ($connection->connect_error) 
    {
        die("Connection failed: " . $connection->connect_error);
    }

