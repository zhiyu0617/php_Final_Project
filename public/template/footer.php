<footer class="game-footer">
    <div class="footer-content">
        <?php
        echo "<p>&copy; " . date("Y") . " The Big Math Challenge. All rights reserved.</p>";
        echo "<p>Developed by Juncheng Hao, Yunxian Xu, Songqi Ma, Christian Denis Marcelin, Zhiyu Liao</p>";
        ?>

        
        <div class="fun-fact">
            <?php
            $facts = [
                "Math is fun with puzzles and games!",
                "Did you know? There are infinite numbers between 0 and 1.",
                "Math magic: Any number times zero is always zero!",
                "The word “hundred” comes from the old Norse term, “hundrath”, which actually means 120 and not 100.",
                "In a room of 23 people there's a 50% chance that two people have the same birthday.",
                "Forty” is the only number that is spelt with letters arranged in alphabetical order."
            ];
            echo "Fun Fact: " . $facts[array_rand($facts)];
            ?>
        </div>
    </div>
</footer>
<style>
    .game-footer {
    background-color: #C3B1E1; 
    color: #023047; 
    padding: 20px;
    text-align: center;
    border-top: 5px dashed #ffb703; 
    font-family: 'Fredoka One', cursive; 
    border-radius: 10px;
}

.game-footer a {
    color: #023047;
    text-decoration: none;
    font-weight: bold;
}

.game-footer .fun-fact {
    margin-top: 20px;
    font-size: 18px;
    background-color: #fff3b0;
    padding: 10px;
    border-radius: 10px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
}
</style>