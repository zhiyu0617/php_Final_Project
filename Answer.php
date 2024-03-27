<?php
session_start();

require 'database.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$questions = [
    ["correct" => "C"],
    ["correct" => "D"],
    ["correct" => "C"],
    ["correct" => "B"],
    ["correct" => "D"],
    ["correct" => "C"],
    ["correct" => "C"],
    ["correct" => "C"],
    ["correct" => "B"],
    ["correct" => "B"]
];


if (!isset($_SESSION['current_question'])) {
    $_SESSION['feedback'] = "No current question set.";
    header('Location: Question.php');
    exit;
}

$userAnswer = $_POST['answer'] ?? '';
$correctAnswer = $questions[$_SESSION['current_question']]['correct'];


if ($userAnswer === $correctAnswer) {
    $_SESSION['score'] += 1;
    $feedback = "Correct! Well done.";
} else {
    $feedback = "Incorrect. The correct answer was: {$correctAnswer}.";
}


$_SESSION['feedback'] = $feedback;


$_SESSION['current_question']++;
if ($_SESSION['current_question'] < count($questions)) {
    header('Location: Question.php'); 
} else {
    header('Location: GameSummary.php'); 
}
exit;
