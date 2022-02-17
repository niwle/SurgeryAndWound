<?php
require_once('../config/autoload.php');
require_once('./includes/session.inc.php');
require_once('./includes/path.inc.php');



$enid = $_REQUEST['aid'];
$id = base64_decode(urldecode($enid));

$errors = array();

if (isset($_POST["savebtn"])) {
    // $id         = $admin_row["admin_id"];
    $name       = escape_input($_POST['inputName']);
    $email      = escape_input($_POST['inputEmailAddress']);
    $phone      = escape_input($_POST['inputPhone']);
    $m_dob      = escape_input($_POST['inputDOB']);

    if (empty($name)) {
        array_push($errors, "Name is required");
    }

    if (empty($email)) {
        array_push($errors, "Email Address is required");
    } else {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, "Invalid email format");
        }
    }
}

// Reset Password
if (isset($_POST["resetbtn"])) {
    // $id      = $admin_row["admin_id"];
    $oldpass = $conn->real_escape_string($_POST['inputOldPassword']);
    $newpass = $conn->real_escape_string($_POST['inputNewPassword']);
    $conpass = $conn->real_escape_string($_POST['inputConfirmPassword']);

    $passstmt = $conn->prepare("SELECT * FROM user_master WHERE m_id =?");
    $passstmt->bind_param("i", $id);
    $passstmt->execute();
    $result = $passstmt->get_result();
    $row = $result->fetch_assoc();
    // $token = $row["admin_token"];
    // $password = decrypt($row["admin_pass"], $token);
    $password = ($row["password"]);


    if (empty($oldpass)) {
		array_push($errors, "Password is required");
	} 
    if (empty($newpass)) {
		array_push($errors, "New Password is required");
	} 
    if (empty($conpass)) {
		array_push($errors, "Confirm Password is required");
	} 
    // if (($oldpass) != $password) {
	// 	array_push($errors, "Incorrect Password");
	// } 
    if(!passwordValidator($oldpass, $password)){
        array_push($errors, "Incorrect Password");
    }
    if (!empty($newpass)) {
        password_validation($newpass);
    } 
    if ($newpass != $conpass) {
        array_push($errors, "Password not Equal");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include CSS_PATH; ?>
</head>

<body>
    <?php
        if (isset($_POST["resetbtn"])) {
            if (count($errors) == 0) {
                // $newtoken = generateCode(22);
                // $en_pass = encrypt(md5($newpass), $newtoken);
                // $en_pass = base64_encode($newpass);
                $en_pass = password_hash($newpass, PASSWORD_BCRYPT);

                $stmt2 = $conn->prepare("UPDATE user_master SET password = ? WHERE m_id = ?");
                $stmt2->bind_param("si", $en_pass, $id);
                if ($stmt2->execute()) {
                    echo '<script>
                        Swal.fire({ title: "Great!", text: "Password Reset Successfully!", type: "success" }).then((result) => {
                            if (result.value) { 
                                var cl = window.location.href
                                window.location.href = cl 
                            }
                        })
                        </script>';
                } else {
                    echo "Error: " . $query . "<br>" . mysqli_error($conn);
                }
            }
        }

        $admin_result = $conn->query("SELECT * FROM user_master where m_id = '$id'");
        $row_res = $admin_result->fetch_assoc();
    ?>
    <?php include NAVIGATION; ?>
    <div class="page-content" id="content">
        <?php include HEADER; ?>
        <!-- Page content -->
        <div class="row">
            <div class="col-12">
                <form name="regform" method="POST" action="<?php echo htmlspecialchars($_SERVER["REQUEST_URI"]); ?>" autocomplete="off">
                    <?php echo display_error(); ?>
                    <div class="card">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputAdminID">Admin ID #</label>
                                    <input type="text" name="inputAdminID" class="form-control" id="inputAdminID" value="<?php echo $row_res["m_id"]; ?>" disabled>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputAdminID">Admin Registration ID #</label>
                                    <input type="text" name="inputAdminID" class="form-control" id="inputAdminID" value="<?php echo $row_res["m_regis_id"]; ?>" disabled>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputFirstName">Name</label>
                                    <input type="text" name="inputName" class="form-control" id="inputName" placeholder="Enter Name" value="<?php echo $row_res["m_name"]; ?>">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmailAddress">Email Address</label>
                                    <input type="email" name="inputEmailAddress" class="form-control" id="inputEmailAddress" placeholder="Enter Email Address" value="<?php echo $row_res["email"]; ?>">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputPhone">Phone No.</label>
                                    <input type="text" name="inputPhone" class="form-control" id="inputPhone" placeholder="Enter Email Address" value="<?php echo $row_res["phone"]; ?>" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputDOB">Date Of Birth</label>
                                    <input type="date" name="inputDOB" class="form-control" id="inputDOB" placeholder="Enter Email Address" value="<?php echo $row_res["m_dob"]; ?>" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 mt-3">
                        <button type="submit" class="btn btn-primary btn-block" name="savebtn">Save</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <form name="resetform" method="POST" action="<?php echo htmlspecialchars($_SERVER["REQUEST_URI"]); ?>" autocomplete="off">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="inputOldPassword">Old Password</label>
                                <input type="password" name="inputOldPassword" class="form-control" id="inputOldPassword" placeholder="Enter Old Password">
                            </div>
                            <div class="form-group">
                                <label for="inputNewPassword">New Password</label>
                                <input type="password" name="inputNewPassword" class="form-control" id="inputNewPassword" placeholder="Enter New Password">
                                <!-- <small class="form-text text-muted" id="passwordHelp">Use 8 or more characters with a mix of letters, numbers & symbols</small> -->
                            </div>
                            <div class="form-group">
                                <label for="inputConfirmPassword">Confirm New Password</label>
                                <input type="password" name="inputConfirmPassword" class="form-control" id="inputConfirmPassword" placeholder="Enter Confirm New Password">
                            </div>
                        </div>
                    </div>
                    <div class="md-3 mt-3">
                        <button type="submit" class="btn btn-primary btn-block" name="resetbtn">Reset Password</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- End Page Content -->
    </div>
    <?php include JS_PATH; ?>
</body>

</html>
<?php
// Edit Profile
if (isset($_POST["savebtn"])) {
    if (count($errors) == 0) {
        $stmt = $conn->prepare("UPDATE user_master SET m_name = ?, email = ?, phone = ?, m_dob = ? WHERE m_id = ? ");
        $stmt->bind_param("ssssi", $name, $email, $phone, $m_dob,  $id);

        if ($stmt->execute()) {
            $_SESSION['sess_adminemail'] = $email;
            echo '<script>
            Swal.fire({ title: "Great!", text: "Update Successfully!", type: "success" }).then((result) => {
                if (result.value) { 
                    var cl = window.location.href
                    window.location.href = cl 
                }
            });
            </script>';
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }
        $stmt->close();
    }
}

?>