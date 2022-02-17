<?php

    if ($_SESSION["loggedin"] != 1){
        header("Location: login.php");
    }

    $sess_id = $_SESSION["sess_id"];
    $patientstmt = $conn->prepare("SELECT * FROM user_master WHERE m_id = ?");
    $patientstmt->bind_param("i", $sess_id);
    $patientstmt->execute();
    $patient_result = $patientstmt->get_result();
    $patient_row = $patient_result->fetch_assoc();
    
    // $clinic_count = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM clinics"));
    
    $img_count = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM progress_book_entry where masterUserid_fk = '$sess_id'"));
    $img_commented_count = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM wound_image_feedback wif inner join progress_book_entry pbe on wif.progress_entry_id = pbe.entryID where masterUserid_fk = '$sess_id'"));
    
    $patientstmt->close();
