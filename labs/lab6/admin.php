<?php
    include 'dbConnection.php';
    session_start();
    
    if(!isset($_SESSION['adminName'])){
        header("Location:index.php");
    }

    $conn=getDatabaseConnection("ottermart");

    function displayAllProducts(){
        global $conn;
        $sql="SELECT * FROM om_product ORDER BY productId";
        $statement=$conn->prepare($sql);
        $statement->execute();
        $records=$statement->fetchAll(PDO::FETCH_ASSOC);
        
        return $records;
    }

?>

<script>
    function confirmDelete(){
        return confirm("Are you sure you want to delete the product?");
    }
</script>

<!DOCTYPE html>
<HTML lang='en'>
    <head>
        <title>Admin</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container">
             <div class="jumbotron">
                <h2>Ottermart Admin</h2>
                <nav class="navbar navbar-dark bg-dark">
                        <ul class="nav navbar-nav mr-auto">
                            <li class="nav-item">
                                <form action="addProduct.php">
                                    <input type="submit" class="btn btn-primary btn-sm" id="beginning" name="addproduct" value="Add Product" />
                                </form>
                            </li>
                            <li class="nav-item">
                                <form action="logout.php" >
                                    <input type="submit" class="btn btn-warning btn-sm" id="beginning" value="Logout" />
                                </form>
                            </li>
                        </ul>
                </nav>
            </div>
            <?php
                $records=displayAllProducts();
                echo "<table class='table table-hover table-bordered table-striped'>";
                echo "<thead>
                        <tr>
                            <th scope='col'>ID</th>
                            <th scope='col'>Name</th>
                            <th scope='col'>Description</th>
                            <th scope='col'>Price</th>
                            <th scope='col'>Update</th>
                            <th scope='col'>Remove</th>
                        </tr>
                       </thead>";
                echo "<tbody>";
                foreach($records as $record){
                    echo "<tr>";
                    echo "<td>".$record['productId']."</td>";
                    echo "<td>".$record['productName']."</td>";
                    echo "<td>".$record['productDescription']."</td>";
                    echo "<td>$".$record['price']."</td>";
                    echo "<td><a class='btn btn-primary' href='updateProduct.php?productId=".$record['productId']."'>Update</a></td>";
                    
                    echo "<form action='deleteProduct.php' onsubmit='return confirmDelete()'>";
                    echo "<input type='hidden' name='productId' value= '".$record['productId']."' />";
                    echo "<td><input type='submit' class='btn btn-danger' value='Remove'></td>";
                    echo "</form>";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table";
            ?>
        </div>
    </body>
</HMTL>