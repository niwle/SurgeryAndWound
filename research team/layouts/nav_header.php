<nav class="navbar navbar-header mb-2">
    <ul class="nav mr-auto">
        <li class="nav-item">
            <button class="btn btn-sm btn-expand" id="sidebarCollapse"><i class="fa fa-bars"></i></button>
        </li>
        <li class="nav-item nav-title">
            <a href="<?php echo $_SERVER["REQUEST_URI"];?>"><?php echo $CURRENT_PAGE;?></a>
        </li>
    </ul>
    <ul class="nav ml-auto">
        <li class="nav-item mr-2">
            <button class="btn btn-sm btn-expand" id="full-view"><i class="fa fa-expand"></i></button>
            <button class="btn btn-sm btn-expand" id="full-view-exit"><i class="fa fa-compress"></i></button>
        </li>
        <li class="nav-item">
            <div class="btn-group">
                <button type="button" class="btn btn-sm dropdown-toggle btn-profile px-3" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    Hi, <?php echo $rt_row["m_name"]; ?>
                </button>
                <?php $encrypt_id = urlencode(base64_encode($rt_row["m_id"])); ?>
                <div class="dropdown-menu dropdown-menu-right">
                    
                    <a href="profile.php?aid=<?php echo $encrypt_id; ?>" class="dropdown-item"><i class="fa fa-users-cog mr-2"></i>Manage Profile</a>
                    <div class="dropdown-divider"></div>
                    <a href="logout.php" class="dropdown-item"><i class="fa fa-sign-out-alt mr-2"></i>Log Out</a>
                </div>
            </div>
        </li>
    </ul>
</nav>