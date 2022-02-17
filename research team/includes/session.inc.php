<?php

    if ($_SESSION["rt_loggedin"] != 1){
        header("Location: login.php");
    }

    $sess_id = $_SESSION["sess_rtid"];
    $rtstmt = $conn->prepare("SELECT * FROM user_master WHERE m_id = ?");
    $rtstmt->bind_param("i", $sess_id);
    $rtstmt->execute();
    $rt_result = $rtstmt->get_result();
    $rt_row = $rt_result->fetch_assoc();
    
    // $clinic_count = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM clinics"));
    $patient_count = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM user_master WHERE m_type = 'P'"));
    $doctor_count = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM user_master WHERE m_type = 'D'"));
    $img_count = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM progress_book_entry"));
    
    $rtstmt->close();
