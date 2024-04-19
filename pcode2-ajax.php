<?php
session_start();  // Ensure session start at the top to handle sessions properly

if (isset($_POST['password']) && isset($_SESSION['password'])) {
    $password = $_SESSION['password'];
    $confirm_password = $_POST['password'];  // 'password' field will carry the confirm password

    // Perform validation
    if ($confirm_password !== $password) {
        echo "Confirmed password doesn't match your password.";
    } else {
        echo "Valid!";
    }
} else {
    echo "Error: Password not set or session expired.";
}



