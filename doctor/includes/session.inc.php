<?php

    if ($_SESSION["loggedin"] != 1){
        header("Location: login.php");
    }

    $sess_id = $_SESSION["d_sess_id"];
    $doctorstmt = $conn->prepare("SELECT * FROM user_master WHERE m_id = ?");
    $doctorstmt->bind_param("i", $sess_id);
    $doctorstmt->execute();
    $doctor_result = $doctorstmt->get_result();
    $doctor_row = $doctor_result->fetch_assoc();
    
    // $clinic_count = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM clinics"));
    
    $pt_row = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM user_master where m_type = 'p'"));
    $ptic_row = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM user_master where doctor_inCharge = '$sess_id'"));
    $cmt_row = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM wound_image_feedback where doctor_inCharge = '$sess_id'"));
    
    $doctorstmt->close();
