<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: index.php"); // Redirect to the login page
    exit;
}

// Update the last activity time
$_SESSION['last_activity'] = time();

// Handle sign-out
if (isset($_GET['action']) && $_GET['action'] === 'sign-out') {
    session_unset();
    session_destroy();
    header("Location: index.php"); // Redirect to the login page
    exit;
}
?>
    
<?php

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    echo 'timeout';
    exit;
}

// Check if 15 minutes have passed since the last activity
if (time() - $_SESSION['last_activity'] > 900) {
    // Destroy the session
    session_unset();
    session_destroy();
    echo 'timeout';
} else {
    // Update the last activity time
    $_SESSION['last_activity'] = time();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Game</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
    <p>This is the game page.</p>
    <a href="?action=sign-out">Sign Out</a>

    <script>
        $(document).ready(function() {
            // Auto-logout functionality
            setInterval(function() {
                // Send AJAX request to check_activity.php
                $.ajax({
                    type: 'POST',
                    url: 'check_activity.php',
                    success: function(response) {
                        if (response === 'timeout') {
                            // Save game session and redirect to the login page
                            saveGameSession();
                            window.location.href = 'index.php';
                        }
                    }
                });
            }, 900000); // Check every 15 minutes (900000 milliseconds)

            function saveGameSession() {
                // Code to save the game session in the database
                // ...
            }
        });
    </script>
</body>
</html>
