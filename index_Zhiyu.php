<?php 
    require 'config.php'; 
    session_start();
    //$_SESSION['isSignedIn'] = true;
    unset($_SESSION['isSignedIn']);

    $pageToInclude = "";
    $isSignedIn = isset($_SESSION['isSignedIn']) && $_SESSION['isSignedIn'] === true;
?>
<!DOCTYPE html>
<html lang="en">
<head >
    <?php require 'public/template/head.php'; ?>
</head>
<body>
<header>
    <?php require 'public/template/header.php'; ?>
    <?php require 'public/template/nav.php'; ?>
</header>
<main>
<?php
    if ($isSignedIn && $pageToInclude != "") {
        switch ($pageToInclude) {
            case "history":
                require 'src/features/history.php';
                break;
            case "cancelGame":
                require 'src/features/cancel.php';
                break;
            case "signOut":
                require 'src/features/signout.php';
                break;
        }
    } elseif (!$isSignedIn && $pageToInclude != "") {
        switch ($pageToInclude) {
            case "signIn":
                require 'src/features/signin.php';
                break;
            case "signUp":
                require 'src/features/signup.php';
                break;
        }
        echo '<p>Welcome to our game! Please sign in to play.</p>';
    }
    ?>
</main>
<footer>
    <?php require 'public/template/footer.php'; ?>
</footer>
</body>
</html>

