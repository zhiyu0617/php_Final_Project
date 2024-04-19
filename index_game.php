<?php 
    require 'Database.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head >
    <?php require 'head.php'; ?>
</head>
<body>

<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
<header>
    <?php require 'header.php'; ?>
    <?php require 'nav.php'; ?>
</header>
<main>
<?php         
    
    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 900)) {
        unset($_SESSION['username']);
        session_destroy(); 
        session_start();
        $_SESSION['logout_message'] = "Time out.";
        header("Location: index.php"); 
    }
    
    require "game.php"
?>
</main>
<footer>
    <?php require 'footer.php'; ?>
</footer>
</body>
</html>