<?php
session_start();

require 'database.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}


$questions = [
    [
        "text" => "In a cage, chickens and rabbits add up to 35 heads and 94 feet. Please count the number of chickens and rabbits.",
        "options" => ["A" => "24,10", "B" => "18, 15", "C" => "12,23", "D" => "I don’t know!"],
        "correct" => "C"
    ],
    [
        "text" => "The Middle Ages mainly refers to:",
        "options" => ["A" => "14th and 15th centuries", "B" => "The middle of a century", "C" => "Around the 16th century", "D" => "European feudal era"],
        "correct" => "D"
    ],
    [
        "text" => "In the process of opening up new shipping routes, the first to cross the Atlantic was:",
        "options" => ["A" => "Da Gama", "B" => "Dias", "C" => "Columbus", "D" => "Magellan"],
        "correct" => "C"
    ],
    [
        "text" => "The beginning of the French Revolution is marked by:",
        "options" => ["A" => "The convening of the three-level meeting", "B" => "The people of Paris stormed the Bastille", "C" => "The issuance of the Declaration of Human Rights", "D" => "The establishment of the First French Republic"],
        "correct" => "B"
    ],
    [
        "text" => "When Napoleon took power in France, the stage of the French Revolution was:",
        "options" => ["A" => "Began to explode", "B" => "Reached climax", "C" => "Basically ended", "D" => "Consolidated results"],
        "correct" => "D"
    ],
    [
        "text" => "The first independent country in America was:",
        "options" => ["A" => "Haiti", "B" => "Mexico", "C" => "United States", "D" => "Colombia"],
        "correct" => "C"
    ],
    [
        "text" => "How many degrees can an owl turn its head?",
        "options" => ["A" => "90 degrees", "B" => "180 degrees", "C" => "270 degrees", "D" => "360 degrees"],
        "correct" => "C"
    ],
    [
        "text" => "Which metal is the only liquid metal at room temperature?",
        "options" => ["A" => "Iron", "B" => "Copper", "C" => "Mercury", "D" => "Aluminum"],
        "correct" => "C"
    ],
    [
        "text" => "Which of the following artists is the author of 'Sunflower'?",
        "options" => ["A" => "Claude Monet", "B" => "Vincent Van Gogh", "C" => "Paul Gauguin", "D" => "Picasso"],
        "correct" => "B"
    ],
    [
        "text" => "Which artist is famous for his 'moon walk'?",
        "options" => ["A" => "Bruce Springsteen", "B" => "Michael Jackson", "C" => "Madonna", "D" => "David Bowie"],
        "correct" => "B"
    ]
];

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

if (!isset($_SESSION['current_question'])) {
    $_SESSION['current_question'] = 0;
} else {
    $_SESSION['current_question'] = ($_SESSION['current_question'] + 1) % count($questions); // 循环问题
}


$current_index = $_SESSION['current_question'];
$current_question = $questions[$current_index];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Question <?php echo $current_index + 1; ?></title>
</head>
<body>
    <h2><?php echo "Question " . ($current_index + 1); ?></h2>
    <p><?php echo $current_question['text']; ?></p>
    <form action="Answer.php" method="POST">
        <?php foreach ($current_question['options'] as $key => $option): ?>
            <div>
                <input type="radio" id="option<?php echo $key; ?>" name="answer" value="<?php echo $key; ?>" required>
                <label for="option<?php echo $key; ?>"><?php echo htmlspecialchars($option); ?></label>
            </div>
        <?php endforeach; ?>
        <button type="submit">Submit Answer</button>
    </form>
</body>
</html>

