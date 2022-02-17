<?php
require_once("../config/autoload.php");
include("includes/session.inc.php");
include("includes/path.inc.php");
include(SELECT_HELPER);

$pid = decrypt_url($_REQUEST["pid"]);

$result = mysqli_query($conn, "SELECT * FROM user_master WHERE m_id = $pid");
$row = mysqli_fetch_assoc($result);

$sql = "SELECT * FROM progress_book_entry WHERE masterUserid_fk = $pid;";
$result2 = $conn->query($sql);

$active_img = [];
$archived_img = [];

if (($result2->num_rows) == 0) {
    $status = "no data"; //meaning no existing data    
} else {
    foreach ($result2 as $row2) {
        switch ($row2['flag']) {
            case '1':
                $archived_img[] = $row2;
                break;
            case '2':
                $active_img[] = $row2;
                break;
        }
    }
}
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
                            <h5 class="card-title mr-auto">
                                <!-- <?= ($_GET['t'] == base64_encode('p')) ? 'View Patient' : 'View Doctor'  ?> : <?php echo strtoupper($row["m_name"]) ?> -->
                                <?php if ($_GET['t'] == base64_encode('p')) : ?>
                                    View Patient : <?php echo strtoupper($row["m_name"]) ?>
                                <?php elseif ($_GET['t'] == base64_encode('R')) : ?>
                                    View Member : <?php echo strtoupper($row["m_name"]) ?>
                                <?php else : ?>
                                    View Doctor : <?php echo strtoupper($row["m_name"]) ?>
                                <?php endif ?>
                            </h5>
                        </div>
                        <div class="card-inner">
                            <!-- View -->
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">

                                    <?php if ($_GET['t'] == base64_encode('d')) : ?>
                                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-info" role="tab" aria-controls="nav-home" aria-selected="true">Doctor Info</a>
                                        <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#photo_comments" role="tab" aria-controls="nav-contact" aria-selected="false"><?= ($_GET['t'] == base64_encode('p')) ? 'Feedback' : 'Feedback Provided'  ?></a>
                                    <?php endif ?>
                                    <?php if ($_GET['t'] == base64_encode('p')) : ?>
                                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-info" role="tab" aria-controls="nav-home" aria-selected="true">Patient Info</a>
                                        <a class="nav-item nav-link" id="nav-home-tab" data-toggle="tab" href="#active_image" role="tab" aria-controls="nav-home" aria-selected="false">Active Images</a>
                                        <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#archived_photo" role="tab" aria-controls="nav-contact" aria-selected="false">Archived Images</a>
                                    <?php endif ?>
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">
                                <!-- Doctor/patient tab-content -->
                                <div class="tab-pane fade show active" id="nav-info" role="tabpanel" aria-labelledby="info-tab">
                                    <table class="table table-bordered">
                                        <?php if (mysqli_num_rows($result) < 1) {
                                            echo '<tr><td class="text-center">No Member Record!</td></tr>';
                                        } else {
                                        ?>
                                            <tr>
                                                <?php if ($_GET['t'] == base64_encode('p')) : ?>
                                                    <th scope="row">Patient ID</th>
                                                <?php elseif ($_GET['t'] == base64_encode('R')) : ?>
                                                    <th scope="row">Member ID</th>
                                                <?php else : ?>
                                                    <th scope="row">Doctor ID</th>
                                                <?php endif ?>
                                                <th scope="row"><?php echo $row["m_id"]; ?></th>
                                            </tr>
                                            <tr>
                                                <?php if ($_GET['t'] == base64_encode('p')) : ?>
                                                    <th scope="row">Patient Registration ID</th>
                                                <?php elseif ($_GET['t'] == base64_encode('R')) : ?>
                                                    <th scope="row">Member Registration ID</th>
                                                <?php else : ?>
                                                    <th scope="row">Doctor Registration ID</th>
                                                <?php endif ?>
                                                <th scope="row"><?php echo $row["m_regis_id"]; ?></th>
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
                                                <th scope="row">Date of Birth</th>
                                                <td>
                                                    <input type="date" id="start" name="inputDOB" value="<?php echo $row["m_dob"]; ?>" class="form-control">
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

                                <!-- Doctor tab-content -->
                                <div class="tab-pane fade" id="photo_comments" role="tabpanel" aria-labelledby="comments-tab">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th width="15%">Date #</th>
                                                <th width="30%">Image</th>
                                                <th width="20%"><?= ($_GET['t'] == base64_encode('p')) ? 'Doctor Name' : 'Patient Name'  ?></th>
                                                <th>Feedback</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if ($_GET['t'] == base64_encode('p')) {
                                                $result = mysqli_query($conn, "SELECT pbe.*, um.m_name as doctor_name, wif.* FROM progress_book_entry pbe 
                                                INNER JOIN user_master um on um.m_id = pbe.dcotor_replied 
                                                left join wound_image_feedback wif on wif.progress_entry_id = pbe.entryID
                                                WHERE pbe.masterUserid_fk ='" . $pid . "'");
                                            } else {
                                                $result = mysqli_query($conn, "SELECT pbe.*, um.m_name as patient_name, wif.* FROM progress_book_entry pbe 
                                                INNER JOIN user_master um on um.m_id = pbe.masterUserid_fk 
                                                inner join wound_image_feedback wif on wif.progress_entry_id = pbe.entryID
                                                WHERE wif.doctor_inCharge =  '" . $pid . "'");
                                            }

                                            if ($result->num_rows == '0') {
                                                echo '<tr ><td colspan="5" align="center"><p>No result</p></td></tr>';
                                            }

                                            while ($row = mysqli_fetch_assoc($result)) {
                                            ?>
                                                <tr>
                                                    <td><?= $row["created_at"] ?></td>
                                                    <td><img style="width: 50%; height: 50%;" src="../uploads/patient_img/<?= ($_GET['t'] == base64_encode('p')) ? $pid : $row["masterUserid_fk"] ?>/<?= $row["progressImage"] ?>" alt="No Image">
                                                        <button type='button' data-img='../uploads/patient_img/<?= ($_GET['t'] == base64_encode('p')) ? $pid : $row["masterUserid_fk"] ?>/<?= $row["progressImage"] ?>' data-toggle='modal' data-target='#exampleModal' style='padding-left:20px; padding-right:20px' class='btn btn-outline-primary'>Click to enlarge</button>
                                                    </td>
                                                    <?php if ($_GET['t'] == base64_encode('p')) : ?>
                                                        <td>Dr. <?= $row["doctor_name"] ?></td>
                                                    <?php else : ?>
                                                        <td><?= $row["patient_name"] ?></td>
                                                    <?php endif ?>

                                                    <td><?= ($row["feedback_text"] == "") ? "*No Feedback yet" : $row["feedback_text"] ?></td>
                                                    <td>
                                                        <button type='button' data-feedback='<?= htmlspecialchars($row["feedback_text"], ENT_QUOTES)  ?>' data-wif='<?= $row["f_id"] ?>' data-toggle='modal' data-target='#editModal' name='{$no}modalPop' style='padding-left:20px; padding-right:20px' class='btn btn-outline-warning edit'>Edit</button>

                                                    </td>
                                                </tr>
                                            <?php
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
                                                            <input type="text" class="form-control" id="wif" value="" hidden>
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

                                <!-- Patient tab-content -->
                                <?php if ($_GET['t'] == base64_encode('p')) : ?>
                                    <div class="tab-pane fade show" id="active_image" role="tabpanel" aria-labelledby="info-tab">

                                        <?php foreach ($active_img as $row) : ?>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <a href="patient-edit-view.php?f=<?php echo base64_encode($row['entryID'])  ?>&t=<?= base64_encode('p') ?>">
                                                                <div class="row">
                                                                    <div class="col-4">
                                                                        <?php
                                                                        $imglocation = $row['progressImage'];
                                                                        $fulllocation = ("../uploads/patient_img/$pid/$imglocation");
                                                                        ?>
                                                                        <img src="<?php echo $fulllocation ?>" class="img-fluid rounded-start" max-width="430px" height="240px" alt="...">
                                                                    </div>
                                                                    <div class="col-8">
                                                                        <div class="card-body">
                                                                            <h5 class="card-title">Title: <?php echo $row['progressTitle'] ?></h5>
                                                                            <p class="card-text">Description: <?php echo $row['progressDescription'] ?></p>
                                                                            <p class="card-text">Created at: <?php echo $row['created_at'] ?></p>
                                                                            <p class="card-text">Last Updated at: <?php echo $row['updated_at'] ?></p>
                                                                            <hr>
                                                                            <p class="card-text">Feedback received: <?php $entryID = $row['entryID'];
                                                                                                                    echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM wound_image_feedback where progress_entry_id = '$entryID'")); ?> </p>
                                                                            <!-- <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> -->
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach ?>
                                        <?php if (empty($active_img)) : ?>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            *No Image
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif ?>

                                    </div>

                                    <div class="tab-pane fade" id="archived_photo" role="tabpanel" aria-labelledby="comments-tab">
                                        <?php foreach ($archived_img as $row) : ?>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <a href="patient-edit-view.php?f=<?php echo base64_encode($row['entryID']) ?>&t=<?= base64_encode('p') ?>">
                                                                <div class="row">
                                                                    <div class="col-4">
                                                                        <?php
                                                                        $imglocation = $row['progressImage'];
                                                                        $fulllocation = ("../uploads/patient_img/$pid/$imglocation");
                                                                        ?>
                                                                        <img src="<?php echo $fulllocation ?>" class="img-fluid rounded-start" max-width="430px" height="240px" alt="...">
                                                                    </div>
                                                                    <div class="col-8">
                                                                        <div class="card-body">
                                                                            <h5 class="card-title">Title: <?php echo $row['progressTitle'] ?></h5>
                                                                            <p class="card-text">Description: <?php echo $row['progressDescription'] ?></p>
                                                                            <p class="card-text">Created at: <?php echo $row['created_at'] ?></p>
                                                                            <p class="card-text">Last Updated at: <?php echo $row['updated_at'] ?></p>
                                                                            <hr>
                                                                            <p class="card-text">Feedback received: <?php $entryID = $row['entryID'];
                                                                                                                    echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM wound_image_feedback where progress_entry_id = '$entryID'")); ?> </p>
                                                                            <!-- <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> -->
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach ?>
                                        <?php if (empty($archived_img)) : ?>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            *No Image
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif ?>

                                    </div>
                                <?php endif ?>
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
            console.log(feedback);
            var wif = $('#wif').val();
            if (confirm("Are you sure?")) {
                $.ajax({
                    url: "includes/adm_conn.php",
                    type: "POST",
                    data: {
                        feedback: feedback,
                        wif: wif,
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
                                window.location.href = "patient-doctor-list.php?t=<?= $_GET['t'] ?>";
                                
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
                console.log(feedback);
                var wif = button.data('wif')
                $('#feedback').val(feedback);
                $('#wif').val(wif);

            })
        });
    </script>
</body>

</html>