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
        <?php if($patient_row['m_dob']==''): ?>
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
                        <h6 class="nav-item nav-title">Showing upcoming appointment for next 2 days</h6>
                        <hr>
                        <?php
                        $appointment_arr = [];
                        $getAppointment = "SELECT a.*, um.m_regis_id, um.m_name FROM appointment as a inner join user_master as um on um.m_id = a.doctor_id WHERE patient_id = '$sess_id' and datediff(date(apoinment_date), CURDATE()) >= 0
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
                                                                    <div class="col"><b><?= $n_arr['m_name'] ?> (Doctor ID: <?= $n_arr['m_regis_id'] ?> )</b></div>
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

                <div class="card">

                    <div class="card-body">
                        <h6 class="nav-item nav-title">Progress Tracking</h6>
                        <br>
                        <?php

                        //prepare array
                        $progressTitle = $progressDescription = $quesPain = $quesFluid = $quesRedness = $quesSwelling = $quesOdour = $quesFever = $created_at = [];
                        //query to get result
                        $result = mysqli_query($conn, "SELECT * FROM progress_book_entry where masterUserid_fk = '$sess_id'");
                        $result_all = mysqli_fetch_all($result, MYSQLI_ASSOC);


                        // Array to store info 
                        foreach ($result_all as $result_row) {
                            foreach ($result_row as $assoc => $data) {
                                switch ($assoc) {
                                    case 'progressTitle':
                                        $progressTitle[] = $data;
                                        break;
                                    case 'progressDescription':
                                        $progressDescription[] = $data;
                                        break;
                                    case 'quesPain':
                                        $quesPain[] = $data;
                                        break;
                                    case 'quesFluid':
                                        $quesFluid[] = $data;
                                        break;
                                    case 'quesRedness':
                                        $quesRedness[] = $data;
                                        break;
                                    case 'quesSwelling':
                                        $quesSwelling[] = $data;
                                        break;
                                    case 'quesOdour':
                                        $quesOdour[] = $data;
                                        break;
                                    case 'quesFever':
                                        $quesFever[] = $data;
                                        break;
                                    case 'created_at':
                                        $created_at[] = $data;
                                        break;
                                }
                            }
                        }


                        ?>
                        <div style="overflow-x: auto;">
                            <table class="table table-bordered table-sm">
                                <tbody>
                                    <tr>
                                        <th scope="row">Date Created</th>
                                        <?php foreach ($created_at as $data) : ?>
                                            <td><?= $data ?></td>
                                        <?php endforeach ?>
                                    </tr>
                                    <tr>
                                        <th scope="row">Title</th>
                                        <?php foreach ($progressTitle as $data) : ?>
                                            <td><?= $data ?></td>
                                        <?php endforeach ?>
                                    </tr>
                                    <tr>
                                        <th scope="row">Description</th>
                                        <?php foreach ($progressDescription as $data) : ?>
                                            <td><?= $data ?></td>
                                        <?php endforeach ?>
                                    </tr>
                                    <tr>
                                        <th scope="row">Pain</th>
                                        <?php foreach ($quesPain as $data) : ?>
                                            <td><?= $data ?></td>
                                        <?php endforeach ?>
                                    </tr>
                                    <tr>
                                        <th scope="row">Redness</th>
                                        <?php foreach ($quesRedness as $data) : ?>
                                            <td><?= $data ?></td>
                                        <?php endforeach ?>
                                    </tr>
                                    <tr>
                                        <th scope="row">Swelling</th>
                                        <?php foreach ($quesSwelling as $data) : ?>
                                            <td><?= $data ?></td>
                                        <?php endforeach ?>
                                    </tr>
                                    <tr>
                                        <th scope="row">Odour</th>
                                        <?php foreach ($quesOdour as $data) : ?>
                                            <td><?= $data ?></td>
                                        <?php endforeach ?>
                                    </tr>
                                    <tr>
                                        <th scope="row">Fever</th>
                                        <?php foreach ($quesFever as $data) : ?>
                                            <td><?= $data ?></td>
                                        <?php endforeach ?>
                                    </tr>
                                </tbody>
                            </table>
                        </div>



                    </div>
                </div>
                
                
               

            </div>
        </div>
        <!-- End Page Content -->
    </div>
    <?php include JS_PATH; ?>
</body>

</html>