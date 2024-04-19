<?php
require 'Database.php';

//CREATE THE DATABASE STRUCTURE IF IT DOESN'T EXIST YET
try {
    $connection = connectToDB();
    $connection->exec(file_get_contents("3-database-entity.sql"));
    echo "The database, tables, and view structures were successfully created.";
    unset($connection);
} catch (PDOException $error) {
    die("Creation of Database and Tables failed! <br>" . $error->getMessage());
}
?>
