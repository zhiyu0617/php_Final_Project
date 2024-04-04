<?php require 'config.php'; ?>
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
    $isSignedIn = isset($_SESSION['isSignedIn']) && $_SESSION['isSignedIn'] === true;

    if ($isSignedIn) {
        require 'src/features/game.php';
    } else {
        echo '<p>Welcome to our game! Please sign in to play.</p>';
    }
    ?>
</main>
<footer>
    <?php require 'public/template/footer.php'; ?>
</footer>
</body>
</html>
