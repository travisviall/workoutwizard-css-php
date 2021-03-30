<?php

session_start();
session_unset();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Workout Wizard</title>

        <!-- Bootstrap core CSS -->
        <link href="WorkoutWizard/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="WorkoutWizard/css/modern-business.css" rel="stylesheet">
        <style>
            #home{
                /*background-color: black;*/
                margin-top: 50px;
                text-align: center;
            }

            .labelColor{
                /*color: white;*/
            }

            .error{
                color: red;
                text-transform: capitalize;
            }

        </style>
    </head>

    <body>

        <!-- Navigation -->
        <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top navbar-custom">
            <div class="container">
                <a class="navbar-brand" id="title" href="index.php">WORKOUT WIZARD</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="about.html">About</a>
                        </li>
                      
                        <li class="nav-item">
                            <a class="nav-link" href="createaccount.html">Create Account</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="login.html">LOGIN</a>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>

        <header>
            <div>
            </div>
        </header>

        <!-- Page Content -->
        <div class="container">

            <!--login goes here-->
            <div class='jumbotron' id="home">
                <h4 class="display-4" id="title">Login</h4>
                <hr class="my-4">
                <div class="col-md-10 mx-auto">
                    <form name="myForm" action="logincheck_.php" method="post" role="form">
                        <div class='form-group row justify-content-center'>
                            <div class="col-sm-6">
                            <label>Username:</label>
                            <input type='text' class='form-control' id='userName'  name="userName" required>
                            </div>
                        </div>
                        <div class='form-group row justify-content-center'>
                            <div class="col-sm-6">
                            <label>Password:</label>
                            <input type='password' class='form-control' id='password' name="password" required>
                            </div>
                        </div>
                        <div class='form-group row justify-content-center'>
                            <div class='col-lg-6'>
                                <button type='submit' class='btn btn-primary px-3'>Login</button>
                                <!--onclick="return(validate())-->
                            </div>
                        </div>
                    </form>
                </div>
            </div>


        </div>
        <!-- /.container -->

        <!-- Footer -->
        <footer class="py-5 bg-dark">
            <div class="container">
                <p class="m-0 text-center text-white">Copyright &copy; Your Website 2019</p>
            </div>
            <!-- /.container -->
        </footer>

        <!-- Bootstrap core JavaScript -->
        <script src="WorkoutWizard/vendor/jquery/jquery.min.js"></script>
        <script src="WorkoutWizard/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
