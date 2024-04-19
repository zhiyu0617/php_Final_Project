<?php
// Assuming this code is in lname-ajax.php
if (isset($_POST['lastName'])) {
    $lastName = $_POST['lastName'];
    // Check if the lastName contains only letters
    if (preg_match("/^[a-zA-Z]+$/", $lastName)) {
        echo "Valid!";
    } else {
        echo "Last Name must contain only letters.";
    }
} else {
    echo "Last Name is required.";
}

