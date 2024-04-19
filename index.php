<?php
// Check if the user is logged in
if (isset($_SESSION['username'])) {
    header("Location: index.php"); // Redirect to the game page
    exit;
}
session_start();
// Handle the login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Replace with your actual database credentials
    $servername = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "kidsGames";

    // Create connection
    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute the SQL statement to get registrationOrder
    $stmt = $conn->prepare("SELECT registrationOrder FROM player WHERE userName = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $registrationOrder = $row['registrationOrder'];

        // Now, get the password using registrationOrder
        $stmt = $conn->prepare("SELECT passCode FROM authenticator WHERE registrationOrder = ?");
        $stmt->bind_param("i", $registrationOrder);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Verify the password
            if (password_verify($password, $row['passCode'])) {
                // Start a new session and store the username
                session_start();
                $_SESSION['username'] = $username;
                $_SESSION['registrationOrder'] = $registrationOrder;
                $_SESSION['last_activity'] = time(); // Initialize last activity time
                header("Location: index_game.php"); // Redirect to the game page
                exit;
            } else {
                $error = "Sorry, the username or password is incorrect!";
            }
        } else {
            $error = "Sorry, the username or password is incorrect!";
        }
    } else {
        $error = "Sorry, the username or password is incorrect!";
    }

    $stmt->close();
    $conn->close();


}
?>


<!DOCTYPE html>
<html>
<head>
<head >
    <?php require 'head.php'; ?>
    </head>
    <title>Login Form</title>
    <link rel="stylesheet" type="text/css" href="public/assets/css/index_style.css">   
</head>
<header>
    <?php
        require 'header.php';
    ?>
</header>
<body class="signin_body">
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
    </script>
<div class="signin_container">
    <h1>Login</h1>
    <?php 
    if (isset($_SESSION['success_message'])) {
        echo "<p class='success'>" . $_SESSION['success_message'] . "</p>";
        unset($_SESSION['success_message']);
    }
    if (isset($_SESSION['logout_message'])) {
        echo "<p class='success'>" . $_SESSION['logout_message'] . "</p>";
        unset($_SESSION['logout_message']);
    }
    if (isset($error)) echo "<p class='error'>$error</p><p><a href='change_password.php'>Forgot your password? Change it.</a></p>"; ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password">
        <br>
        <input type="submit" name="login" value="Login">
        <input type="submit" name="action" value="Register" formaction="signup-form.php">
    </form>
</div>

</body>
<footer>
    <?php
        require 'footer.php'; 
    ?>
</footer>