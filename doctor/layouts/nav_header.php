<style>
    .dropdown-menu {
        top: 30px;
        max-height: 500px;
        overflow-y: auto;
    }

    .dropdown-menu .dropdown-item {
        min-width: 300px;
        font-weight: 400;
        line-height: 2;
        color: #333;
        border-bottom: 1px solid #f4f4f4;
    }
</style>
<nav class="navbar navbar-header mb-2">
    <ul class="nav mr-auto">
        <li class="nav-item">
            <button class="btn btn-sm btn-expand" id="sidebarCollapse"><i class="fa fa-bars"></i></button>
        </li>
        <li class="nav-item nav-title">
            <a href="<?php echo $_SERVER["REQUEST_URI"]; ?>"><?php echo $CURRENT_PAGE; ?></a>
        </li>
        <!-- <li class="nav-item">
            <ul class="breadcrumbs">
                <li><a href="<?php echo $HOME_PAGE; ?>">Home</a></li>
                <li><span><?php echo $CURRENT_PAGE; ?></span></li>
            </ul>
        </li> -->
    </ul>
    <ul class="nav ml-auto">
        <li class="nav-item mr-2">
            <div style="display: inline-block;">
                <button class="btn btn-sm btn-expand" id="notification_button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bell"></i> </button>
                <span class="badge badge-pill badge-primary" style="position: relative; right: 15px; top: -10px;">
                    <?php
                    $notification_count = 0;
                    $notification_arr = $notification_log =[];
                    $getNotification = "select pbe.*,um.m_name as patient_name, um.m_id from progress_book_entry pbe 
                    inner join user_master um on um.m_id = pbe.masterUserid_fk
                    where um.doctor_inCharge = $sess_id";
                    $result_notification = $conn->query($getNotification);

                    while ($row_notification = $result_notification->fetch_assoc()) {
                        if (!strpos($row_notification['view_by'], strval($sess_id))) {
                            $notification_arr[] = $row_notification;
                            $notification_count++;
                        }
                        $notification_log [] = $row_notification;
                    }
                    if ($notification_count < 100) {
                        echo $notification_count;
                    } else {
                        echo '99+';
                    }
                    ?>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="notification_button">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h5 class="dropdown-header"><b>New</b></h5>
                            </div>
                            <div align='right'>
                                <h5 class="dropdown-header"><span class="badge badge-primary" ><a href="notification-list.php" style="color:#f4f4f4">View All</a></span></h5>
                                
                            </div>
                        </div>


                        <?php if (!empty($notification_arr)) : ?>
                            <?php foreach ($notification_arr as $n_arr) : ?>
                                <a href="doctor-feedback.php?f=<?= base64_encode($n_arr['entryID']) ?>" class="dropdown-item">New Image/Description by <b><?= $n_arr['patient_name'] ?></b>
                                    <div class="text-muted" style="font-size: 0.8em;"><?= $n_arr['created_at'] ?></div>
                                </a>
                            <?php endforeach ?>
                        <?php else : ?>
                            <div class="dropdown-item">No New Notification</div>
                        <?php endif ?>

                        
                        

                    </div>
                </span>
            </div>
        </li>
        <li class="nav-item mr-2">
            <button class="btn btn-sm btn-expand" id="full-view"><i class="fa fa-expand"></i></button>
            <button class="btn btn-sm btn-expand" id="full-view-exit"><i class="fa fa-compress"></i></button>
        </li>
        <li class="nav-item">
            <div class="btn-group">
                <button type="button" class="btn btn-sm dropdown-toggle btn-profile px-3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Hi, <?php echo $doctor_row["m_name"]; ?>
                </button>
                <?php $encrypt_id = urlencode(base64_encode($doctor_row["m_id"])); ?>
                <div class="dropdown-menu dropdown-menu-right">
                    <!-- <a href="#" class="dropdown-item"><i class="fa fa-tools mr-2"></i>Settings</a> -->
                    <!-- <a href="password.php" class="dropdown-item"><i class="fa fa-unlock-alt mr-2"></i>Change Password</a> -->
                    <a href="profile.php?aid=<?php echo $encrypt_id; ?>" class="dropdown-item"><i class="fa fa-users-cog mr-2"></i>Manage Profile</a>
                    <div class="dropdown-divider"></div>
                    <a href="logout.php" class="dropdown-item"><i class="fa fa-sign-out-alt mr-2"></i>Log Out</a>
                </div>
            </div>
        </li>
    </ul>
</nav>