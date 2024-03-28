<?php
session_start(); // Start session to access session variables and store error messages

// Define variables to store input field values and error messages
$username = $password = $confirm_password = $fname = $lname = "";
$error_messages = [];

// If form is submitted, perform field validation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
    
    // Get form data
$username = isset($_POST['username']) ? trim($_POST['username']) : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$confirm_password = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';
$fname = isset($_POST['fname']) ? trim($_POST['fname']) : '';
$lname = isset($_POST['lname']) ? trim($_POST['lname']) : '';



    // Perform field validation
    if ($username === "" || !isset($username)) {
    $error_messages['username'] = "Username is required";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
    $error_messages['username'] = "Username can only contain letters, numbers, and underscores";
    } elseif (strlen($username) < 8) {
    $error_messages['username'] = "Username must be at least 8 characters long";
    }

    if (empty($password)) {
    $error_messages['password'] = "Password is required";
    } elseif (strlen($password) < 8) {
    $error_messages['password'] = "Password must be at least 8 characters long";
    }

    if (empty($confirm_password)) {
    $error_messages['confirm_password'] = "Confirm Password is required";
    } elseif ($password !== $confirm_password) {
    $error_messages['confirm_password'] = "Passwords do not match";
    }

    if (empty($fname)) {
    $error_messages['fname'] = "First name is required";
    } elseif (!ctype_alpha(str_replace(' ', '', $fname))) {
    $error_messages['fname'] = "First name can only contain letters";
    }

    if (empty($lname)) {
    $error_messages['lname'] = "Last name is required";
    } elseif (!ctype_alpha(str_replace(' ', '', $lname))) {
    $error_messages['lname'] = "Last name can only contain letters";
    }




    // If there are errors, store error messages in session
    if (!empty($error_messages)) {
        $_SESSION['error_messages'] = $error_messages;
        $_SESSION['form_data'] = ['username' => $username, 'fname' => $fname, 'lname' => $lname];
        header("Location: signup-form.php");
        exit;
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Registration Form</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h1 class="blueText">Registration Form</h1>
        <hr>
        <!-- Display error messages if any -->
        <?php if (!empty($_SESSION['error_messages'])): ?>
            <div class="errors">
                <?php foreach ($_SESSION['error_messages'] as $message): ?>
                    <p><?php echo htmlspecialchars($message); ?></p>
                <?php endforeach; ?>
            </div>
        <?php 
            // Clear error messages after displaying
            unset($_SESSION['error_messages']);
            endif; 
        ?>
        
        <!--Form-->
        <form id="form1" method="post" action="signup-form.php">
            <table>
                <tr>
                    <th><label for="input1">Username</label></th>
                    <td><input id="input1" type="text" name="username" value="<?php echo isset($_SESSION['form_data']['username']) ? htmlspecialchars($_SESSION['form_data']['username']) : ''; ?>" required></td>
                </tr>
                <tr>
                    <th><label for="input2">Password</label></th>
                    <td><input id="input2" type="password" name="password" required></td>
                </tr>
                <tr>
                    <th><label for="input3">Confirm Password</label></th>
                    <td><input id="input3" type="password" name="confirm_password" required></td>
                </tr>
                <tr>
                    <th><label for="input4">First Name</label></th>
                    <td><input id="input4" type="text" name="fname" value="<?php echo isset($_SESSION['form_data']['fname']) ? htmlspecialchars($_SESSION['form_data']['fname']) : ''; ?>" required></td>
                </tr>
                <tr>
                    <th><label for="input5">Last Name</label></th>
                    <td><input id="input5" type="text" name="lname" value="<?php echo isset($_SESSION['form_data']['lname']) ? htmlspecialchars($_SESSION['form_data']['lname']) : ''; ?>" required></td>
                </tr>

                <tr>
                    <td></td>
                    <td><input id="submit1" type="submit" name="action" value="Register" /></td>
                </tr>
                <tr>
                    <td></td>
                    <td><button type="button" onclick="window.location.href='signup.php';">Login</button></td>
                </tr>
            </table>
        </form>
    </div>
</body>

</html>
