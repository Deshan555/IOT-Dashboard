<?php

include('php/config.php');

$SQL = "SELECT * FROM `sensor_box_02` LIMIT 5;";

$stmt = $conn->prepare($SQL);

$stmt->execute();

$sensor_data = $stmt->get_result();

?>

<!DOCTYPE html>

<html lang="en">

<?php include 'assets/components/head.php' ?>

<body class="sb-nav-fixed">

    <?php include 'assets/components/navbar.php' ?>

    <?php include 'sidebar.php' ?>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Water Level</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">WaterLevel</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-body">
                        This dashboard uses line charts, pie charts, and bar charts to display Water Level statistics for the given time period. Using datatable, you may view more information
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-area me-1"></i>
                        Area Chart
                    </div>
                    <!--<div class="card-body"><canvas id="myAreaChart" width="100%" height="30"></canvas></div>-->
                    <!--<div class="card-body"><canvas id="line_graps" style="width:100%;max-width:600px"></canvas></div>-->
                    <div class="card-body"><canvas id="areaChart" width="100%" height="30"></canvas></div>
                    <div class="card-footer small text-muted">Last Updated <?php echo date("Y.m.d") ?></div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-bar me-1"></i>
                                Bar Chart
                            </div>
                            <!--<div class="card-body"><canvas id="myBarChart" width="100%" height="50"></canvas></div>-->
                            <!--<div id="piechart" style="width:100%; max-width:600px; height:500px;"></div>-->
                            <div class="card-body"><canvas id="myChart2" style="width:100%; max-width:600px"></canvas></div>
                            <div class="card-footer small text-muted">Last Updated <?php echo date("Y.m.d") ?></div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-pie me-1"></i>
                                Pie Chart
                            </div>
                            <!--<div class="card-body"><canvas id="myPieChart" width="100%" height="50"></canvas></div>-->
                            <!--<div id="myChart" style="width:100%; max-width: 900px; height:500px;"></div>-->
                            <div class="card-body"><canvas id="myChart" style="width:100%;max-width:600px"></canvas></div>
                            <div class="card-footer small text-muted">Last Updated <?php echo date("Y.m.d") ?></div>
                        </div>
                    </div>
                </div>

                <?php

                $SQL = "SELECT * FROM `sensor_box_02`;";

                $stmt = $conn->prepare($SQL);

                $stmt->execute();

                $all_data = $stmt->get_result();

                ?>

                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        DataTable
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>Record ID</th>
                                    <th>Record Date</th>
                                    <th>Record Time</th>
                                    <th>Water Level (lv/100)</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Record ID</th>
                                    <th>Record Date</th>
                                    <th>Record Time</th>
                                    <th>Water Level (lv/100)</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php foreach ($all_data as $row) { ?>
                                    <tr>
                                        <td><?php echo $row['Record_ID'] ?></td>
                                        <td><?php echo $row['Record_Date'] ?></td>
                                        <td><?php echo $row['Record_Time'] ?></td>
                                        <td><?php echo $row['Water_Level'] ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>

        <?php include 'assets/components/footer.php' ?>
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

            $humidity = (float)$row['Water_Level'];

            $record_time = $row['Record_Time'];
        ?>

            yValues.push(<?php echo $humidity; ?>);

            xValues.push('<?php echo $record_time; ?>');

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
                    text: "Latest Water_Level Comparison Chart"
                }
            }
        });
    </script>


    <!-- SCRIPT FOR BAR-CHART-->

    <script>
        var yValues = [];

        var xValues = [];

        <?php foreach ($sensor_data as $row) {

            $humidity = (float)$row['Water_Level'];

            $time = $row['Record_Time'];

        ?>

            yValues.push(<?php echo $humidity; ?>);

            xValues.push('<?php echo $time; ?>');

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
                    text: "Latest Water_Level Comparison Chart"
                },
                scales: {
                    yAxes: [{
                        scaleLabel: {
                            display: true,
                            labelString: 'Water_Level'
                        }
                    }],

                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Capture Time'
                        }
                    }],
                }
            }
        });
    </script>


    <!-- SCRIPT FOR LINE-CHART-->

    <script>
        var xValues = [];

        var yValues = [];

        <?php foreach ($sensor_data as $row) {

            $humidity = (float)$row['Water_Level'];

            $time = $row['Record_Time'];

        ?>

            xValues.push('<?php echo $time; ?>');

            yValues.push(<?php echo $humidity; ?>);


        <?php } ?>

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
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            min: 0,
                            max: 100
                        },
                        scaleLabel: {
                            display: true,
                            labelString: 'Water_Level'
                        }
                    }],

                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Capture Time'
                        }
                    }],
                }
            }
        });
    </script>

</body>



<!-- ADD JS SCRIPTS FOR DATATABLES HERE-->

<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>

<script src="js/datatables-simple-demo.js"></script>

</html>