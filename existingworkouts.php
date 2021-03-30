<?php
session_start();
require_once 'DBConnect.php';

//retrieve workout data from database
$query_workouts = "SELECT * FROM workOuts WHERE USERNAME = '" . $_SESSION['userName'] . "'";

$result = $con->query($query_workouts);

while ($row = $result->fetch_assoc())
{
    $workoutArray [] = $row["workOutName"];
    $workoutIDs [] = $row["idWorkOuts"];
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Existing Workouts - Workout Wizard</title>

        <!-- Custom fonts for this template-->
        <link href="WorkoutWizard/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="WorkoutWizard/css/sb-admin-2.css" rel="stylesheet">
        <link href="WorkoutWizard/css/custom.css" rel="stylesheet">
        <style>
            .hiddenClick {
                visibility: hidden;
            }

            input {
                text-align: center;                
            }

            .form-control.optionStyle {
                background-color: #3c216e;
                color: #f8f7fa;
                font-weight: bold;
            }

            .list-group-item.form-background {
                background-color: #dfd5e8;
                color: #1e1d1f;
            }

            .workOutName {
                color: #1e1d1f;
            }

            a, a:hover,a:visited, a:focus {
                text-decoration:none;
            }

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
                            <a class="logout" href="logout.php" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-fw fa-chart-area"></i>
                                Logout
                            </a>
                        </ul>
                    </nav>
                    <!--***********************************START FORM HERE**************************************-->
                    <div class="container-fluid">

                        <!-- Page Heading -->
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h2>Existing Workouts</h2>
                        </div>
                        <div class="row">
                            <?php
                            foreach ($workoutArray as $w)
                            {
                                
                                echo "<div class='col-xl-3 col-md-6 mb-4'><br>";
                                echo "<div class='card border-left-primary shadow h-100 py-2' style='width: 18rem;'><br>";
                                echo "<a href='startworkout.php?workOutName=" . $w . "' class='workoutname' id='" . $w . "'>";
                                echo "<div class='card-body'><br>";
                                echo "<div class='row no-gutters align-items-center'><br>";
                                echo "<div class='col mr-2'>";
                                echo "<div class='text-xs font-weight-bold text-primary text-uppercase mb-1'><h2>" . $w . "</a></h2></div>";
                                echo "<div class='h5 mb-0 font-weight-bold text-gray-800'></div>";
                                echo "</div>";
                                echo "<div class='col-auto'>";
                                echo "<i class='fas fa-calendar fa-2x text-gray-300'></i>";
                                echo "</div></div></div></div></div>";
                            }
                            ?>
                            <!-- Earnings (Monthly) Card Example -->
                        </div>

                    </div>
                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; Toaster Boiszs 2019</span>
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
                        <a class="btn btn-primary" href="logout.php">Logout</a>
                        
                        <?php
                        
                        ?>
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
                /*$('.workoutname').click(function () {
                 var id = $(this).attr('id');
                 //$.post("phpTest.php", {"workOutName": id});
                 //window.location = 'phpTest.php';
                 alert(id);
                 });//get id of clicked div*/
            });

        </script>
    </body>

</html>
