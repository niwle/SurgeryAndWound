<?php
include_once '../../config/database.php';
include_once '../../config/security.php';
//Check Result here
function actionResult($result, $sql, $conn)
{
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
    // $pid = isset($_POST["mid"])? decrypt_url($_POST["mid"]) : "";

    //upload excel to database
    if ($type == "adminUpload") {

        $executeBulkSQL = "";
        $info = json_decode(($_POST['info']), true);

        // print_r($info);

        foreach ($info as $v) {
            $m_name = mysqli_real_escape_string($conn, $v['m_name']);
            $m_identity = mysqli_real_escape_string($conn, $v['m_identity']);
            $m_type = mysqli_real_escape_string($conn, $v['m_type']);
            $m_regis_id = mysqli_real_escape_string($conn, $v['m_regis_id']);
            $m_gender = mysqli_real_escape_string($conn, $v['m_gender']);
            $email = mysqli_real_escape_string($conn, $v['email']);
            $phone = mysqli_real_escape_string($conn, $v['phone']);

            $executeBulkSQL .=
                "INSERT INTO user_master (m_name, m_identity, m_type, m_regis_id, m_gender, email, phone, created_at, updated_at) 
            VALUES ('$m_name', '$m_identity', '$m_type', '$m_regis_id', '$m_gender', '$email', '$phone', '$current_date', '$current_date');";
        }
        // print_r($executeBulkSQL);
        $result = $conn->multi_query($executeBulkSQL);
    }


    if ($type == "adminEdit") {
        $arr = $_POST['values'];
        $name =  mysqli_real_escape_string($conn, $arr['m_name']);
        $identification =  mysqli_real_escape_string($conn, $arr['m_identity']);
        $m_gender =  mysqli_real_escape_string($conn, $arr['m_gender']);
        $email =  mysqli_real_escape_string($conn, $arr['email']);
        $phone =  mysqli_real_escape_string($conn, $arr['phone']);
        $m_nationality =  mysqli_real_escape_string($conn, $arr['m_nationality']);
        $m_dob =  mysqli_real_escape_string($conn, $arr['inputDOB']);
        $m_city =  mysqli_real_escape_string($conn, $arr['m_city']);
        $m_zipcode =  mysqli_real_escape_string($conn, $arr['m_zipcode']);
        $m_state =  mysqli_real_escape_string($conn, $arr['m_state']);
        $id =  mysqli_real_escape_string($conn, $_POST['mid']);


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

        print_r($sql);
        $result = mysqli_query($conn, $sql);
        // print_r($result);
    }

    if ($type == "SaveFeedback") {
        $arr = $_POST;

        $feedback =  mysqli_real_escape_string($conn, $arr['feedback']);
        $wif =  mysqli_real_escape_string($conn, $arr['wif']);


        $sql = "UPDATE wound_image_feedback 
        SET feedback_text = '$feedback' 
        where f_id = '$wif';";

        $result = mysqli_query($conn, $sql);
        print_r($result);
    }

    if ($type == "saveNewFeedback") {
        $arr = $_POST;

        $feedback =  mysqli_real_escape_string($conn, $arr['feedback']);
        $pbe =  mysqli_real_escape_string($conn, $arr['pbe']);
        $din =  base64_decode(mysqli_real_escape_string($conn, $arr['din']));
        $sql = "INSERT INTO wound_image_feedback (progress_entry_id, feedback_text, doctor_inCharge) VALUES ('$pbe', '$feedback', '$din')";
        $result = mysqli_query($conn, $sql);
    }

    if ($type == "DeleteFeedback") {
        $arr = $_POST;
        $wif =  mysqli_real_escape_string($conn, $arr['wif']);

        $sql = "DELETE FROM wound_image_feedback WHERE f_id='$wif';";
        $result = mysqli_query($conn, $sql);
    }

    if ($type == "adminSaveFeedback") {
        $arr = $_POST;

        $feedback =  mysqli_real_escape_string($conn, $arr['feedback']);
        $pbe =  mysqli_real_escape_string($conn, $arr['pbe']);


        $sql = "UPDATE progress_book_entry 
        SET progressDescription = '$feedback' 
        where entryID = '$pbe';";

        $result = mysqli_query($conn, $sql);
        print_r($result);
    }

    if ($type == "adminDelete") {
        $id =  mysqli_real_escape_string($conn, $_POST['mid']);
        $SQL = "UPDATE user_master SET flag = '0' where m_id = '$id';";
        // $SQL = "DELETE FROM user_master WHERE m_id = '$id';";        
        $result = $conn->query($SQL);
    }

    if ($type == "adminRestore") {
        $id =  mysqli_real_escape_string($conn, $_POST['id']);
        $SQL = "UPDATE user_master SET flag = '1' where m_id = '$id';";

        $result = $conn->query($SQL);
        actionResult($result, $sql, $conn);
    }

    if ($type == "adminExport") {
        echo "true";
    }

    if ($type == "assignDr") {
        $id =  mysqli_real_escape_string($conn, $_POST['id']);
        $dr_val =  mysqli_real_escape_string($conn, $_POST['dr_val']);
        $SQL = "UPDATE user_master SET doctor_inCharge = '$dr_val' where m_id = '$id';";

        $result = $conn->query($SQL);
        actionResult($result, $sql, $conn);
    }

    if ($type == "1entEdit") {
        $progressTitle = $_POST['title'];
        $progressDescription = $_POST['comment'];
        $quesFluid = $_POST['fluidwound'];
        $quesRedness = $_POST['redwound'];
        $quesSwelling = $_POST['swellwound'];
        $quesOdour = $_POST['odourwound'];
        $quesFever = $_POST['fever'];
        $quespain = $_POST['quespain'];
        $imgchanged = ($_POST['imgchanged']) == "true";
        $entryID = $_POST['eid'];

        //create folder if folder not exists
        $dirname = $userID;
        $filename = "../img/" . $dirname . "/";

        $file = ($_FILES['file']);
        $imgname = $file["name"];
        $imgtype = $file["type"];
        $imgtempname = $file["tmp_name"];
        $imgerror = $file["error"];
        $imgsize = $file["size"];
        $fileext = explode(".", $imgname);
        $fileActualext = strtolower(end($fileext));

        $imgnewname = $fileext[0] . "." . uniqid('', true) . "." . $fileActualext;
        $imgdestination = "../img/" . $dirname . "/" . $imgnewname;

        if ($imgchanged) {
            $sql = "UPDATE progress_book_entry set progressImage = ?, progressTitle = ?,  progressDescription = ?, quesPain = ?, quesFluid = ?, quesRedness = ?, quesSwelling = ?, quesOdour = ?, quesFever = ?, updated_at = ? WHERE entryID = ?";
        } else {
            $sql = "UPDATE progress_book_entry set progressTitle = ?,  progressDescription = ?, quesPain = ?, quesFluid = ?, quesRedness = ?, quesSwelling = ?, quesOdour = ?, quesFever = ?, updated_at = ? WHERE entryID = ?";
            // $sql = "UPDATE progress_book_entry set progressTitle = ? WHERE entryID = ?";
        }

        if ($stmt = $conn->prepare($sql)) {
            if ($imgchanged) {
                $stmt->bind_param('ssssssssssi', $imgnewname, $progressTitle, $progressDescription, $quespain, $quesFluid, $quesRedness, $quesSwelling, $quesOdour, $quesFever, $current_date, $entryID);
            } else {
                $stmt->bind_param('sssssssssi', $progressTitle, $progressDescription, $quespain, $quesFluid, $quesRedness, $quesSwelling, $quesOdour, $quesFever, $current_date, $entryID);
            }

            if ($status = $stmt->execute()) {

                if ($imgchanged) {
                    if (!file_exists($filename)) {
                        mkdir("../img/" . $dirname, 0777);
                    }
                    move_uploaded_file($imgtempname, $imgdestination);
                }
            } else {
                $error = $stmt->error;
                print_r($error);
            }
        }
    }

    if ($type == "1entArchive") {
        // $archive = $_POST['archive'] == "true";
        $archive = 1;
        $entryID = $_POST['eid'];

        $sql = "UPDATE progress_book_entry set flag = ? WHERE entryID = ?";

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param('ii', $archive, $entryID);
            if ($status = $stmt->execute()) {
                // echo "sucess";
            } else {
                $error = $stmt->error;
            }
        }
    }

    if ($type == "1entDelete") {
        $delete = 0;
        $entryID = $_POST['eid'];

        $sql = "UPDATE progress_book_entry set flag = ? WHERE entryID = ?";

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param('ii', $delete, $entryID);
            if ($status = $stmt->execute()) {
                // echo "sucess";
            } else {
                $error = $stmt->error;
            }
        }
    }
}
