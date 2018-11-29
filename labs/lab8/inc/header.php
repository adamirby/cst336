<!DOCTYPE html>
<html lang="en">
    <head>
        <title> CSUMB: Pet Shelter </title>
        <meta charset='utf-8'>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
        
        <style>
            @import URL('css/styles.css');
        </style>
   
    </head>
    <body>
        
	<!--Add main menu here -->
        
        <nav class="navbar navbar-expand-lg navbar-light bg-primary">
            <a class="navbar-brand" href="https://csumb.edu">CSUMB</a>
            <button class="navbar-toggler" type="button" data-toggle="callopse" data-target="#navbarNavAltMarkup"
              aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle Navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="callopse navbar-callopse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link <?=($_SERVER['PHP_SELF']=='/labs/lab8/pet_shelter.php'?'active':'')?>" href="pet_shelter.php">Home<span class="sr-only">(current)</span></a>
                    <a class="nav-item nav-link <?=($_SERVER['PHP_SELF']=='/labs/lab8/pets.php'?'active':'')?>" href="pets.php">Adoptions</a>
                </div>
            </div>
        </nav>
        
        <div class="jumbotron">
          <h1> CSUMB Animal Shelter</h1>
          <h2> The "official" animal adoption website of CSUMB </h2>
        </div>
      