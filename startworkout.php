<?php
session_start();

$_SESSION['workOutName'] = htmlentities(stripslashes(htmlspecialchars($_GET['workOutName'])));
$workoutname = $_SESSION['workOutName'];


require_once "DBConnect.php";

//get columns names from database
$query_columns = mysqli_query($con, 'SHOW COLUMNS FROM  workOuts');

//adds column names to an array
while ($row = mysqli_fetch_object($query_columns))
{

    //echo $row->Field . "<br>";
    $columns[] = $row->Field;
}

//removes the first 4 columns from the array
$columns = array_slice($columns, 4);

//get values from the table for the specified idWorkOuts
//*****need to change to the workout ID from 
$query_data = mysqli_query($con, "SELECT * FROM workOuts WHERE workOutName = '" . $_SESSION['workOutName']
        . "' AND userName = '" . $_SESSION['userName'] . "'");

while ($row = mysqli_fetch_array($query_data))
{
    //loop through each column name in the array
    foreach ($columns as $column)
    {
        //if the value for the column is set to >= 0
        if (is_numeric($row[$column]))
        {
            //array that holds only columns with a 0 value
            $form_columns[] = $column;
            //echo $column . " value is " . $row[$column] . "<br>";
        }
    }
}

$query_workoutID = mysqli_query($con, "SELECT idworkOuts FROM workOuts WHERE workOutName = '" . $_SESSION['workOutName']
        . "' AND userName = '" . $_SESSION['userName'] . "'");

while ($row = mysqli_fetch_assoc($query_workoutID))
{
    $workoutID = $row['idworkOuts'];
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

        <title>Start Workout - Workout Wizard</title>

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
                    <a class="nav-link" href="setGoal.html">
                        <i class="fas fa-fw fa-folder"></i>
                        <span>Set Goals</span>
                    </a>
                </li>

                <!-- Nav Item - Stats -->
                <li class="nav-item">
                    <a class="nav-link" href="stats.html">
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
                    <!--***********************************START FORM HERE**************************************-->
                    <div class="container-fluid">

                        <!-- Page Heading -->
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h2>Workout: <?php echo " " . $workoutname; ?></h2>

                        </div>
                        <small>Enter in repetitions for each workout and press 'Save Workout Data'.</small>
                        <br>
                        <br>
                        <form name='startWorkout' action='submitworkout.php'  method="post" role="form">
                            <div class='row'>

                                <?php
                                foreach ($form_columns as $a)
                                {
                                    echo "<div class='col-sm-3'>";
                                    echo "<label>" . $a . "</label>";
                                    echo "<input type='text' class='form-control' id='" . $a . "' name='" . $a . "'>";
                                    echo "<br>";
                                    echo "</div>";
                                    
                                }
                                ?>
                                
                            </div>
                            <button type='submit' class='btn btn-primary mt-3 mb-3' id="save">Save Workout Data</button>
                        </form>
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
                $('select[name="workouts"]').change(function () {

                    //saves selection in variable
                    var selection = $(this).val();

                    if (!$("#field_one").val())
                    {
                        $('#field_one').removeAttr('hidden');
                        $("#field_one").val(selection);

                    } else if (!$("#field_two").val())
                    {
                        $('#field_two').removeAttr('hidden');
                        $("#field_two").val(selection);

                    } else if (!$("#field_three").val())
                    {
                        $('#field_three').removeAttr('hidden');
                        $("#field_three").val(selection);
                    } else if (!$("#field_four").val())
                    {
                        $('#field_four').removeAttr('hidden');
                        $("#field_four").val(selection);
                    } else if (!$("#field_five").val())
                    {
                        $('#field_five').removeAttr('hidden');
                        $("#field_five").val(selection);
                    } else if (!$("#field_six").val())
                    {
                        $('#field_six').removeAttr('hidden');
                        $("#field_six").val(selection);
                    } else if (!$("#field_seven").val())
                    {
                        $('#field_seven').removeAttr('hidden');
                        $("#field_seven").val(selection);
                    } else if (!$("#field_eight").val())
                    {
                        $('#field_eight').removeAttr('hidden');
                        $("#field_eight").val(selection);
                    } else if (!$("#field_nine").val())
                    {
                        $('#field_nine').removeAttr('hidden');
                        $("#field_nine").val(selection);
                    } else if (!$("#field_ten").val())
                    {
                        $('#field_ten').removeAttr('hidden');
                        $("#field_ten").val(selection);
                    } else if (!$("#field_eleven").val())
                    {
                        $('#field_eleven').removeAttr('hidden');
                        $("#field_eleven").val(selection);
                    } else if (!$("#field_twelve").val())
                    {
                        $('#field_twelve').removeAttr('hidden');
                        $("#field_twelve").val(selection);
                    }

                    $('#workouts').val('');
                });//dropdown change

                $('#reset').click(function () {
                    $('[id^=field]').attr('hidden', true);
                });//reset button

                $('#create').click(function () {

                    if ($('#workOutName').val() === '')
                    {
                        event.preventDefault();
                        alert("Enter workout name");
                    }
                });



            });//ready
        </script>
    </body>

</html>
