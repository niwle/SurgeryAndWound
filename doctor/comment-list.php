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
                                            <th width="10%">Patient Registration ID</th>
                                            <th width="15%">Patient Name</th>
                                            <th>Pattient Picture</th>
                                            <th>Feedback</th>
                                            <th>Feedback Date</th>
                                            <th width="10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        $table_result = mysqli_query($conn, "SELECT um.m_id as patient_id, um.m_regis_id as regis_id, um.m_name as patient_name, pbe.progressImage, pbe.entryID, wif.* FROM user_master um 
                                        inner join  progress_book_entry pbe on pbe.masterUserid_fk = um.m_id
                                        inner join  wound_image_feedback wif on wif.progress_entry_id = pbe.entryID
                                        WHERE um.m_type = 'p' and wif.doctor_inCharge = '$sess_id'");

                                        while ($table_row = mysqli_fetch_assoc($table_result)) {
                                        ?>
                                            <tr>
                                                <td><?php echo $table_row["regis_id"]; ?></td>
                                                <td><?php echo $table_row["patient_name"]; ?></td>
                                                <td><img style="width: 50%; height: 50%;" src="../uploads/patient_img/<?= $table_row["patient_id"] ?>/<?= $table_row["progressImage"] ?>" alt="No Image">
                                                    <button type='button' data-img='../uploads/patient_img/<?= $table_row["patient_id"] ?>/<?= $table_row["progressImage"] ?>' data-toggle='modal' data-target='#exampleModal' style='padding-left:20px; padding-right:20px' class='btn btn-outline-primary'>Click to enlarge</button>
                                                </td>
                                                <td><?php echo $table_row["feedback_text"]; ?></td>
                                                <td><?php echo $table_row["dateCreated"]; ?></td>
                                                <td><a href="doctor-feedback.php?f=<?php echo base64_encode($table_row["entryID"]); ?>" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> View</a></td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                    <!-- <tfoot>
                                        <tr>
                                            <th>Patient ID #</th>
                                            <th>Patient Name</th>
                                            <th>Date of Birth</th>
                                            <th>Phone Number</th>
                                            <th>Date Added</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot> -->
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
    </div>

    <?php include JS_PATH; ?>
    <script>
        $(document).ready(function() {
            $('#exampleModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var img = button.data('img')
                console.log(img);
                $(".outImg").attr("src", img);
            })

        });
    </script>
</body>

</html>