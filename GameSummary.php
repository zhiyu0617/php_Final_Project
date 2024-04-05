<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_score = $_SESSION['score'] ?? 0;

require 'config.php'; 

$stmt = $connection->prepare("INSERT INTO history (user_id, result, livesUsed, scoreTime) VALUES (?, ?, ?, NOW())");
$stmt->bind_param("iii", $_SESSION['user_id'], $user_score, $_SESSION['livesUsed']);
$stmt->execute();
$stmt->close();

unset($_SESSION['score'], $_SESSION['current_question'], $_SESSION['livesUsed']);

$connection->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Game Summary</title>
</head>
<body>
    <h1>Game Over</h1>
    <p>Thank you for playing! Your score is: <?php echo htmlspecialchars($user_score); ?></p>
    <a href="GameStart.php">Play Again</a>
    <a href="logout.php">Logout</a>
    <a href="history.php">View History</a>
</body>
</html>
