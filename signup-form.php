<?php
session_start();

// Check for error messages
if (isset($_SESSION['error_messages'])) {
    foreach ($_SESSION['error_messages'] as $message) {
        echo '<p class="error">' . htmlspecialchars($message) . '</p>';
    }
    // Clear error messages from session to avoid re-display on reload
    unset($_SESSION['error_messages']);
}

// Check for previously submitted data
$submitted_data = isset($_SESSION['submitted_data']) ? $_SESSION['submitted_data'] : [];

// Pre-populate form fields with previously submitted data if available
$username = isset($submitted_data['username']) ? $submitted_data['username'] : '';
$fname = isset($submitted_data['fname']) ? $submitted_data['fname'] : '';
$lname = isset($submitted_data['lname']) ? $submitted_data['lname'] : '';

// For security reasons, do not pre-populate password and confirm password fields
$password = '';
$confirm_password = '';
?>



<!DOCTYPE html>
<html>

<head>
    <title>Registration Form</title>
    <link rel="stylesheet" href="style.css">
    <script type="text/javascript" src=".\public\assets\js\fname-ajax.js"></script>
    <script type="text/javascript" src=".\public\assets\js\lname-ajax.js"></script>
    <script type="text/javascript" src=".\public\assets\js\pcode1-ajax.js"></script>
    <script type="text/javascript" src=".\public\assets\js\pcode2-ajax.js"></script>
    <script type="text/javascript" src=".\public\assets\js\uname-ajax.js"></script>

</head>
<header>
    <?php
     require "header.php";
    ?>
</header>
<body>
    <div>
        <form id="form1" method="post" action="signup.php">
            <table>
            <tr>
                 <th><label for="input1">Username</label></th>
                    <td>
                        <input id="input1" type="text" name="username" value="<?php echo htmlspecialchars($username); ?>" onkeyup="validateUsername()" required>
                    <div id="username-error"></div>
                    </td>
                    </tr>
                <tr>
                    <th><label for="password">Password</label></th>
                    <td>
                    <input id="password" type="password" name="password" oninput="check()" onkeyup="validatePass()" required>
                    <span id="password-error"></span>

                    </td>
                </tr>
                <tr>
                    <th><label for="input3">Confirm Password</label></th>
                    <td>
                        <input id="input3" type="password" name="confirm_password" oninput="check()" onkeyup="validatePass2()" required>
                        <span id="confirmpassword-error"></span>
                    </td>
                </tr>
                <tr>
                    <th><label for="input4">First Name</label></th>
                    <td>
                    <input id="input4" type="text" name="firstName" value="<?php echo htmlspecialchars($fname); ?>" onkeyup="validateFirstName()" required>
                    <div id="firstNameMessage"></div>

                    </td>
                </tr>
                <tr>
                    <th><label for="input5">Last Name</label></th>
                    <td>
                    <input id="input5" type="text" name="lastName" value="<?php echo htmlspecialchars($lname); ?>" onkeyup="validateLName()" required>
                    <div id="lastname-error"></div>

                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><input id="submit1" type="submit" name="action" value="Register" /></td>
                </tr>
                <tr>
                    <td></td>
                    <td><button type="button" onclick="window.location.href='index.php';">Login</button></td>
                </tr>
            </table>
        </form>
    </div>
</body>
<footer>
    <?php require 'footer.php'; ?>
</footer>

</html>