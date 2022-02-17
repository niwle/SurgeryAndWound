<?php

// include_once '../../../script/define.php';
// include_once _DBLOCATION_; 
// include_once '../../../assets/includes/config_inc.php';
include_once '../../config/database.php';
include_once '../../config/security.php';


if (isset($_POST['type'])) {
    $type = $_POST['type'];
    $userID = (isset($_POST['tgt']))? base64_decode($_POST['tgt']) : "";
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $current_date = date('Y-m-d H:i:s');

    function compressImage($source, $destination, $quality) { 
        // Get image info 
        $imgInfo = getimagesize($source); 
        $mime = $imgInfo['mime']; 
         
        // Create a new image from file 
        switch($mime){ 
            case 'image/jpeg': 
                $image = imagecreatefromjpeg($source); 
                break; 
            case 'image/png': 
                $image = imagecreatefrompng($source); 
                break; 
            case 'image/gif': 
                $image = imagecreatefromgif($source); 
                break; 
            default: 
                $image = imagecreatefromjpeg($source); 
        } 
         
        // Save image 
        imagejpeg($image, $destination, $quality); 
         
        // Return compressed image 
        return $destination; 
    } 

    if ($type == "1entUpload") {
        $progressTitle = $_POST['title'];
        $progressDescription = $_POST['comment'];
        $quesFluid = $_POST['fluidwound'];
        $quesRedness = $_POST['redwound'];
        $quesSwelling = $_POST['swellwound'];
        $quesOdour = $_POST['odourwound'];
        $quesFever = $_POST['fever'];
        $quespain = $_POST['quespain'];

        //create folder if folder not exists
        $dirname = $userID;
        $filename = "../../uploads/patient_img/" . $dirname . "/";

        $file = ($_FILES['file']);
        $imgname = $file["name"];
        $imgtype = $file["type"];
        $imgtempname = $file["tmp_name"];
        $imgerror = $file["error"];
        $imgsize = $file["size"];
        $fileext = explode(".", $imgname);
        $fileActualext = strtolower(end($fileext));

        $imgnewname = $fileext[0] . "." . uniqid('', true) . "." . $fileActualext;
        $imgdestination = "../../uploads/patient_img/" . $dirname . "/" . $imgnewname;

        $sql = "INSERT INTO progress_book_entry (masterUserid_fk, progressImage, progressTitle, progressDescription, quesPain, quesFluid, quesRedness, quesSwelling, quesOdour, quesFever, created_at, updated_at) VALUES(?,?,?,?,?,?,?,?,?,?,?,?);";

        if ($conn->prepare($sql)) {
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ssssssssssss',  $userID, $imgnewname, $progressTitle, $progressDescription, $quespain, $quesFluid, $quesRedness, $quesSwelling, $quesOdour, $quesFever, $current_date, $current_date);
            print_r($stmt);
            if ($status = $stmt->execute()) {
                print_r($status);
                if (!file_exists($filename)) {
                    mkdir("../../uploads/patient_img/" . $dirname, 0777);
                }
                $compressedImage = compressImage($imgtempname, $imgdestination, 90); 
                // move_uploaded_file($imgtempname, $imgdestination);
            } else {
                $error = $stmt->error;
                print_r($error);
            }
        }
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

        if(isset($_FILES['file'])){

        }
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
    if ($type == "1entUnarchive") {
        // $archive = $_POST['archive'] == "true";
        $unarchive = 2;
        $entryID = $_POST['eid'];

        $sql = "UPDATE progress_book_entry set flag = ? WHERE entryID = ?";

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param('ii', $unarchive, $entryID);
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
