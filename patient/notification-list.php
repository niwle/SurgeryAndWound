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
        <?php
        // $getNotification = "select pbe.*,um.m_name as patient_name, um.m_id from progress_book_entry pbe 
        //      inner join user_master um on um.m_id = pbe.masterUserid_fk
        //      where um.doctor_inCharge = $sess_id ORDER BY updated_at DESC";
        // $result_notification = $conn->query($getNotification);

        ?>
        <!-- Page content -->
        <div class="row">
            <div class="col-12">
                <!-- Card Content -->
                <div class="card shadow-sm rounded">
                    <div class="card-body">
                        <div class="card-inner">

                            <input type="text" id="myInput" onkeyup="myFunction()" class="form-control" placeholder="Search Notification">
                            <hr>
                            <ul id="myUL">

                                <?php if (!empty($notification_log)) : ?>
                                    <?php foreach ($notification_log as $n_arr) : ?>
                                        <li>
                                        <a href="patient-edit-view.php?f=<?= base64_encode($n_arr['progress_entry_id']) ?>">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <!-- Card Content -->
                                                        <div class="card shadow-sm rounded">
                                                            <div class="card-body">
                                                                <div class="card-inner">
                                                                    <div class="d-flex justify-content-between">
                                                                        <div style="color: black;">
                                                                            Feedback received for <b><?= $n_arr['progressTitle'] ?></b>
                                                                            <?php
                                                                             if ($n_arr['view'] == '0') {
                                                                                echo " <span style='border-radius: 30px;
                                                                                background-color: #007bff;
                                                                                color:white;
                                                                                padding: 1px 5px 1px 5px;
                                                                                font-size: small;'>New</span>";
                                                                            }
                                                                            ?>
                                                                        </div>
                                                                        <div class="text-muted" style="font-size: 0.8em;"><?= $n_arr['dateCreated'] ?></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- End Card Content -->
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    <?php endforeach ?>
                                <?php else : ?>
                                    <li>
                                        <div class="row">
                                            <div class="col-12">
                                                <!-- Card Content -->
                                                <div class="card shadow-sm rounded">
                                                    <div class="card-body">
                                                        <div class="card-inner">
                                                            *No Notification
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Card Content -->
                                            </div>
                                        </div>
                                    </li>

                                <?php endif ?>

                            </ul>
                        </div>
                    </div>
                </div>
                <!-- End Card Content -->
            </div>
        </div>
        <!-- End Page Content -->
        <!-- Modal -->
    </div>

    <?php include JS_PATH; ?>
    <script>
        function myFunction() {
            var input, filter, ul, li, a, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            ul = document.getElementById("myUL");
            li = ul.getElementsByTagName("li");
            for (i = 0; i < li.length; i++) {
                a = li[i].getElementsByTagName("a")[0];
                txtValue = a.textContent || a.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    li[i].style.display = "";
                } else {
                    li[i].style.display = "none";
                }
            }
        }
    </script>
</body>

</html>