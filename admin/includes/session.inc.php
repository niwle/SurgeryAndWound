<?php

    if ($_SESSION["admin_loggedin"] != 1){
        header("Location: login.php");
    }

    $sess_id = $_SESSION["sess_adminid"];
    $adminstmt = $conn->prepare("SELECT * FROM user_master WHERE m_id = ?");
    $adminstmt->bind_param("i", $sess_id);
    $adminstmt->execute();
    $admin_result = $adminstmt->get_result();
    $admin_row = $admin_result->fetch_assoc();
    
    // $clinic_count = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM clinics"));
    $patient_count = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM user_master WHERE m_type = 'P'"));
    $doctor_count = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM user_master WHERE m_type = 'D'"));
    $img_count = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM progress_book_entry"));
    
    $adminstmt->close();
