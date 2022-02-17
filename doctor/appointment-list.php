<?php
require_once("../config/autoload.php");
include("includes/session.inc.php");
include("includes/path.inc.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include CSS_PATH; ?>
</head>

<body>
    <?php include NAVIGATION; ?>
    <div class="page-content" id="content">
        <?php include HEADER; ?>
        <?php
        $appointment_arr = [];
        $getAppointment = "SELECT a.*,  um.m_regis_id, um.m_name FROM appointment as a inner join user_master as um on um.m_id = a.patient_id WHERE doctor_id = '$sess_id' order by apoinment_date;;";

        $result_Appointment = $conn->query($getAppointment);
        while($row_appointment = $result_Appointment->fetch_assoc()){
  
            $appointment_arr[] = $row_appointment;
        }
        ?>
        <!-- Page content -->
        <div class="row">
            <div class="col-12">
                <!-- Card Content -->
                <div class="card shadow-sm rounded">
                    <div class="card-body">
                        <div class="card-inner">

                            <input type="text" id="myInput" onkeyup="myFunction()" class="form-control" placeholder="Search Appointment">
                            <hr>
                            <ul id="myUL">
                                <?php if (!empty($appointment_arr)) : ?>
                                    <?php foreach ($appointment_arr as $n_arr) : ?>
                                        <!-- <a href="doctor-feedback.php?f=<?= base64_encode($n_arr['entryID']) ?>"> -->
                                            <li>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <!-- Card Content -->
                                                        <div class="card shadow-sm rounded">
                                                            <div class="card-body">
                                                                <div class="card-inner">
                                                                    <div class="d-flex justify-content-between">
                                                                        <div style="color: black;">
                                                                            <h4>Appointment Details</h3>
                                                                            <?php 
                                                                                $d = new DateTime($n_arr['apoinment_date']);
                                                                            ?>
                                                                            <p><?= $d->format( 'd-M-Y' ) ?>  |  <?= $d->format('h:i A') ?> </p>
                                                                            
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
                                        <!-- </a> -->
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
                <!-- End Card Content -->
            </div>
        </div>
        <!-- End Page Content -->
        <!-- Modal -->
    </div>

    <?php include JS_PATH; ?>
    <script>
        function myFunction() {
            var input, filter, ul, li, a, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            ul = document.getElementById("myUL");
            li = ul.getElementsByTagName("li");
            for (i = 0; i < li.length; i++) {
                a = li[i].getElementsByTagName("a")[0];
                txtValue = a.textContent || a.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    li[i].style.display = "";
                } else {
                    li[i].style.display = "none";
                }
            }
        }
    </script>
</body>

</html>