<?php

if (isset($_POST['firstName'])) {
    $firstName = $_POST['firstName'];
    // Check if the firstName contains only letters
    if (preg_match("/^[a-zA-Z]+$/", $firstName)) {
        echo "Valid!"; // Return plain text response
    } else {
        echo "First Name must contain only letters."; // Return error message as plain text
    }
} else {
    echo "First Name is required."; // Return error message as plain text
}
?>
