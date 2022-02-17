<?php
include_once '../../config/database.php';
include_once '../../config/security.php';
//Check Result here
function actionResult($result, $sql, $conn){
    if (!$result) {
        echo 'Fail update, please check which dB u are updating to.';
        echo ("\n\nError description: " . $conn->error);
        echo ("\n\nSQL: " . $sql);     
    } else {
        echo 'Success update';
    }
}
if (isset($_POST['type'])) {
    $type = $_POST['type'];
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $current_date = date('Y-m-d H:i:s');
    $pid = isset($_POST["mid"])? decrypt_url($_POST["mid"]) : "";

    //upload excel to database
    if ($type == "adminUpload") {
        // $m_name="";
        // $m_type="";
        // $password="";
        
        $executeBulkSQL = "";
        $info = (($_POST['info']));
        foreach ($info as $v) {
            $m_name = mysqli_real_escape_string($conn, $v['m_name']);
            $m_ic = mysqli_real_escape_string($conn, $v['m_ic']);
            $m_type = mysqli_real_escape_string($conn, $v['m_type']);
            // $email = mysqli_real_escape_string($conn, $_POST['email']);
            // $phone = mysqli_real_escape_string($conn, $_POST['phone']);
            // $occupation = mysqli_real_escape_string($conn, $_POST['occ']);
            // $pass1 = password_hash(mysqli_real_escape_string($conn, $_POST['pass1']), PASSWORD_BCRYPT);
            // $pass2 = mysqli_real_escape_string($conn, $_POST['pass2']);
            $executeBulkSQL .= "INSERT INTO user_master (m_name, m_identity, m_type, created_at, updated_at) VALUES ('$m_name', '$m_ic', '$m_type', '$current_date', '$current_date');";
        }

        $result = $conn->multi_query($executeBulkSQL);
    }


    if($type == "adminEdit"){
        $arr = $_POST['values'];
        $name =  mysqli_real_escape_string($conn,$arr['m_name']);
        $identification =  mysqli_real_escape_string($conn,$arr['m_identity']); 
        $m_gender =  mysqli_real_escape_string($conn,$arr['m_gender']); 
        $email =  mysqli_real_escape_string($conn,$arr['email']); 
        $phone =  mysqli_real_escape_string($conn,$arr['phone']); 
        $m_nationality =  mysqli_real_escape_string($conn,$arr['m_nationality']); 
        $m_dob =  mysqli_real_escape_string($conn,$arr['inputDOB']); 
        $m_city =  mysqli_real_escape_string($conn,$arr['m_city']); 
        $m_zipcode =  mysqli_real_escape_string($conn,$arr['m_zipcode']); 
        $m_state =  mysqli_real_escape_string($conn,$arr['m_state']); 

        $id =  $pid;


        $sql = "UPDATE user_master 
        SET m_name = '$name', 
        m_identity = '$identification', 
        m_gender = '$m_gender', 
        email = '$email', 
        phone = '$phone', 
        m_nationality = '$m_nationality', 
        m_dob = '$m_dob', 
        m_city = '$m_city', 
        m_zipcode = '$m_zipcode', 
        m_state = '$m_state', 
        updated_at ='$current_date' 
        where m_id = '$id';";
        
        // print_r($sql);
        $result = mysqli_query($conn, $sql);
        print_r($result);
    }

    if($type == "SaveFeedback"){
        $arr = $_POST;
       
        $feedback =  mysqli_real_escape_string($conn,$arr['feedback']); 
        $wif =  mysqli_real_escape_string($conn,$arr['wif']); 
       

        $sql = "UPDATE wound_image_feedback 
        SET feedback_text = '$feedback' 
        where f_id = '$wif';";
        
        $result = mysqli_query($conn, $sql);
        print_r($result);
    }

    if($type == "saveNewFeedback"){
        $arr = $_POST;
       
        $feedback =  mysqli_real_escape_string($conn,$arr['feedback']); 
        $pbe =  mysqli_real_escape_string($conn,$arr['pbe']); 
        $din =  base64_decode(mysqli_real_escape_string($conn,$arr['din'])); 
        $sql = "INSERT INTO wound_image_feedback (progress_entry_id, feedback_text, doctor_inCharge) VALUES ('$pbe', '$feedback', '$din')";
        $result = mysqli_query($conn, $sql);
    }

    if($type == "DeleteFeedback"){
        $arr = $_POST;
        $wif =  mysqli_real_escape_string($conn,$arr['wif']); 

        $sql = "DELETE FROM wound_image_feedback WHERE f_id='$wif';";
        $result = mysqli_query($conn, $sql);
    }

    if($type == "adminDelete"){
        $id =  mysqli_real_escape_string($conn,$_POST['id']);
        $SQL = "UPDATE user_master SET flag = '0' where m_id = '$id';";
        
        $result = $conn->query($SQL);
        actionResult($result, $sql, $conn);
    }

    if($type == "adminRestore"){
        $id =  mysqli_real_escape_string($conn,$_POST['id']);
        $SQL = "UPDATE user_master SET flag = '1' where m_id = '$id';";
        
        $result = $conn->query($SQL);
        actionResult($result, $sql, $conn);
    }

    if($type == "adminExport"){
        echo"true";
    }

    if($type == "assignDr"){
        $id =  mysqli_real_escape_string($conn,$_POST['id']);
        $dr_val =  mysqli_real_escape_string($conn,$_POST['dr_val']);
        $SQL = "UPDATE user_master SET doctor_inCharge = '$dr_val' where m_id = '$id';";

        $result = $conn->query($SQL);
        actionResult($result, $sql, $conn);
    }

    
    
}
