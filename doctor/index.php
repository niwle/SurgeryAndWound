<?php
require_once('../config/autoload.php');
include('includes/path.inc.php');
include('includes/session.inc.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include CSS_PATH; ?>
    <link rel="stylesheet" href="../assets/css/clinic/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
</head>

<body>
    <?php include NAVIGATION; ?>
    <div class="page-content" id="content">
        <?php include HEADER; ?>
        <?php include WIDGET; ?>
        <!-- Page content -->
        <?php if ($doctor_row['m_dob'] == '') : ?>
            <div class="alert alert-warning" role="alert"> Please Update Profile Info </div>
        <?php endif ?>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h6>
                            <i class="far fa-clock"></i> <?php echo date('Y-m-d'); ?> <span id="timer"></span>
                            <script>
                                setInterval(function() {
                                    var currentTime = new Date();
                                    var currentHours = currentTime.getHours();
                                    var currentMinutes = currentTime.getMinutes();
                                    var currentSeconds = currentTime.getSeconds();
                                    currentMinutes = (currentMinutes < 10 ? "0" : "") + currentMinutes;
                                    currentSeconds = (currentSeconds < 10 ? "0" : "") + currentSeconds;
                                    var timeOfDay = (currentHours < 12) ? "AM" : "PM";
                                    currentHours = (currentHours > 12) ? currentHours - 12 : currentHours;
                                    currentHours = (currentHours == 0) ? 12 : currentHours;
                                    var currentTimeString = currentHours + ":" + currentMinutes + ":" + currentSeconds + " " + timeOfDay;
                                    document.getElementById("timer").innerHTML = currentTimeString;
                                }, 1000);
                            </script>
                        </h6>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h5> Showing upcoming appointment for next 2 days</h5>
                        <hr>
                        <?php
                        $appointment_arr = [];
                        $getAppointment = "SELECT a.*, um.m_regis_id, um.m_name FROM appointment as a inner join user_master as um on um.m_id = a.patient_id WHERE doctor_id = '$sess_id' and datediff(date(apoinment_date), CURDATE()) >= 0
                        and datediff(date(apoinment_date), CURDATE()) < 3 order by apoinment_date;";

                        $result_Appointment = $conn->query($getAppointment);
                        while($row_appointment = $result_Appointment->fetch_assoc()){
                
                            $appointment_arr[] = $row_appointment;
                        }
                        ?>
                        <div style="max-height: 350px; overflow-y: auto;">
                            <ul id="myUL">
                                <?php if (!empty($appointment_arr)) : ?>
                                    <?php foreach ($appointment_arr as $n_arr) : ?>
                                        <li>
                                            <div class="row">
                                                <div class="col-12">
                                                    <!-- Card Content -->
                                                    <div class="card shadow-sm rounded">
                                                        <div class="card-body">
                                                            <div class="card-inner">
                                                                <div class="d-flex justify-content-between">
                                                                    <div style="color: black;">
                                                                        <h5>Appointment Details</h3>
                                                                            <?php
                                                                            $d = new DateTime($n_arr['apoinment_date']);
                                                                            ?>
                                                                            <p><?= $d->format('d-M-Y') ?> | <?= $d->format('h:i A') ?> </p>
                                                                    </div>
                                                                    <div class="text-muted" style="font-size: 0.8em;"><?= $n_arr['created_at'] ?></div>
                                                                </div>
                                                                <hr>
                                                                <div class="row">
                                                                    <div class="col-3">Appointment with: </div>
                                                                    <div class="col"><b><?= $n_arr['m_name'] ?> (Patient ID: <?= $n_arr['m_regis_id'] ?> )</b></div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-3">Appointment Description: </div>
                                                                    <div class="col"><b><?= $n_arr['description'] ?></b></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- End Card Content -->
                                                </div>
                                            </div>
                                        </li>
                                    <?php endforeach ?>
                                <?php else : ?>
                                    <li>
                                        <div class="row">
                                            <div class="col-12">
                                                <!-- Card Content -->
                                                <div class="card shadow-sm rounded">
                                                    <div class="card-body">
                                                        <div class="card-inner">
                                                            *No Appointment
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Card Content -->
                                            </div>
                                        </div>
                                    </li>

                                <?php endif ?>

                            </ul>

                        </div>
                    </div>
                </div>

                <!-- <div class="card">
                    <div class="card-body">
                        <canvas id="HorizontalChart"></canvas>
                        <script>
                            Chart.platform.disableCSSInjection = true;
                            var ctx = document.getElementById('HorizontalChart').getContext('2d');
                            var myChart = new Chart(ctx, {
                                type: 'horizontalBar',
                                data: {
                                    // labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                                    labels: [
                                        <?php
                                        // $idquery = array();
                                        // $result = mysqli_query($conn, "SELECT * FROM clinics ");
                                        // while ($row = mysqli_fetch_assoc($result)) {
                                        //     echo '"' . $row['clinic_name'] . '",';

                                        //     $idquery[] = $row["clinic_id"];
                                        // }
                                        ?>
                                    ],
                                    datasets: [{
                                        label: '# of Appointment',
                                        data: [
                                            <?php
                                            // foreach ($idquery as $arrvalue) {
                                            //     $newsql = "SELECT * FROM appointment WHERE clinic_id = $arrvalue ";
                                            //     $idnum = mysqli_num_rows(mysqli_query($conn, $newsql));
                                            //     echo $idnum . ',';
                                            // }
                                            ?>
                                        ],
                                        backgroundColor: [
                                            'rgba(255, 99, 132, 0.2)',
                                            'rgba(54, 162, 235, 0.2)',
                                            'rgba(255, 206, 86, 0.2)',
                                            'rgba(75, 192, 192, 0.2)',
                                            'rgba(153, 102, 255, 0.2)',
                                            'rgba(255, 159, 64, 0.2)'
                                        ],
                                        borderColor: [
                                            'rgba(255, 99, 132, 1)',
                                            'rgba(54, 162, 235, 1)',
                                            'rgba(255, 206, 86, 1)',
                                            'rgba(75, 192, 192, 1)',
                                            'rgba(153, 102, 255, 1)',
                                            'rgba(255, 159, 64, 1)'
                                        ],
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    title: {
                                        display: true,
                                        text: 'Rank of Appointment Clinics',
                                    },
                                    scales: {
                                        yAxes: [{
                                            ticks: {
                                                beginAtZero: true
                                            }
                                        }]
                                    }
                                }
                            });
                        </script>
                    </div>
                </div> -->

            </div>
        </div>
        <!-- End Page Content -->
    </div>
    <?php include JS_PATH; ?>
</body>

</html>