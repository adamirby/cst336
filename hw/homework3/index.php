<?php
include 'inc/functions.php';

if(isset($_GET['q1'])){
    /*load answers list*/
    $answerArr=array("12x+9", "1/x^3+c", "inf", "55", "-37,32");
    $resultsArr=array($_GET['q1'], $_GET['q2'], $_GET['q3'], $_GET['q4'], $_GET['q5']);
}
?>

<!DOCTYPE html>
<HTML lang="en">
    
    <head>
        <meta charset="utf-8">
        <title>Math Quiz</title>
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
        <script src='https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/latest.js?config=TeX-MML-AM_CHTML' async></script>
        <link href="https://fonts.googleapis.com/css?family=Just+Another+Hand" rel="stylesheet"> 
    </head>
    
    <body>
        <header>
            <h1><em>Math Quiz</em></h1>
            <p><em>It's time for a pop quiz!</em></p>
            <hr/>
        </header>
        <main>
            <br/><br/><br/><br/>
            <div id="test">
                <form id="testForm">
                    <!-- Question 1 -->
                    $$ 1)\ \text{Find the derivative of }6x^2+9x+4$$
                    <input name="q1" type="text" placeholder="Enter Answer Here" value="<?=$_GET['q1']?>">
            
                    <hr class="questionDivider" />
                        
                    <!-- Question 2-->
                    $$2) \int x^2 dx $$
                    <table id="q2tab">
                        <tr>
                            <td>
                                <input id="q2a1" name="q2" type="radio" value="2x+C" <?=($_GET['q2']=='2x+C'?'checked':'')?>>
                                <label for="q2a1">\( 2x + C\)</label> 
                            </td>
                            <td>
                                <input id="q2a2" name="q2" type="radio" value="C" <?=($_GET['q2']=='C'?'checked':'')?>>
                                <label for="q2a2">\( C \)</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input id="q2a3" name="q2" type="radio" value="1/x^3+C" <?=($_GET['q2']=='1/x^3+C'?'checked':'')?>>
                                <label for="q2a3">\( \frac{1}{3}x^3 +C \)</label>
                            </td>
                            <td>
                                <input id="q2a4" name="q2" type="radio" value="1/2x^2+C" <?=($_GET['q2']=='1/2x^2+C'?'checked':'')?>>
                                <label for="q2a4"> \( \frac{1}{2}x^2+C \)</label>
                            </td>
                        </tr>
                    </table>
                    
                        
                    <hr class="questionDivider" />
                        
                    <!-- Question 3 -->
                    $$ 3)\lim_{x\to\infty} \frac{x^2-x-20}{x+4}$$
                    
                    <select name="q3">
                        <option value="" <?=($_GET['q3']==''?'selected':'')?>>Select Your Answer</option>
                        <option value="0" <?=($_GET['q3']=='0'?'selected':'')?>>0</option>
                        <option value="inf" <?=($_GET['q3']=='inf'?'selected':'')?>>&#x221e;</option>
                        <option value="12" <?=($_GET['q3']=='12'?'selected':'')?>>12</option>
                        <option value="x" <?=($_GET['q3']=='x'?'selected':'')?>>x</option>
                    </select>
                    
                    <hr class="questionDivider" />
                        
                    <!-- Question 4 -->
                    $$ 4) \sum_{x=0}^{10} x $$
                    <input type="number" name="q4" min="0" max="1000" placeholder="Enter Answer Here" value="<?=$_GET['q4']?>"> 
                    <hr class="questionDivider" />
                        
                    <!-- Question 5 -->
                    $$ 5) \text{ Given } \vec a = \lt8, 5\gt \text{ and } \vec b = \lt-3, 6\gt \text{ find } 7\vec b - 2\vec a$$
                    <select name="q5">
                        <option value="">Select Your Answer</option>
                        <option value="-37,32" <?=($_GET['q5']=='-37,32'?'selected':'')?>>&lt;-37, 32&gt;</option>
                        <option value="12,17" <?=($_GET['q5']=='12,17'?'selected':'')?>>&lt;12, 17&gt;</option>
                        <option value="0,0" <?=($_GET['q5']=='0,0'?'selected':'')?>>&lt;0, 0&gt;</option>
                        <option value="37,-32" <?=($_GET['q5']=='37,-32'?'selected':'')?>>&lt;37, -32&gt;</option>
                    </select>
                    
                    <input type="submit" value="Submit">
                    
                </form>
            </div>

            <br/><br/>
        
            <?php
                if(isset($_GET['q1'])){
                    if(!allAnswered($resultsArr)){
                        checkAnswered($_GET['q1'], $_GET['q2'], $_GET['q3'], $_GET['q4'], $_GET['q5']);
                    }else {
                        displayResults($answerArr, $resultsArr);
                    }
                }
            ?>
            <br/><br/><br/><br/>
        </main>
        
        <footer>
            <div id="footerDiv">
                <hr>
                CST336 Internet Programming. 2018&copy; Irby <br />
                <strong>Disclaimer:</strong> The information in this webpage is fictitious. <br />
                It is used for academic purposes only.
                <br/>
                <figure>
                    <img src="img/csumb_logo.png" alt="Picture of CSUMB Logo" title="CSUMB Logo" class="homePicture" />
                </figure>
            </div>
        </footer>
        
    </body>
    
</HTML>