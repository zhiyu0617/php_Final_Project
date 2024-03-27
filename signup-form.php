<?php
// Start the session to access session variables for error messages or pre-filled data
session_start();
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
        <form id="form1" method="post" action="signup.php">
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
                    <td><button type="button" onclick="window.location.href='signin-form.php';">Login</button></td>
                </tr>
            </table>
        </form>
    </div>
</body>

</html>
