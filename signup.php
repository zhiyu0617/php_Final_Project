<?php
session_start();

// Database connection parameters
define('HOSTNAME', 'localhost');
define('USERNAME', 'root');
define('PASSWORD', '');
define('DATABASE', '3-database-entity.sql');

// Attempt database connection
$connection = new mysqli(HOSTNAME, USERNAME, PASSWORD, DATABASE);
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$error_messages = [];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
    $username = filter_var(trim($_POST['username']), FILTER_SANITIZE_STRING);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $fname = filter_var(trim($_POST['fname']), FILTER_SANITIZE_STRING);
    $lname = filter_var(trim($_POST['lname']), FILTER_SANITIZE_STRING);

    // Validate input fields
    if (empty($username) || empty($password) || empty($confirm_password) || empty($fname) || empty($lname)) {
        $error_messages[] = "All fields are required.";
    } elseif (!preg_match("/^[a-zA-Z]/", $username) || !preg_match("/^[a-zA-Z]/", $fname) || !preg_match("/^[a-zA-Z]/", $lname)) {
        $error_messages[] = "First Name, Last Name, and Username must begin with a letter.";
    } elseif (strlen($username) < 8 || strlen($password) < 8) {
        $error_messages[] = "Username and Password must contain at least 8 characters.";
    } elseif ($password !== $confirm_password) {
        $error_messages[] = "Passwords do not match.";
    } else {
        // Check for unique username
        $stmt = $connection->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $error_messages[] = "Username already exists.";
        }
        $stmt->close();
    }

    // Insert user into database if no errors
    if (empty($error_messages)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $insertStmt = $connection->prepare("INSERT INTO users (username, password, fname, lname) VALUES (?, ?, ?, ?)");
        $insertStmt->bind_param("ssss", $username, $hashedPassword, $fname, $lname);
        if ($insertStmt->execute()) {
            $_SESSION['success_message'] = "Account created successfully. Please log in.";
            header("Location: signin-form.php"); // Redirect to home or login page 
            exit;
        } else {
            $error_messages[] = "An error occurred. Please try again.";
        }
        $insertStmt->close();
    }

    // If errors exist, keep form data and errors in session
    if (!empty($error_messages)) {
        $_SESSION['error_messages'] = $error_messages;
        $_SESSION['form_data'] = ['username' => $username, 'fname' => $fname, 'lname' => $lname];
        header("Location: signup-form.php");
        exit;
    }
}

$connection->close();
?>
