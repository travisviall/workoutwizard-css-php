<?php
session_start();

require_once "DBConnect.php";

$query_columns = mysqli_query($con, 'SHOW COLUMNS FROM  workOuts');
//adds column names to an array
while ($row = mysqli_fetch_object($query_columns))
{
    //echo $row->Field . "<br>";
    $columns[] = $row->Field;
}
//removes the first 4 columns from the array (these are not metrics to track)
$columns = array_slice($columns, 4);
?>
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <!--testing-->
        <title>Workout Wizard -Dashboard</title>

        <!-- Custom fonts for this template-->
        <link href="WorkoutWizard/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="WorkoutWizard/css/sb-admin-2.css" rel="stylesheet">
        <link href="WorkoutWizard/css/custom.css" rel="stylesheet">
        <style>
            .logout{
                color:white;
                font-size:16px;
            }
        </style>

    </head>

    <body id="page-top">

        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Sidebar -->
            <ul class="navbar-nav bg-dark sidebar sidebar-dark accordion" id="accordionSidebar">

                <!-- Sidebar - Brand -->
                <li class="sidebar-brand d-flex align-items-center justify-content-center">
                    <div class="sidebar-brand-icon rotate-n-15">
                        <i class="fas fa-laugh-wink"></i>
                    </div>
                    <!--<div class="sidebar-brand-text mx-1" id="header-color">Workout Wizard</div>-->
                    <!-- Divider -->
                    <hr class="sidebar-divider my-0">

                    <!-- Nav Item - Dashboard -->
                <li class="nav-item active">
                    <a class="dashboard nav-link" href="dashboard.php">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span></a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    Workout Wizard Options
                </div>

                <!-- Nav Item - Create New Workout -->
                <li class="nav-item">
                    <a class="nav-link" href="createworkout.html">
                        <i class="fas fa-fw fa-cog"></i>
                        <span>Create New Workout</span>
                    </a>
                </li>

                <!-- Nav Item - Resume Previous Workout -->
                <li class="nav-item">
                    <a class="nav-link" href="existingworkouts.php">
                        <i class="fas fa-fw fa-wrench"></i>
                        <span>Resume Previous Workout</span>
                    </a>
                </li>
                <!-- Nav Item - Set Goals -->
                <li class="nav-item">
                    <a class="nav-link" href="setGoal.php">
                        <i class="fas fa-fw fa-folder"></i>
                        <span>Set Goals</span>
                    </a>
                </li>

                <!-- Nav Item - Stats -->
                <li class="nav-item">
                    <a class="nav-link" href="stats.php">
                        <i class="fas fa-fw fa-chart-area"></i>
                        <span>View Statistics</span></a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block">
            </ul>
            <!-- End of Sidebar -->

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Topbar -->
                    <nav class="navbar navbar-expand navbar-light topbar mb-4 static-top shadow bg-secondary text-center">
                        <div id="title">Workout Wizard</div>
                        <!-- Sidebar Toggle (Topbar) -->
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                        <!-- Topbar Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Nav Item - User Information -->
                            <!-- Dropdown - User Information -->

                            <div class="nav-item"></div>
                            <a class="logout" href="login.html" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-fw fa-chart-area"></i>
                                Logout
                            </a>
                        </ul>
                    </nav>
                    <!-- End of Topbar -->

                    <!-- Begin Page Content -->
                    <div class="container-fluid">

                        <!-- Page Heading -->
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800"></h1>
                        </div>

                        <!-- Content Row -->


                        <!-- Content Row -->

                        <div class="row">
                        </div>

                        <!-- Content Row -->
                        <div class="row">

                            <!-- Content Column -->
                            <div class="col-lg-6 mb-4">

                                <!-- Project Card Example -->
                                <div class="card shadow mb-4">

                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Set Goals!</h6>
                                    </div>
                                    <div class="col-md-6">
                                        <form name="setGoals" action="submitGoals.php" method="post">
                                            <div class='form-group row justify-content-center'>
                                                <div class="card-body">  
                                                    <?php
                                                    //assign variables from session variables
                                                    $weight = $_SESSION['userWeight'];
                                                    $heightF = $_SESSION['userHeightF'];
                                                    $heightI = $_SESSION['userHeightI'];

                                                    echo"<p><strong>Current Weight: </strong>" . $weight . "Lbs</p>";
                                                    echo"<p><strong>Current Height: </strong>" . $heightF . "ft " . $heightI . "in</p>";
                                                    echo" <label class='labelColor' id='firstLabel' >Target Weight:</label>";
                                                    echo"<input type='text' class='form-control' id='targetWeight' name='targetWeight' onkeyup='bmi(), weightChange()'>";
                                                    echo "<br>";
                                                    echo" <label class='labelColor' id='firstLabel' >Target BMI:</label>";
                                                    echo "<br><small><a href='https://bmicalculatorusa.com/' target='_blank'>Calculate BMI</a></small>";
                                                    echo"<input type='text' class='form-control' id='targetBMI' name='targetBMI' onkeyup='bmi(), weightChange()' >";
                                                    echo "<br>";
                                                    
                                                    echo "<class=''><label for = 'workouts'>Select Goal:</label>";
                                                    echo "<select name='goals' id='goals' class = 'form-control dropdown'>";
                                                    echo "<option value=''></option>";
                                                                                                        
                                                    foreach ($columns as $a)
                                                    {
                                                        echo "<option value='". $a ."'>". $a ."</option>";
                                                        
                                                    }
                                                    
                                                    echo "</select>";
                                                    echo "<br>";
                                                    echo" <label class='labelColor' id='goalLabel' hidden >Goal Value: </label>";
                                                    echo "<input type='text' class='form-control' id='goalValue' name='goalValue' required hidden>";
                                                    
                                                    ?>
                                                    <br>
                                                    <button type='submit' class='btn btn-primary px-3' style="padding: 5px 10px;" onclick="">Submit</button>                                          
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-md-6">

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-4">
                                <!-- Illustrations -->
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Get Pumped, <?php echo " " . $_SESSION['firstName'] . "!"; ?></h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="text-center">
                                            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="WorkoutWizard/img/bigguy.jfif" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.container-fluid -->
                </div>
                <!-- End of Main Content -->
                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; Your Website 2019</span>
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->
            </div>
            <!-- End of Content Wrapper -->
        </div>
        <!-- End of Page Wrapper -->
        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>
        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="login.html">Logout</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Bootstrap core JavaScript-->
        <script src="WorkoutWizard/vendor/jquery/jquery.min.js"></script>
        <script src="WorkoutWizard/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- Core plugin JavaScript-->
        <script src="WorkoutWizard/vendor/jquery-easing/jquery.easing.min.js"></script>
        <!-- Custom scripts for all pages-->
        <script src="WorkoutWizard/js/sb-admin-2.min.js"></script>
        <!-- Page level plugins -->
        <script src="WorkoutWizard/vendor/chart.js/Chart.min.js"></script>
        <!-- Page level custom scripts -->
        <script src="WorkoutWizard/js/demo/chart-area-demo.js"></script>
        <script src="WorkoutWizard/js/demo/chart-pie-demo.js"></script>
        <script>
            $(document).ready(function () {
                 $('select[name="goals"]').change(function () {
                     //alert("this worked");
                     $('#goalValue').removeAttr('hidden');
                     $('#goalLabel').removeAttr('hidden');
                 });//change
            });//ready
        </script>
    </body>
</html>