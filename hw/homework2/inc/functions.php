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
            echo"\t\t\t</table>\r";
            echo"\t\t\t<br/><br/>\r";
            produceStatsTable($arr);
        }
    }

    function showDice($arr){
        if(count($arr) > 0) {
            echo "\r\t\t\t\t<tr>\r";
            for($i = 0; $i < count($arr); $i++){
                echo "\t\t\t\t\t<td>\r";
                echo "\t\t\t\t\t\t<img src='img/$arr[$i].gif' alt='Die #$arr[$i]' title='Die #$arr[$i]'>\r";
                echo "\t\t\t\t\t</td>\r";
            }
            echo "\t\t\t\t</tr>\r";
        } 
    }
    
    function produceStatsTable($arr){

        echo "\t\t\t".'<table id="diceStatsTable">'."\r";
        echo "\t\t\t\t<tr>\r";
        echo "\t\t\t\t\t<th>\r\t\t\t\t\t\tAverage of Rolls\r\t\t\t\t\t</th>\r";
        echo "\t\t\t\t\t<th>\r\t\t\t\t\t\tMost Common Occuring Roll(s)\r\t\t\t\t\t</th>\r";
        echo "\t\t\t\t\t<th>\r\t\t\t\t\t\tSum of Rolls\r\t\t\t\t\t</th>\r";
        echo "\t\t\t\t\t<th>\r\t\t\t\t\t\tLargest Roll\r\t\t\t\t\t</th>\r";
        echo "\t\t\t\t\t<th>\r\t\t\t\t\t\tSmallest Roll\r\t\t\t\t\t</th>\r";
        echo "\t\t\t\t</tr>\r";
        echo "\t\t\t\t<tr>\r";
        echo "\t\t\t\t\t<td>\r";
        echo "\t\t\t\t\t\t".getAverageValueOfArray($arr)."\r";
        echo "\t\t\t\t\t</td>\r";
        echo "\t\t\t\t\t<td>\r";
        echo "\t\t\t\t\t\t".listArray(getMostCommonValuesInArray($arr))."\r";
        echo "\t\t\t\t\t</td>\r";
        echo "\t\t\t\t\t<td>\r";
        echo "\t\t\t\t\t\t".array_sum($arr)."\r";
        echo "\t\t\t\t\t</td>\r";
        echo "\t\t\t\t\t<td>\r";
        echo "\t\t\t\t\t\t".getLargestValueInArray($arr)."\r";
        echo "\t\t\t\t\t</td>\r";
        echo "\t\t\t\t\t<td>\r";
        echo "\t\t\t\t\t\t".getSmallestValueInArray($arr)."\r";
        echo "\t\t\t\t\t</td>\r";
        echo "\t\t\t\t</tr>\r";
        echo "\t\t\t</table>\r";
    }
    
    function getAverageValueOfArray($arr){
        return (array_sum($arr) / count($arr));
    }
    
    function getMostCommonValuesInArray($arr){
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
    
    function getSmallestValueInArray($arr){
        sort($arr);
        return $arr[0];
    }
    
    function getLargestValueInArray($arr){
        sort($arr);
        return $arr[sizeof($arr)-1];
    }
    
    function listArray($arr){
        $returnString = "";
        for($i = 0; $i < count($arr); $i++){
            $returnString .= "$arr[$i]";
            if($i+1 < count($arr)){
                $returnString .= ", ";
            }
        }
        return $returnString;
    }
?>