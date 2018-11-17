<?php
    session_start();
?>

<!DOCTYPE html>
<HTML lang='en'>
    <head>
        <title>Login</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Allerta+Stencil" rel="stylesheet"> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>

    <body>
        <div class="container">
            <div class="jumbotron">
                <h2>Ottermart Admin Login</h2>
            </div>
        
        
            <form method="POST" action="loginProcess.php">
                <div class="form-group">
                    <span class="adminPrompt">Username:</span>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input type="text" name="username" class="form-control"/> <br />
                    </div>
                </div>
                
                <div class="form-group">
                    <span class="adminPrompt">Password: </span>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input type="password" name="password" class="form-control"/> <br />
                    </div>
                </div>
                <div class="btn-group">
                    <div class="col-md-4">        
                        <input type="submit" name="submitForm" value="Login!" class="btn btn-default"/>
                    </div>
                </div>
                <br /><br />
                <?php
                    if($_SESSION['incorrect']){
                        echo "<p class='lead' id='error' style='color:red'>";
                        echo "<strong>Incorrect Username or Password!</string></p>";
                    }
                ?>
            </form>
        </div>
    </body>
</HTML>