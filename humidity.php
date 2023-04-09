<?php

include('php/config.php');

$SQL = "SELECT * FROM `sensor_box_01` LIMIT 5;";

$stmt = $conn->prepare($SQL);

$stmt->execute();

$sensor_data = $stmt->get_result();

?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Charts - SB Admin</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.html">Start Bootstrap</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Settings</a></li>
                    <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="#!">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
        <?php include'sidebar.php' ?>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Charts</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Humidity</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-body">
                            Chart.js is a third party plugin that is used to generate the charts in this template. The charts below have been customized - for further customization options, please visit the official
                            <a target="_blank" href="https://www.chartjs.org/docs/latest/">Chart.js documentation</a>
                            .
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-area me-1"></i>
                            Area Chart Example
                        </div>
                        <!--<div class="card-body"><canvas id="myAreaChart" width="100%" height="30"></canvas></div>-->
                        <!--<div class="card-body"><canvas id="line_graps" style="width:100%;max-width:600px"></canvas></div>-->
                        <div class="card-body"><canvas id="areaChart" width="100%" height="30"></canvas></div>
                        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-bar me-1"></i>
                                    Bar Chart Example
                                </div>
                                <!--<div class="card-body"><canvas id="myBarChart" width="100%" height="50"></canvas></div>-->
                                <!--<div id="piechart" style="width:100%; max-width:600px; height:500px;"></div>-->
                                <div class="card-body"><canvas id="myChart2" style="width:100%; max-width:600px"></canvas></div>
                                <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-pie me-1"></i>
                                    Pie Chart Example
                                </div>
                                <!--<div class="card-body"><canvas id="myPieChart" width="100%" height="50"></canvas></div>-->
                                <!--<div id="myChart" style="width:100%; max-width: 900px; height:500px;"></div>-->
                                <div class="card-body"><canvas id="myChart" style="width:100%;max-width:600px"></canvas></div>
                                <div class="card-footer small text-muted">Updated <?php echo date("Y.m.d") ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2023</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    
    <script src="js/scripts.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <!-- SCRIPT FOR PIE-CHART-->

    <script>
        var yValues = [];

        var xValues = [];

        <?php foreach ($sensor_data as $row) {

            $humidity = (float)$row['Humidity'];

            $record_time = $row['Record_ID'];
        ?>

            yValues.push(<?php echo $humidity; ?>);

            xValues.push(<?php echo $record_time; ?>);

        <?php } ?>

        var barColors = [
            "#b91d47",
            "#00aba9",
            "#2b5797",
            "#e8c3b9",
            "#1e7145"
        ];

        new Chart("myChart", {
            type: "pie",
            data: {
                labels: xValues,
                datasets: [{
                    backgroundColor: barColors,
                    data: yValues
                }]
            },
            options: {
                title: {
                    display: true,
                    text: "World Wide Wine Production 2018"
                }
            }
        });
    </script>


    <!-- SCRIPT FOR BAR-CHART-->

    <script>
        var yValues = [];

        var xValues = [];

        <?php foreach ($sensor_data as $row) {

            $humidity = (float)$row['Humidity'];

            $record_id = $row['Record_ID'];

        ?>

            yValues.push(<?php echo $humidity; ?>);

            xValues.push(<?php echo $record_id; ?>);

        <?php } ?>

        var barColors = ["red", "green", "blue", "orange", "brown"];

        new Chart("myChart2", {
            type: "bar",
            data: {
                labels: xValues,
                datasets: [{
                    backgroundColor: barColors,
                    data: yValues
                }]
            },
            options: {
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: "World Wine Production 2018"
                }
            }
        });
    </script>







<script>
var xValues = [];

var yValues = [];

<?php foreach($sensor_data as $row){

$temp =  (float)$row['Temperature'];

$humidity = (float)$row['Humidity'];

$time = $row['Record_Time'];

?>

xValues.push('<?php echo $time; ?>');

yValues.push(<?php echo $humidity; ?>);


<?php }?>

console.log(xValues);

console.log(yValues);

new Chart("areaChart", {
  type: "line",
  data: {
    labels: xValues,
    datasets: [{
      fill: false,
      lineTension: 0,
      backgroundColor: "rgba(0,0,255,1.0)",
      borderColor: "rgba(0,0,255,0.1)",
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    scales: {
      yAxes: [{ticks: {min: 0, max:100}}],
    }
  }
});
</script>





    <script>
        const xValues = [];

        const yValues = [];

        <?php foreach ($sensor_data as $row) {

            $humidity = (float)$row['Humidity'];

            $temperature = (float)['Temperature'];

        ?>

            yValues.push(<?php echo $humidity; ?>);

            xValues.push(<?php echo $temperature; ?>);

        <?php } ?>

        new Chart("line_graps", {
            type: "line",
            data: {
                labels: xValues,
                datasets: [{
                    fill: false,
                    lineTension: 0,
                    backgroundColor: "rgba(0,0,255,1.0)",
                    borderColor: "rgba(0,0,255,0.1)",
                    data: yValues
                }]
            },
            options: {
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            min: 6,
                            max: 16
                        }
                    }],
                }
            }
        });
    </script>

    <script>
        google.charts.load('current', {
            packages: ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            const data = google.visualization.arrayToDataTable([
                ['Price', 'Size'],

                <?php foreach ($sensor_data as $row) {
                    $temp =  (float)$row['Temperature'];

                    $humidity = (float)$row['Humidity'];
                ?>

                    [<?php echo $temp ?>, <?php echo $humidity ?>],

                <?php } ?>
            ]);

            const options = {
                title: 'House Prices vs. Size',
                hAxis: {
                    title: 'Square Meters'
                },
                vAxis: {
                    title: 'Price in Millions'
                },
                legend: 'none'
            };
            // Draw
            const chart = new google.visualization.LineChart(document.getElementById('myChart3'));
            chart.draw(data, options);
        }
    </script>

</body>

</html>