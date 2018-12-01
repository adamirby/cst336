<?php
    include 'dbConnection.php';
    $conn=getDatabaseConnection();

    function getStateCodes(){
        global $conn;
        $sql="SELECT stateCode FROM states";
        $stmt=$conn->prepare($sql);
        $stmt->execute();
        $records=$stmt->fetchAll(PDO::FETCH_ASSOC);
        
        
        foreach($records as $record){
            echo "<option>";
            echo $record['stateCode'];
            echo "</option>";
        }
    }

?>