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
                                            <th>Patient ID #</th>
                                            <th>Patient Name</th>
                                            <th>Date of Birth</th>
                                            <th>Phone Number</th>
                                            <th>Date Added</th>
                                            <th>Image Submitted Count</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($_GET['t'] == base64_encode('p')) {
                                            $table_result = mysqli_query($conn, "SELECT * FROM user_master WHERE m_type = 'p' and flag ='1'");
                                        } else {
                                            $table_result = mysqli_query($conn, "SELECT * FROM user_master WHERE m_type = 'd' and flag ='1'");
                                        }
                                        while ($table_row = mysqli_fetch_assoc($table_result)) {
                                        ?>
                                            <tr>
                                                <td><?php echo $table_row["m_id"]; ?></td>
                                                <td><?php echo $table_row["m_name"]; ?></td>
                                                <td><?php echo $table_row["m_dob"]; ?></td>
                                                <td><?php echo $table_row["phone"]; ?></td>
                                                <td><?php echo $table_row["created_at"]; ?></td>
                                                <td align="center">
                                                        <?php  
                                                            $pr_id = $table_row["m_id"];
                                                            $getFeedbackCount = "SELECT * from progress_book_entry where masterUserid_fk = '$pr_id' and flag != '0'";
                                                            echo (($conn->query($getFeedbackCount))->num_rows) ;
                                                        ?>
                                                    </td>
                                                <?php if (($_GET['t'])==base64_encode('p')) : ?>
                                                    <td><a href="patient-doctor-view.php?pid=<?php echo encrypt_url($table_row["m_id"]); ?>&t=<?=base64_encode('p')?>" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> View</a></td>
                                                <?php else : ?>
                                                    <td><a href="patient-doctor-view.php?pid=<?php echo encrypt_url($table_row["m_id"]); ?>&t=<?=base64_encode('d')?>" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> View</a></td>
                                                <?php endif ?>
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
    </div>

    <?php include JS_PATH; ?>
</body>

</html>