<?php
$no = 1;



function buildSelect($doctor_arr, $selected){
    $build_dr_option = "";

    foreach ($doctor_arr as $doctor) {
        $dr_id = $doctor['m_id'];
        $dr_name = $doctor['m_name'];
        $selected = ($dr_id == $selected) ? "selected" : "";
        $build_dr_option .= "<option value='$dr_id' $selected >$dr_name</option>";
    }

    return $build_dr_option;
}

function statusType($no){
    return ($no == '0')? '<span class="bg-danger text-white status_text">Not Assigned</span>':'<span class="status_text bg-success text-white">Assigned</span>';
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Assign</title>
</head>

<body>
    <div>

    </div>
    <div class="container">

        <!-- Tabs navs -->
        <ul class="nav nav-tabs mb-3" id="ex1" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="ex1-tab-1" data-mdb-toggle="tab" href="#ex1-tabs-1" role="tab" aria-controls="ex1-tabs-1" aria-selected="true">Assigning Module</a>
            </li>
            <!-- <li class="nav-item" role="presentation">
                <a class="nav-link" id="ex1-tab-2" data-mdb-toggle="tab" href="#ex1-tabs-2" role="tab" aria-controls="ex1-tabs-2" aria-selected="false">Assigned</a>
            </li> -->
        </ul>
        <!-- Tabs navs -->

        <!-- Tabs content -->
        <div class="tab-content" id="ex1-content">
            <div class="tab-pane fade show active" id="ex1-tabs-1" role="tabpanel" aria-labelledby="ex1-tab-1">
                <table id="not_assign" class="table table-striped" width:"100%">
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
                            $identification = $patient['m_ic'];
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
                    <td name='{$no}doctor_inCharge'> <select style='max-width:90%;' class='dropdown_filter' name='doctor'> <option style='min-width: 100px' value='0' selected>None</option> $build_dr_option </select></td>
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
            
        </div>
        <!-- Tabs content -->
    </div>
    <div style="height:50px"></div>
    <script>
        $(document).ready(function() {
            $('.dropdown_filter').select2({
                placeholder: "Select a Doctor",
                allowClear: true
            });
            $table_not_assign = $('#not_assign').DataTable();
        });
        //click delete button
        $('#not_assign tbody').on('click', '.save', function() {
            if (confirm("Are you sure ?")) {

                var id_d = ($(this).attr('data-bs-id'));
                var success_delete = false;

                var dr_val = $(this).closest('tr').find("select option:selected").val();
                if(dr_val == '0'){
                    var span = $(this).closest('tr').find("span.bg-success").removeClass('bg-success').addClass('bg-danger').text("Not Assigned");
                }else{
                    var span = $(this).closest('tr').find("span.bg-danger").removeClass('bg-danger').addClass('bg-success').text("Assigned");
                }

                $.ajax({
                    url: "Admin_DOP/includes/adm_conn.php",
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