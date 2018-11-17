<script>
    function added(){
        return alert("Product has been added!");
    }
</script>

<?php
    include 'dbConnection.php';
    session_start();
    
     if(!isset($_SESSION['adminName'])){
        header("Location:index.php");
    }
    
    $conn=getDatabaseConnection("ottermart");
    
    function getCategories(){
        global $conn;
        
        $sql="SELECT catId, catName FROM om_category ORDER BY catName";
        
        $statement=$conn->prepare($sql);
        $statement->execute();
        $records=$statement->fetchAll(PDO::FETCH_ASSOC);
        foreach($records as $record){
            echo "<option value='".$record['catId']."'>".$record['catName']."</option>";
        }
    }
    
    if(isset($_GET['submitProduct'])){
        $productName=$_GET['productName'];
        $productDescription=$_GET['productDescription'];
        $productImage=$_GET['productImage'];
        $price=$_GET['price'];
        $catId=$_GET['catId'];
        
        $sql="INSERT INTO om_product
              ( productName, productDescription, productImage, price, catId)
              VALUES ( :productName, :productDescription, :productImage, :price, :catId)";
        $namedParamaters=array();
        $namedParamaters[':productName']=$productName;
        $namedParamaters[':productDescription']=$productDescription;
        $namedParamaters[':productImage']=$productImage;
        $namedParamaters[':price']=$price;
        $namedParamaters[':catId']=$catId;
        $statement=$conn->prepare($sql);
        $statement->execute($namedParamaters);
        echo "<script>added();</script>";
    }

?>

<!DOCTYPE html>
<HTML lang='en'>
    <head>
        <title>Add Product</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="jumbotron">
                <h2>Add Product</h2>
                <nav class="navbar navbar-dark bg-dark">
                    <ul class="nav navbar-nav mr-auto">
                        <li class="nav-item">
                            <form action="admin.php">
                                <input type="submit" class="btn btn-primary btn-sm" id="beginning" name="addproduct" value="Home" />
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
            <div class="row">
                <div class="col-md-5 col-md-offset-3">
                    <form>
                        <div class="forum-group">
                            <div class="input-group">
                                <strong>Product Name</strong> <input type="text" class="form-control" name="productName" required><br />
                                <strong>Description</strong> <textarea name="productDescription" class="form-control" cols="50" rows="4" required></textarea><br />
                                <strong>Price</strong> <input type="text" class="form-control" name="price" required><br />
                                <strong>Set Image URL</strong> <input type="text" name="productImage" class="form-control" required><br />
                            </div>
                        
                            <div class="input-group">
                                <strong>Category</strong> 
                                <select name="catId" class="form-control" required>
                                    <option value="">Select One</option>
                                    <?php getCategories();?>
                                </select><br />
                                <input type="submit" name="submitProduct" class='btn btn-primary' value="Add Product">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</HTML>