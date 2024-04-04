<?php
session_start();

$isSignnedIn = isset($_SESSION['isSignnedIn']) && $_SESSION['isSignnedIn'] === true;
?>
<nav>
    <ul>
        <?php if ($isSignnedIn): ?>
            <li><a href="src/features/history.php">History</a></li>
            <li><a href="src/features/cancel.php">Cancel Game</a></li>
            <li><a href="src/features/signout.php">Sign Out</a></li>
        <?php else: ?>
            <li><a href="public/form/signin-form.php">Sign In</a></li>
            <li><a href="public/form/signup-form.php">Sign Up</a></li>
        <?php endif; ?>
    </ul>
</nav>

<style>
    nav ul {
    list-style-type: none;
    padding: 2cap;
    text-align: center;
    background-color: plum; 
}

nav ul li {
    display: inline; 
    margin: 0 10px;
}

nav ul li a {
    text-decoration: none;
    color: white;
    padding: 10px 20px;
    border-radius: 5px;
    background-color: #DA70D6; 
}

nav ul li a:hover {
    background-color: #ff4500; 
}
</style>
