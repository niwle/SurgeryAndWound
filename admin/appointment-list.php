<?php
require_once("../config/autoload.php");
include("includes/session.inc.php");
include("includes/path.inc.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include CSS_PATH;?>
</head>

<body>
    <?php include NAVIGATION; ?>
    <div class="page-content" id="content">
        <?php include HEADER;?>
        <!-- Page content -->
        <div class="row">
            <div class="col-12">
                <!-- Card Content -->
                <div class="card shadow-sm rounded">
                    <div class="card-body">
                        <div class="card-inner">
                            <!-- Datatable -->
                            <div class="data-tables">
                                <table id="datatable" class="table" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No #</th>
                                            <th>Patient ID</th>
                                            <th>Patient Registration ID</th>
                                            <th>Patient Name</th>
                                            <th>Doctor ID</th>
                                            <th>Doctor Registration ID</th>
                                            <th>Doctor Name</th>
                                            <th>Description</th>
                                            <th>Apoinment date & time</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                          
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $indexCount = 1;
                                        $table_result = mysqli_query($conn, "SELECT * FROM appointment ");
                                        while ($table_row = mysqli_fetch_assoc($table_result)) {
                                            $appoinmentID = $table_row['a_id'];
                                            $patientTableID = $table_row["patient_id"];
                                            $doctorTableID = $table_row["doctor_id"];
                                            $table_patient = mysqli_query($conn, "SELECT * FROM user_master where m_id = '$patientTableID'");
                                            $table_patient = mysqli_fetch_assoc($table_patient);
                                            $table_doctor = mysqli_query($conn, "SELECT * FROM user_master where m_id = '$doctorTableID'");
                                            $table_doctor = mysqli_fetch_assoc($table_doctor);
                                        ?>
                                        <tr>
                                            <td><?php echo $indexCount++; ?></td>
                                            <td><?php echo $table_row["patient_id"];?></td>
                                            <td><?php echo $table_patient['m_regis_id'];?></td>
                                            <td><?php echo $table_patient['m_name'];?></td>
                                            <td><?php echo $table_row["doctor_id"];?></td>
                                            <td><?php echo $table_doctor['m_regis_id'];?></td>
                                            <td><?php echo $table_doctor['m_name'];?></td>
                                            <td><?php echo $table_row["description"];?></td>
                                            <td><?php echo $table_row["apoinment_date"];?></td>
                                            <td><?php echo $table_row["created_at"];?></td>
                                            <td><button class="btn btn-danger delete" appointmentID = "<?= $appoinmentID ?>">Delete</button></td>
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- End Datatable -->
                        </div>
                    </div>
                </div>
                <!-- End Card Content -->
            </div>
        </div>
        <!-- End Page Content -->
    </div>

    <?php include JS_PATH;?>
    <script>
        $(".delete").click(function (e) { 
            e.preventDefault();
            var appointmentID = $(this).attr("appointmentID");
            console.log(appointmentID);
            if(confirm("Are you sure?")){
                $.ajax({
                    type: "POST",
                    url: "includes/adm_conn.php",
                    data: {
                        type : "removeAppointment",
                        appointmentID : appointmentID
                    },
                    success: function (response) {
                        window.location.replace("appointment-list.php"); 
                       
                    }
                });
            }
            
        });

    </script>
</body>
</html>