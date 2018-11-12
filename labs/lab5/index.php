<?php
    include 'dbConnection.php';
    
    $conn=getDatabaseConnection("ottermart");
    
    function displayCategories(){
        global $conn;
        
        $sql="SELECT catId, catName from om_category ORDER BY catName";
        
        $stmt=$conn->prepare($sql);
        $stmt->execute();
        $records=$stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach($records as $record){
            echo "<option value='".$record["catId"]."' >".$record["catName"]."</option>";
        }
    }
    
    function displaySearchResults(){
        global $conn;
        
        if(isset($_GET['searchForm'])){
            echo "<h3 id='productHeader'>Products Found</h3>";

            
            $namesParameters=array();
            
            $sql="SELECT * FROM om_product WHERE 1";
            
            if(!empty($_GET['product'])){
                $sql.=" AND productName LIKE :productName OR productDescription LIKE :productName";
                $namedParameters[":productName"] = "%".$_GET['product']."%";
            }
        
            if(!empty($_GET['category'])){
                $sql.=" AND catId = :categoryId";
                $namedParameters[":categoryId"]=$_GET['category'];
            }
        
            if(!empty($_GET['priceFrom'])){
                $sql.=" AND price >= :priceFrom";
                $namedParameters[":priceFrom"]=$_GET['priceFrom'];
            }
            
            if(!empty($_GET['priceTo'])){
                $sql.=" AND price <= :priceTo";
                $namedParameters[":priceTo"]=$_GET['priceTo'];
            }
            
            if(isset($_GET['orderBy'])){
                if($_GET['orderBy'] == 'price'){
                    $sql.=" ORDER BY price";
                }else{
                    $sql.=" ORDER BY productName";
                }
            }
        
            $stmt=$conn->prepare($sql);
            $stmt->execute($namedParameters);
            $records=$stmt->fetchAll(PDO::FETCH_ASSOC);
            echo "<table>";
            $tableCounter=0;
            foreach($records as $record){
                if($tableCounter==0){
                    echo "<tr>";
                }
                echo "<td class='result'>";
                echo "<span class='productName'>".$record['productName']."</span><br /> ".$record["productDescription"]."<br /> $".$record["price"];
                echo "<br /><a href=\"purchaseHistory.php?productId=".$record["productId"]."\">History</a>";
                echo "</td>";
                $tableCounter++;
                if($tableCounter==4){
                    echo "</tr>";
                    $tableCounter=0;
                }
            }
            echo "</table>";
        }  
    }
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>OtterMart Product Search</title>
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Amatic+SC|Yanone+Kaffeesatz" rel="stylesheet"> 
    </head>
    
    <body>
        
        <header>
            <h1> OtterMart Product Search</h1>
        </header>
        <hr /><hr />
        <main> 
            <form>
                <span class='label'>Product:</span> <input type="text" name="product" />
                <br />
                <span class='label'>Category:</span>
                    <select name="category">
                        <option value="">Select One</option>
                        <?=displayCategories()?>
                    </select>
                <br />
                <span class='label'>Price: From</span> <input type="text" name="priceFrom" size="7" />
                       <span class='label'>To </span>   <input type="text" name="priceTo" size="7" />
                <br />
                <span class='label'>Order results by:</span>
                <br />
                
                <input type="radio" name="orderBy" value="price" /> <span class='label'>Price</span>
                <input type="radio" name="orderBy" value="name" /> <span class='label'>Name</span>
                
                <br /><br />
                <input type="submit" value="Search" name="searchForm" />
                
            </form>
            
            <br />
            
        
        
            <hr />
        
            <?=displaySearchResults()?>
        </main>
        <hr /><hr />
        
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
</html>