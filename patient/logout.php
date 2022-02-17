<?php
    session_start();
    session_unset($_SESSION['sess_id']);
    session_unset($_SESSION['sess_email']);
    session_unset($_SESSION['loggedin']);
    session_destroy();
    header("Location: login.php");
?>