<?php


// Check if the user is logged in


// if (!isset($_SESSION['username'])) {
            
//     exit;
// }

// // Check if 15 minutes have passed since the last activity
// if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 900)) {
//     // Destroy the session
//     session_unset();
//     session_destroy();
//     echo 'timeout';
// } else {
//     // Update the last activity time
//     $_SESSION['last_activity'] = time();
// }
            // Set a logout message
            session_destroy(); // Optionally, fully destroy the session
            session_start();
            $_SESSION['logout_message'] = "You have successfully logged out.";
            header("Location: index.php"); // Redirect to the home or login page