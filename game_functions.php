<?php
function generateRandomLetters($length = 6) {
    $letters = range('a', 'z'); 
    shuffle($letters);
    return array_slice($letters, 0, $length);
}

function generateRandomNumbers($length = 6) {
    $numbers = range(0, 100); 
    shuffle($numbers);
    return array_slice($numbers, 0, $length);
}

function getLevelInstructions($level) {
    switch ($level) {
        case 1:
            $items = generateRandomLetters();
            $instructions = 'Arrange the following letters in ascending order:';
            break;
        case 2:
            $items = generateRandomLetters();
            $instructions = 'Arrange the following letters in descending order:';
            break;
        case 3:
            $items = generateRandomNumbers();
            $instructions = 'Arrange the following numbers in ascending order:';
            break;
        case 4:
            $items = generateRandomNumbers();
            $instructions = 'Arrange the following numbers in descending order:';
            break;
        case 5:
            $items = generateRandomLetters();
            $instructions = 'Identify the first (smallest) and last (largest) letters from the following:';
            break;
        case 6:
            $items = generateRandomNumbers();
            $instructions = 'Identify the smallest and the largest numbers from the following:';
            break;
        default:
            $items = [];
            $instructions = 'Invalid level';
    }
    $displayItems = implode(' ', $items);
    return [$displayItems, $instructions];
}

function checkLevelAnswer($level, $answer, $items) {
    $userItems = str_replace(' ', '', $answer);
    $userItems = explode(',', $userItems);

    $correctItems = explode(' ', $items);

    switch ($level) {
        case 1:
        case 3:
            sort($userItems);
            sort($correctItems);
            return $userItems === $correctItems;
        case 2:
        case 4:
            rsort($userItems);
            rsort($correctItems);
            return $userItems === $correctItems;
        case 5:
        case 6:
            sort($userItems);
            sort($correctItems);
            return $userItems[0] === $correctItems[0] && end($userItems) === end($correctItems);
    }
    return false;
}
?>
