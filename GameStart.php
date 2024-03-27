<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

$_SESSION['current_level'] = 1;
$_SESSION['score'] = 0;


$question_page = "Question.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to the Game!</title>
</head>
<body>
    <h1>Welcome to the Game!</h1>
    <p>Test your knowledge and have fun!</p>
    <form action="<?php echo $question_page; ?>" method="post">
        <button type="submit" name="start_game">Start Game</button>
    </form>
</body>
</html>
