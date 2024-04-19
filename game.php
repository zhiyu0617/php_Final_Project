<?php
session_start();

require 'Select.php';
require 'game_functions.php';

$pdo = connectToDB();

if (!isset($_SESSION['level'])) {
    $_SESSION['level'] = 1;
    $_SESSION['lives'] = 5;
    $_SESSION['gameStatus'] = 'active';
    $_SESSION['registrationOrder'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $items = $_POST['items'] ?? '';
    if ($action === 'submit_answer' && isset($_POST['answer']) && $_SESSION['gameStatus'] === 'active') {
        $answer = $_POST['answer'];
        if (checkLevelAnswer($_SESSION['level'], $answer, $items)) {
            $_SESSION['level']++;
            $_SESSION['successMessage'] = 'Correct answer! Well done.';
            if ($_SESSION['level'] > 6) {
                $_SESSION['gameStatus'] = 'won';
                updateGameResult($pdo, 'win', 5 - $_SESSION['lives'], $_SESSION['registrationOrder']);
            }
        } else {
            $_SESSION['lives']--;
            $_SESSION['errorMessage'] = 'Incorrect. Please try again. Do not forget to use "," to split the letter or number!';
            if ($_SESSION['lives'] <= 0) {
                $_SESSION['gameStatus'] = 'lost';
                updateGameResult($pdo, 'gameover', 5, $_SESSION['registrationOrder']);
            }
        }
    }

    if ($action === 'abandon') {
        updateGameResult($pdo, 'incomplete', 5 - $_SESSION['lives'], $_SESSION['registrationOrder']);
        $_SESSION['level'] = 1;
        $_SESSION['lives'] = 5;
        $_SESSION['gameStatus'] = 'incomplete';
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }

    if ($action === 'play_again') {
        $_SESSION['level'] = 1;
        $_SESSION['lives'] = 5;
        $_SESSION['gameStatus'] = 'active';
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Game Levels</title>
    <link rel="stylesheet" type="text/css" href="public/assets/css/game_style.css">
</head>
<body>
<div class="game-container">
    <h1>Letter and Number Ordering Game</h1>
    <?php
    if ($_SESSION['gameStatus'] === 'active'):
        [$displayItems, $instructions] = getLevelInstructions($_SESSION['level']);
        if (!empty($_SESSION['errorMessage'])) {
            echo '<div style="color: red; margin-top: 20px;">' . htmlspecialchars($_SESSION['errorMessage']) . '</div>';
            unset($_SESSION['errorMessage']);
        }
        if (!empty($_SESSION['successMessage'])) {
            echo '<div style="color: green; margin-top: 20px;">' . htmlspecialchars($_SESSION['successMessage']) . '</div>';
            unset($_SESSION['successMessage']);
        }
        echo '<p>Level: ' . htmlspecialchars($_SESSION['level']) . '</p>';
        echo '<p>Lives: ' . htmlspecialchars($_SESSION['lives']) . '</p>';
        echo '<p>' . htmlspecialchars($instructions) . '</p>';
        echo '<p>Items: ' . htmlspecialchars($displayItems) . '</p>';
        echo '<form action="" method="post">
                <input type="hidden" name="action" value="submit_answer">
                <input type="hidden" name="items" value="' . htmlspecialchars($displayItems) . '">
                <label for="answer">Your Answer:</label>
                <input type="text" id="answer" name="answer" required placeholder="e.g., z,j,x,i,g,a or 2,27,29,52,59,78">
                <button type="submit">Submit Answer</button>
              </form>';
        echo '<form action="" method="post">
                <input type="hidden" name="action" value="abandon">
                <button type="submit">Abandon</button>
              </form>';
    elseif ($_SESSION['gameStatus'] === 'won'):
        echo '<p>Congratulations! You\'ve won the game!</p>';
    elseif ($_SESSION['gameStatus'] === 'lost'):
        echo '<p>Game Over. You\'ve exhausted your lives.</p>';
    elseif ($_SESSION['gameStatus'] === 'incomplete'):
        echo '<p>Game Over. You abandoned the game.</p>';
    endif;

    if ($_SESSION['gameStatus'] === 'won' || $_SESSION['gameStatus'] === 'lost' || $_SESSION['gameStatus'] === 'incomplete'):
        echo '<form action="" method="post">
                <input type="hidden" name="action" value="play_again">
                <button type="submit">Play Again</button>
              </form>';
    endif;
    ?>
</div>
</body>
</html>
