<?php
require_once("../config/autoload.php");
include("includes/session.inc.php");
include("includes/path.inc.php");
include(SELECT_HELPER);

// $result = mysqli_query($conn, "SELECT * FROM user_master WHERE m_id = $pid");
// $row = mysqli_fetch_assoc($result);
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
        <?php 
        
        function flag($num){
            switch ($num) {
                case '1':
                    return "Archived";
                case '2':
                    return "Active";
                
                default:
                    return "Deleted";
            }
        }

        ?>
        <!-- Page content -->
        <div class="row">
            <div class="col-12">
                <!-- Card Content -->
                <div class="card shadow-sm rounded">
                    <div class="card-body">
                        
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