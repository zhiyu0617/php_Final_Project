<?php
session_start();

require 'database.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$correct_answers = [
    "C", "C", "C", "A", "C", "C", "D", "D", "A", "A"
];


$current_index = $_SESSION['current_question'];
$user_answer = $_POST['answer'] ?? '';

if (isset($user_answer)) {
    if ($user_answer === $correct_answers[$current_index]) {
        $_SESSION['score']++;
    } else {
        $_SESSION['livesUsed']++; 
    }

    $_SESSION['current_question']++;
    if ($_SESSION['current_question'] < count($correct_answers)) {
        header('Location: Question.php');
    } else {

        header('Location: GameSummary.php');
    }
} else {
    $_SESSION['feedback'] = "Please select an answer.";
    header('Location: Question.php');
}
exit;