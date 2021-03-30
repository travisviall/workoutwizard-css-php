<?php
session_start();
?>

<!doctype html>
<html lang="en">

    <head>
        <title>Line Chart</title>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"
        integrity="sha256-Uv9BNBucvCPipKQ2NS9wYpJmi8DTOEfTA/nH2aoJALw=" crossorigin="anonymous"></script>
        <script src="WorkoutWizard/js/utils.js"></script>
        <style>
            canvas {
                -moz-user-select: none;
                -webkit-user-select: none;
                -ms-user-select: none;
            }
        </style>
        <!-- Custom fonts for this template-->
        <!--    <link href="WorkoutWizard/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">-->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
              rel="stylesheet">

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
                    <!-- End of Topbar -->

                    <!-- Begin Page Content -->
                    <div class="container-fluid">

                        <!-- Page Heading -->
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">Progress</h1>
                            <!--                    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
                        </div>

                        <!-- CHART INFO -->
                        <div style="width:75%;">
                            <canvas id="canvas"></canvas>
                        </div>
                        <br>
                        <br>
                        <button id="randomizeData">Randomize Data</button>
                        <button id="addDataset">Add Dataset</button>
                        <button id="removeDataset">Remove Dataset</button>
                        <button id="addData">Add Month</button>
                        <button id="removeData">Remove Month</button>
                    </div>
                </div>
                <!-- End of Main Content -->

                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; Toaster Boiszs 2019</span>
                        </div>
                    </div>
                </footer>
            </div>
            <!-- End of Content Wrapper -->

            <?php
            session_start();


            require_once 'DBConnect.php';

            $query = "SELECT * from userInfo WHERE userID = '" . $_SESSION['userID'] . "'";

            $result = $con->query($query);

            while ($row = $result->fetch_assoc())
            {
                $userBMI = $row['userBMI'];
                $dateBMI = $row['dateBMI'];
            }
            
            ?>

            <script type="text/javascript">

                google.charts.load('current', {'packages': ['corechart']});
                google.charts.setOnLoadCallback(drawChart);

                //create a JS variable using a php value
                var userBMI = "<?php echo $userBMI; ?>";
                var dateBMI = "<?php echo $dateBMI?>";

                function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                        // need date BMI was input, if we don't have time just do a for loop and put 1, 2, 3...
                        [dateBMI, bmi],
                              for ($r = 0; $r <= $result->num_rows; $r++) {
                               // we want date instead of $r
                                 [$r, $row["userBMI"][$r]],
                              }
                        ['Test', bmi]
                                //   ['Task', 'Hours per Day'],
                                //   ['Work', 8],
                                //   ['Eat', 2],
                                //   ['TV', 4],
                                //   ['Gym', 2],
                                //   ['Sleep', 8]
                    ]);

                    // Optional; add a title and set the width and height of the chart
                    var options = {'title': 'BMI History', 'width': 550, 'height': 400};
                    // Display the chart inside the <div> element with id="piechart"
                    var chart = new google.visualization.LineChart(document.getElementById('linechart'));
                    chart.draw(data, options);
            </script>
        </div>
        
        <div id="linechart"></div>

        <script>
                var MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                var config = {
                    type: 'line',
                    data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul' , 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                        datasets: [{
                                label: 'Expected',
                                backgroundColor: window.chartColors.red,
                                borderColor: window.chartColors.red,
                                data: [
                                   userBMI,
                                   userBMI,
                                   userBMI
                                    
                                ],
                                fill: false,
                            }, {
                                label: 'Actual',
                                fill: false,
                                backgroundColor: window.chartColors.blue,
                                borderColor: window.chartColors.blue,
                                data: [
                                    
                                ],
                            }]
                    },
                    options: {
                        responsive: true,
                        title: {
                            display: true,
                            text: ''
                        },
                        tooltips: {
                            mode: 'index',
                            intersect: false,
                        },
                        hover: {
                            mode: 'nearest',
                            intersect: true
                        },
                        scales: {
                            xAxes: [{
                                    display: true,
                                    scaleLabel: {
                                        display: true,
                                        labelString: 'Month'
                                    }
                                }],
                            yAxes: [{
                                    display: true,
                                    scaleLabel: {
                                        display: true,
                                        labelString: 'Value'
                                    }
                                }]
                        }
                    }
                };
                window.onload = function () {
                    var ctx = document.getElementById('canvas').getContext('2d');
                    window.myLine = new Chart(ctx, config);
                };
                document.getElementById('randomizeData').addEventListener('click', function () {
                    config.data.datasets.forEach(function (dataset) {
                        dataset.data = dataset.data.map(function () {
                            return randomScalingFactor();
                        });
                    });
                    window.myLine.update();
                });
                var colorNames = Object.keys(window.chartColors);
                document.getElementById('addDataset').addEventListener('click', function () {
                    var colorName = colorNames[config.data.datasets.length % colorNames.length];
                    var newColor = window.chartColors[colorName];
                    var newDataset = {
                        label: 'Dataset ' + config.data.datasets.length,
                        backgroundColor: newColor,
                        borderColor: newColor,
                        data: [],
                        fill: false
                    };
                    for (var index = 0; index < config.data.labels.length; ++index) {
                        newDataset.data.push(randomScalingFactor());
                    }
                    config.data.datasets.push(newDataset);
                    window.myLine.update();
                });
                document.getElementById('addData').addEventListener('click', function () {
                    if (config.data.datasets.length > 0) {
                        var month = MONTHS[config.data.labels.length % MONTHS.length];
                        config.data.labels.push(month);
                        config.data.datasets.forEach(function (dataset) {
                            dataset.data.push(randomScalingFactor());
                        });
                        window.myLine.update();
                    }
                });
                document.getElementById('removeDataset').addEventListener('click', function () {
                    config.data.datasets.splice(0, 1);
                    window.myLine.update();
                });
                document.getElementById('removeData').addEventListener('click', function () {
                    config.data.labels.splice(-1, 1); // remove the label first
                    config.data.datasets.forEach(function (dataset) {
                        dataset.data.pop();
                    });
                    window.myLine.update();
                }
                );
        </script>

        <!-- Bootstrap core JavaScript-->
        <script src="WorkoutWizard/vendor/jquery/jquery.min.js"></script>
        <script src="WorkoutWizard/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    </body>

</html>