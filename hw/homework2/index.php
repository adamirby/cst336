<?php
include 'inc/functions.php';
?>
<!DOCTYPE html>
<HTML lang="en">
    <head>
        <meta charset="utf-8">
        <title>Dice Roller</title>
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet"> 
    </head>
    
    <body>
        <header>
            <h1>Dice Roller</h1>
            <p>Select the number of dice to roll then hit <span id="Roll">"Roll!"</span>. Your rolls will be displayed with some information about your results.</p>
            <hr />
        </header>
        <main>
            <form method="post" action="index.php">
                Select number of dice to roll:
                <select name="numberOfDice">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                </select>
                <input type="submit" value="Roll!" id="rollButton">
            </form>
    
            
            <?php
                rollDice($_POST['numberOfDice']);
            ?>
        </main>

    
        <footer>
            <hr>
            CST336 Internet Programming. 2018&copy; Irby <br />
            <strong>Disclaimer:</strong> The information in this webpage is fictitious. <br />
            It is used for academic purposes only.
            <br/>
            <figure>
                <img src="img/csumb_logo.png" alt="Picture of CSUMB Logo" title="CSUMB Logo" class="homePicture" />
            </figure>
        </footer>
    </body>
</HTML>