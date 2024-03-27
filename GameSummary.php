<?php
session_start();

if (!isset($_SESSION['user_id']) || !isset($_SESSION['score'])) {
    header('Location: GameStart.php'); 
}


$user_score = $_SESSION['score'];


session_destroy();

$start_page = "GameStart.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Game Summary</title>
</head>
<body>
    <h1>Game Over</h1>
    <p>Thank you for playing! Your score is: <?php echo $user_score; ?></p>
    <a href="<?php echo $start_page; ?>">Play Again</a>
    <a href="logout.php">Logout</a>
</body>
</html>
