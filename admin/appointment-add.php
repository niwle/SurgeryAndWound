<?php
require_once('../config/autoload.php');
include('includes/path.inc.php');
include('includes/session.inc.php');
include(SELECT_HELPER);
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
        <!-- Page content -->
        <div class="row">
            <div class="col-12">
                <!-- Card Content -->
                <form name="regform" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                    <div class="card">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputPatientID">Patient ID*</label>
                                        <!-- Input to display selected -->
                                        <input type="text" name="inputPatientID" class="form-control" placeholder="Enter Patient ID/ Patient Name" id="inputPatientID" data-toggle="dropdown" aria-expanded="false" autocomplete="off" required>
                                        <!-- Hidden input that will get the patient ID only -->
                                        <input type="text" name="inputPatientIDOnly" id="inputPatientIDOnly" hidden>
                                        <div class="dropdown-menu" aria-labelledby="inputPatientID">
                                            <ul id="patientIDlist">
                                                <li class="dropdown-item" type="button">No Result</li>

                                            </ul>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputDoctorID">Doctor ID*</label>
                                        <!-- Input to display selected -->
                                        <input type="text" name="inputDoctorID" class="form-control" id="inputDoctorID" placeholder="Enter Doctor ID/ Doctor Name" data-toggle="dropdown" aria-expanded="false" autocomplete="off" required>
                                        <!-- Hidden input that will get the Doctor ID only -->
                                        <input type="text" name="inputDoctorIDOnly" id="inputDoctorIDOnly" hidden>
                                        <div class="dropdown-menu" aria-labelledby="inputDoctorID">
                                            <ul id="doctorIDlist">
                                                <li class="dropdown-item" type="button">No Result</li>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="inputAppoinmentDate">Appointment Date & Time</label>
                                        <input type="datetime-local" class="form-control" id="inputAppoinmentDate" name="inputAppoinmentDate" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="inputApDescription">Appointment Description</label>
                                        <input type="text" name="inputApDescription" class="form-control" id="inputApDescription" placeholder="Enter Description" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 mt-3">
                            <button type="submit" class="btn btn-primary btn-block" name="savebtn">Add Appointment</button>
                        </div>
                </form>
                <!-- End Card Content -->
            </div>
        </div>
        <!-- End Page Content -->
    </div>

    <?php include JS_PATH; ?>
    <script>
        $("#datepicker").on("dp.change", function(e) {
            var date = new Date($(this).val());
            var year = date.getFullYear();
            var current_year = new Date().getFullYear();
            var totalyear = current_year - year;
            // $('#inputAge').val(totalyear);
            // console.log(date);
        });

        $('#inputIC').on('keyup', function() {
            var input = $(this).val(),
                lastnum = input % 10;
            if (lastnum % 2 === 0) {
                $("#inputGenderFemale").prop("checked", true);
            } else {
                $("#inputGenderMale").prop("checked", true);
            }
        });

        $("[name='inputPatientID']").keyup(function(e) {
            var dInput = this.value;
            $.ajax({
                type: "POST",
                url: "includes/adm_conn.php",
                data: {
                    type: 'addAppoinment',
                    input: dInput,
                    type: "p"
                },
                success: function(response) {
                    $('#patientIDlist').html(response);
                    $('#patientIDlist li').bind("click", function(e) {
                        var index = $(this).index();
                        // alert($(this).attr('p_id'));
                        $('#inputPatientIDOnly').val($(this).attr('p_id'));
                        $("[name='inputPatientID']").val($(this).text())
                    });
                }
            });
        });

        $("[name='inputDoctorID']").keyup(function(e) {
            var dInput = this.value;
            $.ajax({
                type: "POST",
                url: "includes/adm_conn.php",
                data: {
                    type: 'addAppoinment',
                    input: dInput,
                    type: "d"
                },
                success: function(response) {
                    $('#doctorIDlist').html(response);
                    $('#doctorIDlist li').bind("click", function(e) {
                        var index = $(this).index();
                        // alert($(this).attr('p_id'));
                        $('#inputDoctorIDOnly').val($(this).attr('p_id'));
                        $("[name='inputDoctorID']").val($(this).text())
                    });
                }
            });
        });

        // $("#inputAppoinmentDate").change(function(e) {
        //     e.preventDefault();
        //     // var hour = new Date($(this).val()).getTime()
        //     // var dateChose = new Date($(this).val());
        //     // var date = dateChose.getFullYear() + '-' + (dateChose.getMonth() + 1) + '-' + dateChose.getDate();
        //     // var time = dateChose.getHours() + ':' + dateChose.getMinutes() + ':' + dateChose.getSeconds();
        //     // // console.log(date + ' ' + time);
        //     // alert(date + ' ' + time)
        //     alert(dateFormat(new Date($(this).val()),"YYYY-MM-DD HH:MI:SS"));
        // });
    </script>


</body>

<?php
if (isset($_POST['savebtn'])) {

    $created_at = date('Y-m-d H:i:s');
    $created_at_notime = date('Y_m_d');

    $inputPatientIDOnly = $conn->real_escape_string($_POST['inputPatientIDOnly']);
    $inputDoctorIDOnly = $conn->real_escape_string($_POST['inputDoctorIDOnly']);
    $inputAppoinmentDate = $conn->real_escape_string($_POST['inputAppoinmentDate']);
    $inputApDescription = $conn->real_escape_string($_POST['inputApDescription']);

    $reg_datetime = date("Y-m-d H:i", strtotime($inputAppoinmentDate));
    $from_for_val =  date("Y-m-d H:i:s", strtotime($reg_datetime));

    $insSQL = "INSERT INTO appointment (patient_id, doctor_id, description, apoinment_date) 
    VALUES ('$inputPatientIDOnly', '$inputDoctorIDOnly', '$inputApDescription', '$from_for_val');";
    
    $result = $conn->query($insSQL);

    if($result){
        echo '<script>
                    Swal.fire({ title: "Great!", text: "New Appointment Added!", type: "success" }).then((result) => {
                        if (result.value) { window.location.href = "appointment-add.php"; }
                    });
                    </script>';
    }
}
?>

</html>