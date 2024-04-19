<?php
session_start();
require_once 'Insert.php';

$error_messages = [];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
    $connection = connectToDB();
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $fname = trim($_POST['firstName']);
    $lname = trim($_POST['lastName']);

    // Validate input fields
    if (empty($username) || empty($password) || empty($confirm_password) || empty($fname) || empty($lname)) {
        $error_messages[] = "All fields are required.";
    } elseif (!ctype_alpha(str_replace(' ', '', $fname)) || !ctype_alpha(str_replace(' ', '', $lname))) {
        $error_messages[] = "First Name and Last Name must contain only letters.";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
        $error_messages[] = "Username must contain only alphanumeric characters and underscores.";
    } elseif (strlen($username) < 8 || strlen($password) < 8) {
        $error_messages[] = "Username and Password must contain at least 8 characters.";
    } elseif ($password !== $confirm_password) {
        $error_messages[] = "Passwords do not match.";
    } elseif (checkUsernameExists($connection, $username)) {
        $error_messages[] = "Username already exists.";
    }

    if (empty($error_messages)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        if (insertNewUser($connection, $fname, $lname, $username, $hashedPassword)) {
            $_SESSION['success_message'] = "Account created successfully. Please log in.";
            header("Location: index.php");
            exit;
        } else {
            $error_messages[] = "An error occurred. Please try again.";
        }
    }

    // If errors exist, keep form data and errors in session
    if (!empty($error_messages)) {
        $_SESSION['error_messages'] = $error_messages;
        $_SESSION['form_data'] = ['username' => $username, 'fname' => $fname, 'lname' => $lname];
        header("Location: signup-form.php");
        exit;
    }

    $connection->close();
}
?>
