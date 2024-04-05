<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$_SESSION['current_question'] = 0; 
$_SESSION['score'] = 0;            
$_SESSION['livesUsed'] = 0;        

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to the Game!</title>
</head>
<body>
    <h1>Welcome to the Game!</h1>
    <p>Get ready to test your knowledge!</p>

    <form action="Question.php" method="post">
        <button type="submit" name="start_game">Start Game</button>
    </form>
    
    <a href="logout.php">Logout</a>
</body>
</html>
