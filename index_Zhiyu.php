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

    if ($isSignedIn){
        require 'C:\wamp64\www\dw3\Final_Project\src\features\game.php';
    }

    $image_url='public/assets/media/Header_Gif.gif';
    ?>
    <div style="text-align: center;">
        <img src="<?php echo $image_url; ?>">
    </div>
</main>
<footer>
    <?php require 'public/template/footer.php'; ?>
</footer>
</body>
</html>

