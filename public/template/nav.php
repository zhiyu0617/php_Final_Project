<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['history'])) {
        $pageToInclude = "history";
    } elseif (isset($_POST['cancelGame'])) {
        $pageToInclude = "cancelGame";
    } elseif (isset($_POST['signOut'])) {
        $pageToInclude = "signOut";
    }elseif (isset($_POST['signIn'])) {
        $pageToInclude = "signIn";
    }elseif (isset($_POST['signUp'])) {
        $pageToInclude = "signUp";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navigation Example</title>
    <link rel="stylesheet" href="public/assets/css/style.css">
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
