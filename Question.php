<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}


$questions = [
    [
        "text" => "How many legs does a spider have?",
        "options" => ["A" => "4", "B" => "6", "C" => "8", "D" => "10"],
        "correct" => "C"
    ],
    [
        "text" => "What is the name of the toy cowboy in 'Toy Story'?",
        "options" => ["A" => "Good Guy", "B" => "Buzz Lightyear", "C" => "Woody", "D" => "Thor"],
        "correct" => "C"
    ],
    [
        "text" => "What color is the Christmas tree?",
        "options" => ["A" => "Red", "B" => "Blue", "C" => "Green", "D" => "Yellow"],
        "correct" => "C"
    ],
    [
        "text" => "Where can you see many animals?",
        "options" => ["A" => "Zoo", "B" => "Museum", "C" => "Library", "D" => "Supermarket"],
        "correct" => "A"
    ],
    [
        "text" => "Whose nose grows longer every time they lie?",
        "options" => ["A" => "Little Red Riding Hood", "B" => "Cinderella", "C" => "Pinocchio", "D" => "The Little Mermaid"],
        "correct" => "C"
    ],
    [
        "text" => "What color are the stars on the American flag?",
        "options" => ["A" => "Red", "B" => "Blue", "C" => "White", "D" => "Yellow"],
        "correct" => "C"
    ],
    [
        "text" => "What color is a lemon?",
        "options" => ["A" => "Red", "B" => "Blue", "C" => "Green", "D" => "Yellow"],
        "correct" => "D"
    ],
    [
        "text" => "What is 1+2+3?",
        "options" => ["A" => "3", "B" => "4", "C" => "5", "D" => "6"],
        "correct" => "D"
    ],
    [
        "text" => "What is 2-2?",
        "options" => ["A" => "0", "B" => "1", "C" => "2", "D" => "Don't know"],
        "correct" => "A"
    ],
    [
        "text" => "What color is Santa Claus's hat?",
        "options" => ["A" => "Red", "B" => "Blue", "C" => "Green", "D" => "Yellow"],
        "correct" => "A"
    ]
];


if (!isset($_SESSION['current_question'])) {
    $_SESSION['current_question'] = 0;
    $_SESSION['score'] = 0;
    $_SESSION['livesUsed'] = 0; 
}


if ($_SESSION['current_question'] >= count($questions)) {
    header('Location: GameSummary.php');
    exit;
}


$current_index = $_SESSION['current_question'];
$current_question = $questions[$current_index];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Quiz Game - Question <?php echo $current_index + 1; ?></title>
</head>
<body>
    <h2>Question <?php echo $current_index + 1; ?></h2>
    <p><?php echo htmlspecialchars($current_question['text']); ?></p>
    <form action="Answer.php" method="post">
        <?php foreach ($current_question['options'] as $key => $option): ?>
            <label>
                <input type="radio" name="answer" value="<?php echo $key; ?>" required>
                <?php echo htmlspecialchars($option); ?>
            </label><br>
        <?php endforeach; ?>
        <input type="submit" value="Submit Answer">
    </form>
</body>
</html>