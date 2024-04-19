<?php
// Start the session to access session variables for error messages or pre-filled data
//session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Registration Form</title>
</head>
<style>
    /* Overall body styling */
body {
  font-family: Arial, sans-serif;
  background-color: #f4f4f4;
  margin: 0;
  padding: 20px;
  color: #333;
}

/* Container for the form, to align and style it */
.container {
  background-color: #ffffff;
  padding: 20px;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  max-width: 500px;
  margin: 20px auto;
}

/* Styling the form itself */
form {
  margin: 0;
}

/* Styling for each table row */
table {
  width: 100%;
  border-collapse: collapse;
}

th,
td {
  padding: 10px;
  text-align: left;
}

/* Labels */
label {
  display: block;
  margin-bottom: 5px;
}

/* Input fields styling */
input[type="text"],
input[type="password"] {
  width: calc(100% - 22px);
  padding: 10px;
  margin-bottom: 20px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

/* Button styling */
input[type="submit"] {
  cursor: pointer;
  width: auto;
  padding: 10px 20px;
  border: none;
  border-radius: 4px;
  background-color: #007bff;
  color: white;
  transition: background-color 0.3s;
}

input[type="submit"]:hover {
  background-color: #0056b3;
}

/* Highlight the first button (Register) to indicate primary action */
#submit1 {
  background-color: #28a745;
}

#submit1:hover {
  background-color: #218838;
}

/* Login button styling */
button {
  cursor: pointer;
  padding: 10px 20px;
  border: none;
  border-radius: 4px;
  background-color: #007bff;
  color: white;
  transition: background-color 0.3s;
}

button:hover {
  background-color: #0056b3;
}

</style>

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
                    <td><button type="button" onclick="window.location.href='index.php';">Login</button></td>
                </tr>
            </table>
        </form>
    </div>
</body>

</html>
