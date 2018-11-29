<?php
    include 'inc/header.php';
    
    
    function getPetPictures(){
        include 'dbConnection.php';
        $conn=getDatabaseConnection("pets");
        
        $sql="SELECT pictureURL FROM pets";
        
        $stmt=$conn->prepare($sql);
        $stmt->execute();
        $record=$stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $record;
    }
?>
    <div id="petCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicatiors Here -->
        <ol class="carousel-indicators">
            <?php
                $petArray = getPetPictures();
                for($i=0; $i < sizeof($petArray); $i++){
                    echo "<li data-target='#petCarousel' data-slide-to='$i'";
                    echo ($i==0)? "class='active'":"";
                    echo "></li>";
                }
            ?>
        </ol>
            
        <!-- Wrapper for Images -->
        <div class="carousel-inner" role="listbox">
            <?php
                $counter=0;
                foreach($petArray as $pet){
                    echo "<div class='carousel-item ";
                    echo ($counter == 0)?"active":"";
                    echo "'>";
                    echo "<img src='img/".$pet['pictureURL']."'>";
                    echo "</div>";
                    $counter++;
                }
            ?>

        </div>
               
             
        <!-- Controls Here -->
          <a class="carousel-control-prev" href="#petCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#petCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div> 

    <br /><br />
    <a class="btn btn-outline-primary" href="pets.php" role="button">Adopt now! </a>
    <br /><br />
    

<?php
    include 'inc/footer.php';
?>