<script>
    function updated(){
        return alert("Product has been updated!");
    }
</script>

<?php
    include 'dbConnection.php';
    session_start();
    $connection=getDatabaseConnection("ottermart");
    
    if(!isset($_SESSION['adminName'])){
        header("Location:index.php");
    }
    
    if(isset($_GET['updateProduct'])){
        $sql="UPDATE om_product
              SET productName = :productName,
                  productDescription = :productDescription,
                  productImage = :productImage,
                  price = :price,
                  catId = :catId
              WHERE productId = :productId";
        $np = array();
        $np[":productName"] = $_GET['productName'];
        $np[":productDescription"] = $_GET['productDescription'];
        $np[":productImage"] = $_GET['productImage'];
        $np[":price"] = $_GET['price'];
        $np[":catId"] = $_GET['catId'];
        $np[":productId"] = $_GET['productId'];
        
        $statement=$connection->prepare($sql);
        $statement->execute($np);
        echo "<script>updated();</script>";
    }
    
    
    if(isset($_GET['productId'])){
        $product=getProductInfo();
    }

    function getProductInfo(){
        global $connection;
        $sql="SELECT * FROM om_product WHERE productId=".$_GET['productId'];
        
        $statement=$connection->prepare($sql);
        $statement->execute();
        $record=$statement->fetch(PDO::FETCH_ASSOC);
        
        
        return $record;
        
    }

    function getCategories($catId){
        global $connection;
       
        $sql="SELECT catId, catName FROM om_category ORDER BY catName";
        
        $statement=$connection->prepare($sql);
        $statement->execute();
        $records=$statement->fetchAll(PDO::FETCH_ASSOC);
        
        foreach($records as $record){
         
            echo "<option value='".$record['catId']."' ".(($record['catId']==$catId)? ' selected ': ''). ">";
            echo  $record['catName']." </option>";
        }
    }
    
?>



<!DOCTYPE html>
<HTML lang='en'>
    <head>
        <title>Update Product</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <div class="jumbotron">
                <h2>Update Product</h2>
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
                        <div class="form-group">
                            <div class="input-group">
                                <input type="hidden" name="productId" value= "<?=$product['productId']?>"/>
                                <strong>Product Name</strong> <input type="text" class="form-control" value="<?=$product['productName']?>" name="productName" required><br />
                                <strong>Description</strong> <textarea name="productDescription" class="form-control" cols="50" rows="4" required><?=$product['productDescription']?></textarea><br />
                                <strong>Price</strong> <input type="text" class="form-control" name="price" value="<?=$product['price']?>" required>
                                <br />
                                <br />
                                <strong>Set Image Url</strong> <input type="text" class="form-control" name="productImage" value="<?=$product['productImage']?>" required>
                                <br />
                            </div>
                            <div class="input-group">
                                <strong>Category</strong>
                                <select name="catId" class="form-control" required>
                                    <option value="">Select One</option>
                                    <?php getCategories($product['catId']);?>
                                </select> <br />
                                <input type="submit" class'btn btn-primary' name="updateProduct" value="Update Product">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</HTML>