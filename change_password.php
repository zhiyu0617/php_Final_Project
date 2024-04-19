<?php
session_start();
require 'Update.php';

$error_messages = [];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['changePassword'])) {
    $username = trim($_POST['username']);
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    if (empty($newPassword) || empty($confirmPassword)) {
        $error_messages[] = "All password fields are required.";
    } elseif ($newPassword !== $confirmPassword) {
        $error_messages[] = "New password and confirm password do not match.";
    } elseif (strlen($newPassword) < 8) {
        $error_messages[] = "New password must contain at least 8 characters.";
    } else {
        $updateResult = updatePassword($username, $newPassword);
        if (array_key_exists("success", $updateResult)) {
            $_SESSION['success_message'] = $updateResult["success"];
            header("Location: index.php");
            exit;
        } else {
            $error_messages = $updateResult;
        }
    }

    if (!empty($error_messages)) {
        $_SESSION['error_messages'] = $error_messages;
        $_SESSION['form_data'] = $_POST;
        header("Location: change_password.php");
        exit;
    } else {
        unset($_SESSION['form_data']);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Change Password</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        form { max-width: 300px; margin: auto; }
        label { display: block; margin-bottom: 5px; }
        input[type="text"], input[type="password"] { width: 100%; padding: 8px; margin-bottom: 20px; border: 1px solid #ccc; border-radius: 4px; }
        input[type="submit"], button { padding: 10px 15px; background-color: green; color: white; border: none; border-radius: 4px; cursor: pointer; }
        button { background-color: green; }
        button:hover { background-color: #45a049; }
        input[type="submit"]:hover { background-color: #45a049; }
    </style>
</head>
<body>
<?php if (!empty($_SESSION['error_messages'])): ?>
<div style="background-color: #ffcccc; padding: 10px; margin-bottom: 15px; border-radius: 5px;">
    <?php 
    foreach ($_SESSION['error_messages'] as $message): ?>
        <p><?php echo htmlspecialchars($message); ?></p>
    <?php endforeach; ?>
</div>
<?php 
unset($_SESSION['error_messages']); 
?>
<?php endif; ?>

<form method="post">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" value="<?php echo isset($_SESSION['form_data']['username']) ? htmlspecialchars($_SESSION['form_data']['username']) : ''; ?>" required><br>
    
    <label for="newPassword">New Password:</label>
    <input type="password" id="newPassword" name="newPassword" required><br>

    <label for="confirmPassword">Confirm New Password:</label>
    <input type="password" id="confirmPassword" name="confirmPassword" required><br>
    
    <input type="submit" name="changePassword" value="Change Password">
    <button type="button" onclick="window.location='index.php';">Login</button>
</form>

</body>
</html>
