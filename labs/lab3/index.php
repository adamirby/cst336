<?php
    $backgroundImage = "img/sea.jpg";
    // API call goes here
    if(isset($_GET['keyword'])) {
        include 'api/pixabayAPI.php';
        $imageURLs = getImageURLs($_GET['keyword'], $_GET['layout']);
        $backgroundImage = $imageURLs[array_rand($imageURLs)];
    }
    
?>

<!DOCTYPE html>
<html lang='en'>
    <head>
        <title>Image Carousel</title>
        <meta charset="utf-8">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
        
        <style>
            @import url('css/styles.css');
            body {
                background-image: url('<?=$backgroundImage?>');
                background-size: 100% 100%;
                background-attachment: fixed;
            }
        </style>
    </head>
    <body>
        <br/><br/>
        
        <!-- HTML form goes here! -->
        <form>
            <input type="text" name="keyword" placeholder="keyword" value="<?=$_GET['keyword']?>"/>
            <input type="radio" id="lhorizontal" name="layout" value="horizontal">
            <label for="Horizontal"></label><label for="'horizontal">Horizontal</label>
            <input type="radio" id="lvertical" name="layout" value="vertical">
            <label for="Vertical"></label><label for="lvertical">Vertical</label>
            <select name="keyword">
                <option value="">Select One</option>
                <option value="ocean">Sea</option>
                <option value="forest">Forest</option>
                <option value="mountain">Mountain</option>
                <option value="snow">Snow</option>
                <option value="otters">Otters</option>
                <option value="lemurs">Lemurs</option>
            </select>
            <input type="submit" value="Search" />
        </form>
        <br/><br/>
        
        <?php
            if(!isset($imageURLs) || $_GET['keyword'] == "" ) { //form has not been submitted
                echo "<h2> Type a keyword to display a slideshor <br /> with random images from Pixabay.com </h2>";
            } else { //form was submitted
                //Display Carousel Here
        ?>
        
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <!-- Indicatiors Here -->
                    <ol class="carousel-indicators">
                        <?php
                            for($i=0; $i < 7; $i++){
                                echo "<li data-target='#carousel-example-generic' data-slide-to='$i'";
                                echo ($i==0)? "class='active'":"";
                                echo "></li>";
                            }
                        ?>
                    </ol>
                    
                    <!-- Wrapper for Images -->
                    <div class="carousel-inner" role="listbox">
                    <?php
                        for($i=0; $i < 7; $i++) {
                            do {
                                $randomIndex = rand(0, count($imageURLs));
                            }
                            while (!isset($imageURLs[$randomIndex]));
                            
                            echo '<div class="carousel-item ';
                            echo ($i == 0)?"active":"";
                            echo '">';
                            echo '<img src="' . $imageURLs[$randomIndex] . '">';
                            echo '</div>';
                            unset($imageURLs[$randomIndex]);
                        }
                    ?>   
                    </div>
                   
                 
                    <!-- Controls Here -->
                    <a class="carousel-control-prev" href="#carousel-example-generic" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carousel-example-generic" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div> 
                    
        <?php        
            } //endElse
        ?>
         <br />          
    </body>
</html>