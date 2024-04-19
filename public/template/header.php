<header class="game-header">
    <?php
        $TheBigMethChallenfe = " The Big Math Challenge";
        $mainTitle = "Welcome to". $TheBigMethChallenfe;
        $subTitle = "Fun and Learning Await!";
    ?>

    <h1><?php echo $mainTitle; ?></h1>
    <p class="game-subtitle"><?php echo $subTitle; ?></p>
</header>
<style>
.game-header {
    background-image: url('public/assets/media/header_background.jpg');
    background-size:auto;
    background-position: center;
    color: palevioletred; 
    font-family: 'Fredoka One', cursive;
    text-align: center;
    padding: 30px 0;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    border-bottom: 5px dashed #ffb703; 
}

.game-header h1 {
    margin: 0;
    font-size: 36px;
}

.game-subtitle {
    font-size: 24px;
    margin-top: 10px;
}
</style>