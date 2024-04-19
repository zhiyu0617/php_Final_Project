<?php
session_start();  // Start the session at the top of the script

if (isset($_POST['password'])) {
    $password = $_POST['password'];
    
    // Perform validation
    if (strlen($password) < 8) {
        echo "Must contain at least 8 characters.";
    } else {
        $_SESSION['password'] = $password;// Store the password in session after validation
        echo "Valid!";
          
    }
}
