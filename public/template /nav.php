<?php
session_start();

$isSignedIn = isset($_SESSION['isSignedIn']) && $_SESSION['isSignedIn'] === true;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['history'])) {
        header('Location: src/features/history.php');
        exit();
    } elseif (isset($_POST['cancelGame'])) {
        header('Location: src/features/cancel.php');
        exit();
    } elseif (isset($_POST['signOut'])) {
        header('Location: src/features/signout.php');
        exit();
    } elseif (isset($_POST['signIn'])) {
        header('Location: public/form/signin-form.php');
        exit();
    } elseif (isset($_POST['signUp'])) {
        header('Location: public/form/signup-form.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navigation Example</title>
    <link rel="stylesheet" href="path/to/your/style.css"> <!-- Update this path -->
</head>
<body>
<nav>
    <ul>
        <?php if ($isSignedIn): ?>
            <li>
                <form action="" method="POST">
                    <input type="submit" name="history" class="button" value="History" />
                    <input type="submit" name="cancelGame" class="button" value="Cancel Game" />
                    <input type="submit" name="signOut" class="button" value="Sign Out" />
                </form>
            </li>
        <?php else: ?>
            <li>
                <form action="" method="POST">
                    <input type="submit" name="signIn" class="button" value="Sign In" />
                    <input type="submit" name="signUp" class="button" value="Sign Up" />
                </form>
            </li>
        <?php endif; ?>
    </ul>
</nav>
</body>
</html>

<style>
.button {
    cursor: pointer;
    margin-top: -10px;
    margin-bottom: 20px;
}

nav ul {
    text-align: center;
}

nav ul li {
    display: inline;
}

</style>
