<?php
    function allAnswered($arr){
        $returnValue = TRUE;
        
        for($i=0; $i<sizeof($arr) && $returnValue; $i++){
            if($arr[$i] == ''){
                $returnValue = FALSE;
            }
        }
       
        return $returnValue;
    }
    
    function checkAnswered($q1, $q2, $q3, $q4, $q5){
        if($q1=='' || $q2=='' || $q3=='' || $q4=='' || $q5=='' ){
            echo "<div id='results'>";
            echo "<span class='resultMessage' class='notSet'> You must answer ALL quiz questions. </span> <br />";
            for($i=1; $i<=5;$i++){
                if(${'q'.$i}==""){
                    echo "<span class='notSet'> Please answer question #".$i."<br />"; 
                }
            }
            echo "</div>";
        }
    }
    
    function displayResults($answerArr, $resultsArr){
        echo "<div id='results'>";
        echo "<span class='resultMessage'> Quiz Results </span><br />";
        $correctCount=0;
        
        for($i=0;$i<sizeof($answerArr);$i++){
            if(str_replace(' ', '',strtolower($resultsArr[$i])) == $answerArr[$i]){
                echo "Question " . ($i+1) . " Correct! <br/>";
                $correctCount++;
            }else{
                echo "Question " . ($i+1) . " Incorrect! <br/>";
            }
        }
            
        echo "<br / > <br />";
        echo "You got " . $correctCount . " of 5 correct! You get ";
    
        switch ($correctCount/5){
            case 1:
                echo "an <span id=grade>A!&#x1F389;</span>";
                break;
            case .8:
                echo "a <span id=grade>B!&#x1F41D;</span>";
                break;
            case .6:
                echo "a <span id=grade>D!&#x1F41F;</span>";
                break;
            default:
                echo "an <span id=grade>F!&#x1F4A9;</span>";
        }
        
        echo "</div>";
    }
?>