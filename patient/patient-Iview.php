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

        $active_img = [];
        $archived_img = [];




        if (($result->num_rows) == 0) {
            $status = "no data"; //meaning no existing data    
        } else {
            foreach ($result as $row) {
                switch ($row['flag']) {
                    case '1':
                        $archived_img[] = $row;
                        break;
                    case '2':
                        $active_img[] = $row;
                        break;
                }
            }
        }

        ?>

        <!-- Page content -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#active_image" role="tab" aria-controls="nav-home" aria-selected="true">Active</a>
                                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#archived_photo" role="tab" aria-controls="nav-contact" aria-selected="false">Archived</a>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="active_image" role="tabpanel" aria-labelledby="info-tab">
                                <?php foreach ($active_img as $row) : ?>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <a href="patient-edit-view.php?f=<?php echo base64_encode($row['entryID'])  ?>">
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
                                                                    <p class="card-text">Feedback received: 
                                                                        <?php 
                                                                        $entryID = $row['entryID']; 
                                                                        $getFeedback = "SELECT * FROM wound_image_feedback where progress_entry_id = '$entryID'";
                                                                        $result_fb = $conn->query($getFeedback);
                                                                        $num_rows_fb =$result_fb->num_rows;
                                                                        echo $num_rows_fb;
                                                                        while($row_fb = $result_fb->fetch_assoc()){
                                                                            if($row_fb['view']=='0'){
                                                                                echo " <span style='border-radius: 30px;
                                                                                background-color: #007bff;
                                                                                color:white;
                                                                                padding: 1px 5px 1px 5px;
                                                                                font-size: small;'>New</span>";
                                                                                break;
                                                                            }
                                                                        }
                                                                        ?> 
                                                                    </p>
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

                            </div>

                            <div class="tab-pane fade" id="archived_photo" role="tabpanel" aria-labelledby="comments-tab">
                                <?php foreach ($archived_img as $row) : ?>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <a href="patient-edit-view.php?f=<?php echo base64_encode($row['entryID']) ?>">
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
                                                                    <p class="card-text">Feedback received: 
                                                                        <?php 
                                                                        $entryID = $row['entryID']; 
                                                                        $getFeedback = "SELECT * FROM wound_image_feedback where progress_entry_id = '$entryID'";
                                                                        $result_fb = $conn->query($getFeedback);
                                                                        $num_rows_fb =$result_fb->num_rows;
                                                                        echo $num_rows_fb;
                                                                        while($row_fb = $result_fb->fetch_assoc()){
                                                                            if($row_fb['view']=='0'){
                                                                                echo " <span style='border-radius: 30px;
                                                                                background-color: #007bff;
                                                                                color:white;
                                                                                padding: 1px 5px 1px 5px;
                                                                                font-size: small;'>New</span>";
                                                                                break;
                                                                            }
                                                                        }
                                                                        ?> 
                                                                    </p>
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

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- End Page Content -->
    </div>
    <?php include JS_PATH; ?>
</body>

</html>