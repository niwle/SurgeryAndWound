<?php
require_once("../config/autoload.php");
include("includes/session.inc.php");
include("includes/path.inc.php");
include(SELECT_HELPER);

$pid = decrypt_url($_REQUEST["pid"]);
$result = mysqli_query($conn, "SELECT * FROM user_master WHERE m_id = $pid");
$row = mysqli_fetch_assoc($result);
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
                <div class="card shadow-sm rounded">
                    <div class="card-body">
                        <div class="d-flex mb-3">
                            <h5 class="card-title mr-auto">View Doctor : <?php echo strtoupper($row["m_name"]) ?></h5>
                        </div>
                        <div class="card-inner">
                            <!-- View -->
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-info" role="tab" aria-controls="nav-home" aria-selected="true">Patient Info</a>
                                    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#photo_comments" role="tab" aria-controls="nav-contact" aria-selected="false">Feedback Provided</a>
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-info" role="tabpanel" aria-labelledby="info-tab">
                                    <table class="table table-bordered">
                                        <?php if (mysqli_num_rows($result) < 1) {
                                            echo '<tr><td class="text-center">No Member Record!</td></tr>';
                                        } else {
                                        ?>
                                            <tr>
                                                <th scope="row">Doctor ID</th>
                                                <th scope="row"><?php echo $row["m_id"]; ?></th>
                                            </tr>
                                            <tr>
                                                <th scope="row">Name</th>
                                                <td><input name='m_name' type="text" class="form-control" value="<?php echo $row["m_name"]; ?>" aria-label="Recipient's username" aria-describedby="basic-addon2"></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Identity</th>
                                                <td><input name='m_identity' type="text" class="form-control" value="<?php echo $row["m_identity"]; ?>" aria-label="Recipient's username" aria-describedby="basic-addon2"></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Gender</th>
                                                <td>
                                                    <div class="input-group mb-3">
                                                        <select name='m_gender' class="custom-select" id="select_gender">
                                                            <option value="male" <?php echo (($row["m_gender"] != 'male') && ($row["m_gender"] != 'male')) ? "selected" : ""; ?>>Choose...</option>
                                                            <option value="male" <?php echo ($row["m_gender"] == 'male') ? "selected" : ""; ?>>male</option>
                                                            <option value="female" <?php echo ($row["m_gender"] == 'female') ? "selected" : ""; ?>>female</option>
                                                        </select>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Email</th>
                                                <td><input type="text" name='email' class="form-control" value="<?php echo $row["email"]; ?>" aria-label="Recipient's username" aria-describedby="basic-addon2"></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Contact</th>
                                                <td><input name='phone' type="text" class="form-control" value="<?php echo $row["phone"]; ?>" aria-label="Recipient's username" aria-describedby="basic-addon2"></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Nationality</th>
                                                <td><input name='m_nationality' type="text" class="form-control" value="<?php echo $row["m_nationality"]; ?>" aria-label="Recipient's username" aria-describedby="basic-addon2"></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Date of Birth</th>
                                                <td>

                                                    <input type="text" name="inputDOB" value="<?php echo $row["m_dob"]; ?>" class="form-control" id="datepicker" placeholder="Enter DOB">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Address</th>
                                                <td><input name='m_address' type="text" class="form-control" value="<?php echo $row["m_address"]; ?>" aria-label="Recipient's username" aria-describedby="basic-addon2"></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">City</th>
                                                <td><input name='m_city' type="text" class="form-control" value="<?php echo $row["m_city"]; ?>" aria-label="Recipient's username" aria-describedby="basic-addon2"></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Zipcode</th>
                                                <td><input name='m_zipcode' type="text" class="form-control" value="<?php echo $row["m_zipcode"]; ?>" aria-label="Recipient's username" aria-describedby="basic-addon2"></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">State</th>
                                                <td><input name='m_state' type="text" class="form-control" value="<?php echo $row["m_state"]; ?>" aria-label="Recipient's username" aria-describedby="basic-addon2"></td>
                                            </tr>
                                        <?php
                                        } ?>
                                    </table>
                                    <div align='right'>
                                        <button class="btn btn-primary btn-block view_edit">Edit</button>
                                        <button class="btn btn-primary btn-block view_cancel" hidden>Cancel</button>
                                        <button class="btn btn-danger btn-block view_delete" hidden>Delete</button>
                                        <button class="btn btn-success btn-block view_save" hidden>Save</button>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="photo_comments" role="tabpanel" aria-labelledby="comments-tab">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th width="15%">Date #</th>
                                                <th width="30%">Image</th>
                                                <th width="20%">Patient Name</th>
                                                <th>Feedback</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $result = mysqli_query($conn, "SELECT pbe.*, um.m_name as patient_name FROM progress_book_entry pbe INNER JOIN user_master um on um.m_id = pbe.masterUserid_fk WHERE pbe.dcotor_replied = '" . $pid . "'");
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                if ($result->num_rows == 0) {
                                                    echo '<p>No result</p>';
                                                } else {
                                            ?>
                                                    <tr>
                                                        <td><?= $row["created_at"] ?></td>
                                                        <td><img style="width: 50%; height: 50%;" src="../uploads/patient_img/<?= $row["masterUserid_fk"] ?>/<?= $row["progressImage"] ?>" alt="No Image">
                                                            <button type='button' data-img='../uploads/patient_img/<?= $row["masterUserid_fk"] ?>/<?= $row["progressImage"] ?>' data-toggle='modal' data-target='#exampleModal' style='padding-left:20px; padding-right:20px' class='btn btn-outline-primary'>Click to enlarge</button>
                                                        </td>
                                                        <td><?= $row["patient_name"] ?></td>
                                                        <td><?= $row["progressDescription"] ?></td>
                                                        <td>
                                                            <button type='button' data-feedback='<?= $row["progressDescription"] ?>' data-pbe='<?= $row["entryID"] ?>' data-toggle='modal' data-target='#editModal' name='{$no}modalPop' style='padding-left:20px; padding-right:20px' class='btn btn-outline-warning edit'>Edit</button>

                                                            <!-- <button type='button' data-feedback='<?= $row["progressDescription"] ?>' data-pbe='<?= $row["entryID"] ?>' name='{$no}modalPopD' style='padding-left:20px; padding-right:20px' class='btn btn-outline-danger delete'>Delete</button> -->
                                                        </td>
                                                    </tr>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog  modal-dialog-scrollable modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Image</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body" align='center'>
                                                    <img style="width: 80%" class="outImg" src="" alt="Error Loading Image">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="row g-3">
                                                        <div class="col-md-12">
                                                            <label for="name" class="form-label">Feedback: </label>
                                                            <input type="text" class="form-control" id="feedback" value="" required>
                                                            <input type="text" class="form-control" id="pbe" value="" hidden>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary" id='saveFeedback' name="saveFeedback">Save Changes</button>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End View -->
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
        $(".table-bordered :input").prop('readonly', true);
        $('#select_gender').attr("disabled", true);

        $(".view_edit").click(function(e) {
            e.preventDefault();
            $(".view_edit").prop("hidden", true);
            $(".view_save").prop("hidden", false);
            $(".view_cancel").prop("hidden", false);
            $(".view_delete").prop("hidden", false);

            $('#select_gender').attr("disabled", false);
            $(".table-bordered :input ").prop('readonly', false);
        });

        $(".view_cancel").click(function(e) {
            e.preventDefault();
            $(".view_edit").prop("hidden", false);
            $(".view_save").prop("hidden", true);
            $(".view_cancel").prop("hidden", true);
            $(".view_delete").prop("hidden", true);

            $('#select_gender').attr("disabled", true);
            $(".table-bordered :input ").prop('readonly', true);
        });

        $("#saveFeedback").click(function(e) {
            e.preventDefault();
            var feedback = $('#feedback').val();
            var pbe = $('#pbe').val();
            if (confirm("Are you sure?")) {
                $.ajax({
                    url: "includes/adm_conn.php",
                    type: "POST",
                    data: {
                        feedback: feedback,
                        pbe: pbe,
                        type: "adminSaveFeedback",
    
                    },
                    cache: false,
                    success: function(response) {
                        console.log(response);
                        Swal.fire({
                            title: 'Success',
                            text: 'Feedback has been changed',
                            icon: 'success',
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        })
                    }
                });
            }


        });

        $(".view_save").click(function(e) {
            e.preventDefault();
            if (confirm("Are you sure?")) {
                var $inputs = $(".table-bordered :input");
                var values = {};
                $inputs.each(function() {
                    values[this.name] = $(this).val();
                });
                var gender = $('#select_gender').find(":selected").val();

                $.ajax({
                    url: "includes/adm_conn.php",
                    type: "POST",
                    data: {
                        values: values,
                        gender: gender,
                        mid: "<?php echo $pid ?>",
                        type: "adminEdit",

                    },
                    cache: false,
                    success: function(response) {
                        console.log(response);
                        Swal.fire({
                            title: 'Success',
                            text: 'Record has been changed',
                            icon: 'success',
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        })
                    }
                });
            }
        });

        $(".view_delete").click(function(e) {
            e.preventDefault();
            if (confirm("Are you sure?")) {
                $.ajax({
                    url: "includes/adm_conn.php",
                    type: "POST",
                    data: {
                        mid: "<?php echo $pid ?>",
                        type: "adminDelete",
                    },
                    cache: false,
                    success: function(response) {
                        console.log(response);
                        Swal.fire({
                            title: 'Success',
                            text: 'Record has been deleted',
                            icon: 'success',
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "patient-list.php";
                            }
                        })
                    }
                });
            }
        });

        $('#datepicker').on('changeDate', function() {
            var date = $(this).datepicker('getDate'),
                year = date.getFullYear(),
                current_year = new Date().getFullYear(),
                totalyear = current_year - year;
            $('#inputAge').val(totalyear);
        });

        $(document).ready(function() {
            $('#exampleModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var img = button.data('img')
                $(".outImg").attr("src", img);
            })

            $('#editModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var feedback = button.data('feedback')
                var pbe = button.data('pbe')
                $('#feedback').val(feedback);
                $('#pbe').val(pbe);

            })
        });
    </script>
</body>

</html>