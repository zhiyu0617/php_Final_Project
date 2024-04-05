<?php
session_start();

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