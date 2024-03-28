<?php
session_start();

// Database connection parameters
define('HOSTNAME', 'localhost');
define('USERNAME', 'root');
define('PASSWORD', ''); 
define('DATABASE', 'kidsGames'); 

// Attempt database connection
$connection = new mysqli(HOSTNAME, USERNAME, PASSWORD, DATABASE);
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$error_messages = [];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $fname = trim($_POST['fname']);
    $lname = trim($_POST['lname']);

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
    } else {
        // Check for unique username
        $stmt = $connection->prepare("SELECT userName FROM player WHERE userName = ?");
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
        // Start transaction
        $connection->begin_transaction();
        try {
            // Insert into player table
            $insertPlayerStmt = $connection->prepare("INSERT INTO player (fName, lName, userName, registrationTime) VALUES (?, ?, ?, NOW())");
            $insertPlayerStmt->bind_param("sss", $fname, $lname, $username);
            $insertPlayerStmt->execute();
            $insertPlayerStmt->close();

            // Get the last inserted registrationOrder
            $registrationOrder = $connection->insert_id;

            // Insert into authenticator table
            $insertAuthenticatorStmt = $connection->prepare("INSERT INTO authenticator (passCode, registrationOrder) VALUES (?, ?)");
            $insertAuthenticatorStmt->bind_param("si", $hashedPassword, $registrationOrder);
            $insertAuthenticatorStmt->execute();
            $insertAuthenticatorStmt->close();

            // Commit transaction
            $connection->commit();

            $_SESSION['success_message'] = "Account created successfully. Please log in.";
            header("Location: signin-form.php");
            exit;
        } catch (Exception $e) {
            // Rollback transaction if something goes wrong
            $connection->rollback();
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
}

$connection->close();
?>
