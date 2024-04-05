<?php
session_start();
require 'database.php';

$error_messages = [];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['changePassword'])) {
    $connection = connectToDB();
    $username = trim($_POST['username']);
    $oldPassword = $_POST['oldPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    if (empty($oldPassword) || empty($newPassword) || empty($confirmPassword)) {
        $error_messages[] = "All password fields are required.";
    } elseif ($newPassword !== $confirmPassword) {
        $error_messages[] = "New password and confirm password do not match.";
    } elseif (strlen($newPassword) < 8) {
        $error_messages[] = "New password must contain at least 8 characters.";
    } else {
        $userStmt = $connection->prepare("SELECT registrationOrder FROM player WHERE userName = ?");
        $userStmt->bindParam(1, $username);
        $userStmt->execute();

        if ($userStmt->rowCount() == 0) {
            $error_messages[] = "Username does not exist.";
        } else {
            $userInfo = $userStmt->fetch(PDO::FETCH_ASSOC);
            $registrationOrder = $userInfo['registrationOrder'];

            $passwordStmt = $connection->prepare("SELECT passCode FROM authenticator WHERE registrationOrder = ?");
            $passwordStmt->bindParam(1, $registrationOrder);
            $passwordStmt->execute();

            if ($passwordStmt->rowCount() == 1) {
                $hashedOldPassword = $passwordStmt->fetch(PDO::FETCH_ASSOC)['passCode'];

                if (password_verify($oldPassword, $hashedOldPassword)) {
                    $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                    $updateStmt = $connection->prepare("UPDATE authenticator SET passCode = ? WHERE registrationOrder = ?");
                    $updateStmt->bindParam(1, $hashedNewPassword);
                    $updateStmt->bindParam(2, $registrationOrder);
                    $updateStmt->execute();

                    if ($updateStmt->rowCount() > 0) {
                        $_SESSION['success_message'] = "Password successfully changed.";
                        header("Location: index.php");
                        exit;
                    } else {
                        $error_messages[] = "An error occurred while updating the password, please try again.";
                    }
                } else {
                    $error_messages[] = "Old password is incorrect.";
                }
            } else {
                $error_messages[] = "User password information not found.";
            }
        }
    }

    if (!empty($error_messages)) {
        $_SESSION['error_messages'] = $error_messages;
        $_SESSION['form_data'] = $_POST;
        header("Location: Update.php");
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
    
    <label for="oldPassword">Old Password:</label>
    <input type="password" id="oldPassword" name="oldPassword" required><br>
    
    <label for="newPassword">New Password:</label>
    <input type="password" id="newPassword" name="newPassword" required><br>

    <label for="confirmPassword">Confirm New Password:</label>
    <input type="password" id="confirmPassword" name="confirmPassword" required><br>
    
    <input type="submit" name="changePassword" value="Change Password">
    <button type="button" onclick="window.location='index.php';">Login</button>
</form>

</body>
</html>

