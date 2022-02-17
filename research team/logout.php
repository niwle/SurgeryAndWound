<?php
    session_start();
    session_unset($_SESSION['sess_rtid']);
    session_unset($_SESSION['sess_rtemail']);
    session_unset($_SESSION['rt_loggedin']);
    session_destroy();
    header("Location: login.php");
?>