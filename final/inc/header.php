<?php
    include 'inc/functions.php';
?>

<!DOCTYPE html>
<html lang='en'>
    <head>
        <title>Used VHS Emporium</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="js/functions.js"></script>
        <style>
            @import URL('css/styles.css');
        </style>
    </head>
    <body>
        <!-- Navbar here -->
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <div class='navbar-header'>
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#headerNav">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Used VHS Emporium</a>
                </div>
                
                <div class="collapse navbar-collapse" id="headerNav">
                        
                    <ul class="nav navbar-nav">
                        <li class="active"> <!-- change active depending on what page user is on -->
                                <a href="#"><i class="glyphicon glyphicon-home" aria-hidden='true'></i>&nbsp;Home</a>
                        </li> 
                        <li>
                            <a href="#"><i class="glyphicon glyphicon-film" aria-hidden='true'>&nbsp;Inventory</i></a>
                        </li>
                        <!-- Only display if admin is logged in -->
                        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Admin&nbsp;<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Admin Page 1</a></li>
                        </ul>
                        </li>
                        <li>
                            <form class="navbar-form">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <div class="input-group-btn">
                                        <button class="btn btn-default" type="submit">
                                            <i class="glyphicon glyphicon-search" aria-hidden='true'></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </li>
                    </ul>
                    
                    
                    <!-- Signup/login here -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- If user is logged in then show cart here with cart count here-->
                        <li>
                            <a href='#'>
                            <span class='glyphicon glyphicon-shopping-cart' aria-hidden='true'>
                                
                            </span>&nbsp;Cart: 0</a>
                        </li>
                      <li><a href="#" id="signupBtn"><span class="glyphicon glyphicon-user" aria-hidden='true'></span>&nbsp;Sign Up</a></li>
                      <!-- Switch to logout when user is logged in? -->
                      <li><a href="#" id="loginBtn"><span class="glyphicon glyphicon-log-in" aria-hidden='true'></span>&nbsp;Login</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <!--Modals-->
        <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h5 class="modal-tital" id="loginModalLabel"></h5>
                    </div>
                    <div class="modal-body">
                        <div id="login"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h5 class="modal-tital" id="signupModalLabel"></h5>
                    </div>
                    <div class="modal-body">
                        <div id="signup"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <script>
