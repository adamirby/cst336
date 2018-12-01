<?php
    include 'dbConnection.php';
    $conn=getDatabaseConnection();


    if(isset($_POST['action']) && $_POST['action'] == 'getStates'){
        echo getStateCodes();
    }

    function getStateCodes(){
        global $conn;
        $sql="SELECT stateCode FROM states";
        $stmt=$conn->prepare($sql);
        $stmt->execute();
        $records=$stmt->fetchAll(PDO::FETCH_ASSOC);
        $stateSelectString="";
        foreach($records as $record){
            $stateSelectString.="<option>".$record['stateCode']."</option>";
        }
        
        return $stateSelectString;
    }
    
?>