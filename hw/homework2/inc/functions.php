<?php
    function rollDice($numberOfDice){
        if($numberOfDice > 0){
            echo '<table id="diceTable">';
            $arr = array();
            for($i = 0; $i < $numberOfDice; $i++){
                    $random = rand(1, 6);
                    array_push($arr, $random);
            }
            showDice($arr);
            echo"</table>";
            echo"<br/><br/>";
            produceStatsTable($arr);
        }
    }

    function showDice($arr){
        if(count($arr) > 0) {
            echo "<tr>";
            for($i = 0; $i < count($arr); $i++){
                echo "<td>";
                echo "<img src='img/$arr[$i].gif'>";
                echo "</td>";
            }
            echo "</tr>";
        } 
    }
    
    
    function produceStatsTable($arr){
        echo '<table id="diceStatsTable">';
        echo "<tr>";
        echo "<th>Average of Rolls</th> <th>Most Common Occuring Roll(s)</th> <th>Summ of Rolls</th> <th>Largest Roll</th> <th>Smallest Roll</th>";
        echo "</tr>";
        echo "<tr>";
        
        echo "<td>";
        echo getAverageValue($arr);
        echo"</td>";
        
        echo "<td>";
        echoArray(getMostCommonValues($arr));
        echo"</td>";
        
        echo "<td>";
        echo array_sum($arr);
        echo"</td>";
        
        echo "<td>";
        echo getLargestValue($arr);
        echo "</td>";
        
        echo "<td>";
        echo getSmallestValue($arr);
        echo "</td>";
        
        echo "</tr>";
        echo "</table>";
    }
    
    function getAverageValue($arr){
        return (array_sum($arr) / count($arr));
    }
    
    function getMostCommonValues($arr){
        sort($arr);
        $commonCount = 0;
        $currentCount = 1;
        $commonArr = array();
        
        for($i = 0; $i < count($arr); $i++ ){
            if($arr[$i] == $arr[$i+1]){
                $currentCount++;
            }else{
                if($currentCount > $commonCount){
                    $commonArr = array();
                    array_push($commonArr, $arr[$i]);
                    $commonCount = $currentCount;
                }else if($currentCount == $commonCount){
                    array_push($commonArr, $arr[$i]);
                    $commonCount = $currentCount;
                }
                
                $currentCount = 1;
            }
        }
        
        return $commonArr;
    }
    
    function getSmallestValue($arr){
        sort($arr);
        return $arr[0];
    }
    
    function getLargestValue($arr){
        sort($arr);
        return $arr[sizeof($arr)-1];
    }
    
    function echoArray($arr){
        for($i = 0; $i < count($arr); $i++){
            echo "$arr[$i]";
            if($i+1 < count($arr)){
                echo ", ";
            }
        }
    }
?>