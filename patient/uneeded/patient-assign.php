<?php
require_once("../config/autoload.php");
include("includes/session.inc.php");
include("includes/path.inc.php");

$no = 1;
$sqlUM = "SELECT * FROM user_master";
$sqlIMG = "SELECT * FROM progress_book_entry";
$result_UM = $conn->query($sqlUM);
$result_IMG = $conn->query($sqlIMG);
$patient_count = $doctor_count = 0;
$image_count = $result_IMG->num_rows;
$resultUM = $result_UM->fetch_all(MYSQLI_ASSOC);


// Array to store info 
$doctor_arr = $patient_arr = [];
foreach ($resultUM as $row) {
    switch ($row['m_type']) {
        case 'P':
            $patient_arr[] = $row;
            break;
        case 'D':
            $doctor_arr[] = $row;
            break;
    }
}

function buildSelect($doctor_arr, $selected)
{
    $build_dr_option = "";
    foreach ($doctor_arr as $doctor) {
        $dr_id = $doctor['m_id'];
        $dr_name = $doctor['m_name'];
        $selected2 = ($dr_id == $selected)?"selected":"";
        $build_dr_option .= "<option value='$dr_id' $selected2>$dr_name</option>";
    }
    return $build_dr_option;
}

function statusType($no)
{
    return ($no == '0') ? '<span class="bg-danger text-white status_text">Not Assigned</span>' : '<span class="status_text bg-success text-white">Assigned</span>';
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include CSS_PATH; ?>
    <style> .status_text { padding: 3px 4px; border-radius: 5px; } </style>
</head>

<body>
    <?php include NAVIGATION; ?>
    <div class="page-content" id="content">
        <?php include HEADER; ?>
        <!-- Page content -->
        <div class="row">
            <div class="col-12">
                <!-- Card Content -->
                <div class="card shadow-sm rounded">
                    <div class="card-body">
                        <div class="card-inner">
                            <!-- Datatable -->
                            <div class="data-tables">
                                <table id="not_assign" class="table" style="width:100%">
                                    <thead>
                                        <tr>
                                            <td width="5%">No.</td>
                                            <td>Name</td>
                                            <td>IC/Passport</td>
                                            <td>Created At</td>
                                            <td>Doctor Assigned</td>
                                            <td>Status</td>
                                            <td align='center'>Action</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($patient_arr as $patient) :
                                            // if ($patient['doctor_inCharge'] != '0') continue;
                                            $id = $patient['m_id'];
                                            $name = $patient['m_name'];
                                            $identification = $patient['m_identity'];
                                            $created_at = $patient['created_at'];
                                            $doctorAssign = $patient['doctor_inCharge'];
                                            $status = statusType($doctorAssign);
                                            $build_dr_option = buildSelect($doctor_arr, $doctorAssign);
                                            echo "
                                                <tr name='$no' value='$id' justTesting = 'lol'>
                                                    <td>$no</td>
                                                    <td name='{$no}name'>$name</td>
                                                    <td name='{$no}identification'>$identification</td>
                                                    <td> $created_at</td>
                                                    <td name='{$no}doctor_inCharge'> <select style='max-width:90%;' class='dropdown_filter' name='doctor'> <option style='min-width: 120px' value='0'>None</option> $build_dr_option </select></td>
                                                    <td>$status</td>
                                                    <td align='center'>
                                                    <button  type='button' data-bs-no='$no' data-bs-id='$id' data-bs-ic='$identification' data-bs-name='$name'  name='{$no}modalPopD' style='padding-left:20px; padding-right:20px' class='btn btn-outline-primary save'>Save</button>
                                                    </td>
                                                </tr>
                                            ";
                                            $no++;
                                        endforeach ?>
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

    <?php include JS_PATH; ?>
    <script>
        $('.dropdown_filter').select2({
            placeholder: "Select a Doctor",
            allowClear: true
        });

        $('#not_assign').DataTable();

        $('#not_assign tbody').on('click', '.save', function() {
            if (confirm("Are you sure ?")) {

                var id_d = ($(this).attr('data-bs-id'));
                var success_delete = false;

                var dr_val = $(this).closest('tr').find("select option:selected").val();
                if (dr_val == '0') {
                    var span = $(this).closest('tr').find("span.bg-success").removeClass('bg-success').addClass('bg-danger').text("Not Assigned");
                } else {
                    var span = $(this).closest('tr').find("span.bg-danger").removeClass('bg-danger').addClass('bg-success').text("Assigned");
                }

                $.ajax({
                    url: "includes/adm_conn.php",
                    type: "POST",
                    data: {
                        id: id_d,
                        dr_val: dr_val,
                        type: "assignDr"
                    },
                    cache: false,
                    success: function(response) {
                        success('Assigned');

                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert(errorThrown);
                    }
                });
            }
        });
    </script>
</body>

</html>