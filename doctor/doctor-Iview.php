<?php
include("../config/autoload.php");
include("includes/session.inc.php");
include("includes/path.inc.php");
$current_link = htmlspecialchars($_SERVER["PHP_SELF"]);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include CSS_PATH; ?>
</head>

<body>
    <?php include NAVIGATION; ?>
    <!-- Page content holder -->
    <div class="page-content" id="content">
        <?php include HEADER; ?>
        <?php
        $user_id = $_SESSION['sess_id'];
        $enc = base64_encode($user_id);
        $sql = "SELECT * FROM progress_book_entry WHERE masterUserid_fk = $user_id;";
        $result = $conn->query($sql);


        if (($result->num_rows) == 0) {
            $status = "no data"; //meaning no existing data    
        }

        ?>

        <!-- Page content -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <?php while ($row = $result->fetch_assoc()) : ?>
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <a href="patient-edit-view.php?f=<?php echo $row['entryID'] ?>">
                                                <div class="row">
                                                    <div class="col-4">
                                                        <?php
                                                        $imglocation = $row['progressImage'];
                                                        $fulllocation = ("../uploads/patient_img/$user_id/$imglocation");
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
                                                            <p class="card-text">Feedback received: <?php $entryID = $row['entryID']; echo mysqli_num_rows(mysqli_query($conn,"SELECT * FROM wound_image_feedback where progress_entry_id = '$entryID'")); ?> </p>
                                                            <!-- <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Page Content -->
    </div>
    <?php include JS_PATH; ?>
</body>

</html>