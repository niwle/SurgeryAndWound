<?php
require_once('../config/autoload.php');
require_once('./includes/session.inc.php');
require_once('./includes/path.inc.php');


$errors = array();

if (isset($_POST["savebtn"])) {
    $name       = escape_input($_POST['inputName']);
    $email      = escape_input($_POST['inputEmailAddress']);

    $newpass = $conn->real_escape_string($_POST['inputNewPassword']);
    $conpass = $conn->real_escape_string($_POST['inputConfirmPassword']);

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

    if (empty($newpass)) {
		array_push($errors, "Password is required");
	} 
    if (empty($conpass)) {
		array_push($errors, "Confirm Password is required");
	} 
    if (!empty($newpass)) {
        password_validation($newpass);
    } 
    if ($newpass != $conpass) {
        array_push($errors, "Password Did Not Match");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include CSS_PATH; ?>
</head>

<body>
    <?php include NAVIGATION; ?>
    <div class="page-content" id="content">
        <?php include HEADER; ?>
        <!-- Page content -->
        <div class="row">
            <div class="col-12">
                <form name="regform" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" autocomplete="off">
                    <?php echo display_error(); ?>
                    <div class="card">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputFirstName">Name</label>
                                    <input type="text" name="inputName" class="form-control" id="inputName" placeholder="Enter Name">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmailAddress">Email Address</label>
                                    <input type="email" name="inputEmailAddress" class="form-control" id="inputEmailAddress" placeholder="Enter Email Address">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputNewPassword">New Password</label>
                                    <input type="password" name="inputNewPassword" class="form-control" id="inputNewPassword" placeholder="Enter New Password">
                                    <!-- <small class="form-text text-muted" id="passwordHelp">Use 8 or more characters with a mix of letters, numbers & symbols</small> -->
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputConfirmPassword">Confirm New Password</label>
                                    <input type="password" name="inputConfirmPassword" class="form-control" id="inputConfirmPassword" placeholder="Enter Confirm New Password">
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

        <!-- End Page Content -->
    </div>
    <?php include JS_PATH; ?>
</body>

</html>
<?php
// Edit Profile
if (isset($_POST["savebtn"])) {
    if (count($errors) == 0) {
        
        // $token = generateCode(22);
        // $en_pass = encrypt(md5($newpass), $token);

        // $en_pass = base64_encode($newpass);
        $en_pass = password_hash($newpass, PASSWORD_BCRYPT);

        $m_type = "A";

        $stmt = $conn->prepare("INSERT INTO user_master (m_name, m_type, email, password, created_at, updated_at) VALUES (?,?,?,?,?,?) ");
        $stmt->bind_param("ssssss", $name,$m_type, $email, $en_pass, $created_at, $created_at);

        if ($stmt->execute()) {
            echo '<script>
            Swal.fire({ title: "Great!", text: "Record Added!", type: "success" }).then((result) => {
                if (result.value) { window.location.href = "index.php"; }
            });
            </script>';
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }
        $stmt->close();
    }
}
?>