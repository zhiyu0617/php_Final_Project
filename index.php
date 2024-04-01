<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION['username'])) {
    header("Location: game.php"); // Redirect to the game page
    exit;
}

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

    // Prepare and execute the SQL statement
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verify the password
        if (password_verify($password, $row['password'])) {
            // Start a new session and store the username
            $_SESSION['username'] = $row['username'];
            header("Location: game.php"); // Redirect to the game page
            exit;
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
    <title>Login Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        .container {
            width: 300px;
            margin: 100px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .error {
            color: red;
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <?php if (isset($error)) echo "<p>$error</p><p><a href='forgot_password.php'>Forgot your password? Change it.</a></p>"; ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="<?php echo isset($_POST['username']) ? $_POST['username'] : ''; ?>" required>
            <br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <br>
            <input type="submit" name="login" value="Login">
            <input type="submit" name="register" value="Register" formaction="signup-form.php">
        </form>
    </div>
</body>
</html>
