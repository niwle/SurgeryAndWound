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
    </ul>
    <ul class="nav ml-auto">
        <li class="nav-item mr-2">
            <div style="display: inline-block;">
                <button class="btn btn-sm btn-expand" id="notification_button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bell"></i> </button>
                <span class="badge badge-pill badge-primary" style="position: relative; right: 15px; top: -10px;">
                    <?php
                    $notification_count = 0;
                    $notification_arr = $notification_log =[];
                    $getNotification = "SELECT wif.*, pbe.progressTitle FROM wound_image_feedback wif
                        inner join progress_book_entry pbe on pbe.entryID = wif.progress_entry_id
                        inner join user_master um on um.m_id = pbe.masterUserid_fk where um.m_id = $sess_id";
                    $result_notification = $conn->query($getNotification);
                    while ($row_notification = $result_notification->fetch_assoc()) {
                        if ($row_notification['view'] == '0') {
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
                        <h5 class="dropdown-header"><b>New</b></h5>
                        
                        <?php if (!empty($notification_arr)) : ?>
                            <?php foreach ($notification_arr as $n_arr) : ?>
                                <a href="patient-edit-view.php?f=<?= base64_encode($n_arr['progress_entry_id'])?>" class="dropdown-item">Feedback received for <b><?= $n_arr['progressTitle'] ?></b>
                                    <div class="text-muted" style="font-size: 0.8em;"><?= $n_arr['dateCreated']?></div>
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
                    Hi, <?php echo $patient_row["m_name"]; ?>
                </button>
                <?php $encrypt_id = urlencode(base64_encode($patient_row["m_id"])); ?>
                <div class="dropdown-menu dropdown-menu-right">

                    <a href="profile.php?aid=<?php echo $encrypt_id; ?>" class="dropdown-item"><i class="fa fa-users-cog mr-2"></i>Manage Profile</a>
                    <div class="dropdown-divider"></div>
                    <a href="logout.php" class="dropdown-item"><i class="fa fa-sign-out-alt mr-2"></i>Log Out</a>
                </div>
            </div>
        </li>
    </ul>
</nav>