<footer class="game-footer"> 
<link rel="stylesheet" type="text/css" href="public/assets/css/footer_style.css">
    <div style="text-align: center;">
        <?php
            $image_url='public/assets/media/footer.gif'; 
        ?>
        <img src="<?php echo $image_url; ?>" alt="Footer Image" style="width: 200px; height: 100px;">
    </div>
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
                "In a room of 23 people there’s a 50% chance that two people have the same birthday.",
                "Forty” is the only number that is spelt with letters arranged in alphabetical order."
            ];
            echo "Fun Fact: " . $facts[array_rand($facts)];
            ?>
        </div>
    </div>
</footer>