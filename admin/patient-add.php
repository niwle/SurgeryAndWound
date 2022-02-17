<?php
require_once('../config/autoload.php');
include('includes/path.inc.php');
include('includes/session.inc.php');
include(SELECT_HELPER);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include CSS_PATH; ?>
    <style>
        .imageupload .btn-file {
            overflow: hidden;
            position: relative;
        }

        .imageupload .btn-file input[type="file"] {
            cursor: inherit;
            display: block;
            font-size: 100px;
            min-height: 100%;
            min-width: 100%;
            opacity: 0;
            position: absolute;
            right: 0;
            text-align: right;
            top: 0;
        }

        /* .imageupload .file-tab button {
            display: none;
        } */

        .imageupload .thumbnail {
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <?php include NAVIGATION; ?>
    <div class="page-content" id="content">
        <?php include HEADER; ?>
        <!-- Page content -->
        <div class="row">
            <div class="col-12">
                <!-- <div class="d-flex mb-3">
                    <h5 class="card-title mr-auto">Add Patient</h5>
                </div> -->
                <!-- Card Content -->
                <form name="regform" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                    <div class="d-flex">
                        <div class="card col-md-9">
                            <div class="card-body">
                                <div class="card-inner">
                                    <!-- Add Patient -->
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="inputFirstName">Name*</label>
                                            <input type="text" name="inputFirstName" class="form-control" id="inputFirstName" placeholder="Enter Name" required>
                                        </div>
                                        <!-- <div class="form-group col-md-6">
                                            <label for="inputLastName">Last Name</label>
                                            <input type="text" name="inputLastName" class="form-control" id="inputLastName" placeholder="Enter Last Name">
                                        </div> -->
                                    </div>

                                    <div class="form-group">
                                        <label for="inputIC">Identity Card Number/ Passport No* </label>
                                        <span class="text-muted">Example IC: 111111111111</span> 
                                        <input type="text" name="inputIC" class="form-control" id="inputIC" placeholder="Enter Identity Card Number/ Passport No" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputRegisID">Registration No.*</label>
                                        <input type="text" name="inputRegisID" class="form-control" id="inputRegisID" placeholder="Enter Registration No." required>
                                    </div>
                                    <!-- <div class="form-group">
                                        <label for="inputNationality">Nationality</label>
                                        <select name="inputNationality" id="inputNationality" class="form-control selectpicker" data-live-search="true">
                                            <option value="">Choose</option>
                                            <?php
                                            // foreach ($select_nationality as $nationality_value) {
                                            //     echo '<option value="' . $nationality_value . '">' . $nationality_value . '</option>';
                                            // }
                                            ?>
                                        </select>
                                    </div> -->
                                    <!-- End Add Patient -->
                                </div>
                            </div>
                        </div>
                        <!-- <div class="card col-md-3">
                            <div class="card-body">
                                <div class="imageupload">
                                    <img src="../assets/img/empty/empty-avatar.jpg" id="output" class="img-fluid thumbnail" alt="Patient-Avatar" title="Patient-Avatar">
                                    <div class="file-tab">
                                        <label class="btn btn-sm btn-primary btn-block btn-file">
                                            <span>Browse</span>
                                            <input type="file" name="inputAvatar" id="inputAvatar" accept="image/*" onchange="openFile(event)">
                                        </label>
                                    </div>
                                </div>
                                <script>
                                    var openFile = function(file) {
                                        var input = file.target;

                                        var reader = new FileReader();
                                        reader.onload = function() {
                                            var dataURL = reader.result;
                                            var output = document.getElementById('output');
                                            output.src = dataURL;
                                        };
                                        reader.readAsDataURL(input.files[0]);
                                    };
                                </script>
                            </div>
                        </div> -->
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputGender">Gender*</label>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="inputGenderMale" name="inputGender" class="custom-control-input" value="male" required>
                                                <label class="custom-control-label" for="inputGenderMale">Male</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="inputGenderFemale" name="inputGender" class="custom-control-input" value="female">
                                                <label class="custom-control-label" for="inputGenderFemale">Female</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- <div class="form-group col-md-6">
                                    <label for="inputMaritalStatus">Marital Status</label>
                                    <select name="inputMaritalStatus" id="inputMaritalStatus" class="form-control">
                                        <option value="">Choose</option>
                                        <?php foreach ($select_maritalstatus as $maritalstatus_value) {
                                            echo '<option value="' . $maritalstatus_value . '">' . $maritalstatus_value . '</option>';
                                        } ?>
                                    </select>
                                </div>
                            </div> -->
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputDOB">Date of Birth*</label>
                                        <input type="text" name="inputDOB" class="form-control" id="datepicker" placeholder="Enter DOB" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputAge">Age</label>
                                        <input type="text" name="inputAge" class="form-control" id="inputAge" placeholder="Enter Age">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputContactNumber">Contact Number*</label>
                                        <input type="text" name="inputContactNumber" class="form-control" id="inputContactNumber" placeholder="Enter Phone Number" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputEmailAddress">Email Address*</label>
                                        <input type="email" name="inputEmailAddress" class="form-control" id="inputEmailAddress" placeholder="Enter Email Address" required>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">
                                    <h3 class="card-title">Optional</h3>
                                </div>
                                <hr>
                                <div class="card-inner">
                                    <!-- Add Patient -->
                                    <div class="form-group">
                                        <label for="inputAddress">Address</label>
                                        <input type="text" name="inputAddress" class="form-control" id="inputAddress" placeholder="1234 Main St">
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputCity">City</label>
                                            <input type="text" name="inputCity" class="form-control" id="inputCity">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="inputState">State</label>
                                            <select name="inputState" id="inputState" class="form-control selectpicker" data-live-search="true">
                                                <option value="">Choose</option>
                                                <?php foreach ($select_state as $state_value) {
                                                    echo '<option value="' . $state_value . '">' . $state_value . '</option>';
                                                } ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="inputZipCode">Zip Code</label>
                                            <input type="text" name="inputZipCode" class="form-control" id="inputZipCode">
                                        </div>
                                    </div>
                                    <!-- End Add Patient -->
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 mt-3">
                            <button type="submit" class="btn btn-primary btn-block" name="savebtn">Add Patient</button>
                        </div>
                </form>
                <!-- End Card Content -->
            </div>
        </div>
        <!-- End Page Content -->
    </div>

    <?php include JS_PATH; ?>
    <script>
        // $('#datepicker').on('changeDate', function() {
        //     var date = $(this).datepicker('getDate'),
        //         year = date.getFullYear(),
        //         current_year = new Date().getFullYear(),
        //         totalyear = current_year - year;
        //     $('#inputAge').val(totalyear);
        //     console.log("hi");
        // });

        $("#datepicker").on("dp.change", function(e) {
            var date = new Date($(this).val());
            var year = date.getFullYear();
            var current_year = new Date().getFullYear();
            var totalyear = current_year - year;
            $('#inputAge').val(totalyear);
            // console.log(date);
        });

        $('#inputIC').on('keyup', function() {
            var input = $(this).val(),
                lastnum = input % 10;
            if (lastnum % 2 === 0) {
                $("#inputGenderFemale").prop("checked", true);
            } else {
                $("#inputGenderMale").prop("checked", true);
            }
        });
    </script>

    <?php
    if (isset($_POST['savebtn'])) {

        function RemoveSpecialChar($str)
        {
            $res="";
            $res1 = str_replace(array( '\\', '/',"'", '"', ',', ';', '<', '>' ), '', $str);
            $res = str_replace(' ', '', $res1);
            $str = $res;
            
            return $res;
        }

        $created_at = date('Y-m-d H:i:s');
        $created_at_notime = date('Y_m_d');

        $firstname = $conn->real_escape_string($_POST['inputFirstName']);
        $regis_id = $conn->real_escape_string($_POST['inputRegisID']);
        // $lastname = $conn->real_escape_string($_POST['inputLastName']);

        $ic = $conn->real_escape_string($_POST['inputIC']);
        // $nationality = $conn->real_escape_string($_POST['inputNationality']);
        // $avatars = isset(($_FILES['inputAvatar']['name'])) ? ($_FILES['inputAvatar']['name']) : "";

        if (!empty($_POST['inputGender'])) {
            $gender = $_POST['inputGender'];
        } else {
            $gender = "";
        }
        // $marital_status = $conn->real_escape_string($_POST['inputMaritalStatus']);
        $dob = $conn->real_escape_string($_POST['inputDOB']);
        $age = $conn->real_escape_string($_POST['inputAge']);

        $email = $conn->real_escape_string($_POST['inputEmailAddress']);
        $contact = $conn->real_escape_string($_POST['inputContactNumber']);

        $address = $conn->real_escape_string($_POST['inputAddress']);

        $city = $conn->real_escape_string($_POST['inputCity']);
        $state = $conn->real_escape_string($_POST['inputState']);
        $zipcode = $conn->real_escape_string($_POST['inputZipCode']);


        $passwordGenerate_name = strtolower(substr(RemoveSpecialChar($firstname),0,4));
        $passwordGenerate_identity = strtolower(substr(RemoveSpecialChar($ic),-4));
        $passwordGenerate_regis_id = strtolower(substr(RemoveSpecialChar($regis_id), -4));

        // $passwordcombine = base64_encode($passwordGenerate_name . $passwordGenerate_identity);
        // $passwordcombine = base64_encode($passwordGenerate_name.$passwordGenerate_regis_id);
        $passwordcombine = password_hash(($passwordGenerate_name . $passwordGenerate_regis_id), PASSWORD_BCRYPT);
        

        // Check Email
        $result = mysqli_query($conn, "SELECT * FROM user_master WHERE email = '.$email.'");
        if (mysqli_num_rows($result) != 0) {
            echo '<script>
                Swal.fire({ title: "Oops!", text: "E-mail already exist", type: "error" }).then((result) => {
                    if (result.value) { window.location.href = "patient-add.php"; }
                });
                </script>';
            exit();
        } else if (empty($firstname) && empty($lastname) && empty($ic)) {
            echo '<script>
                Swal.fire({ title: "Oops!", text: "Field Cannot be Empty such as Name, IC", type: "error" }).then((result) => {
                    if (result.value) { window.location.href = "patient-add.php"; }
                });
                </script>';
            exit();
        } else {
            try {
                $sql = 'INSERT INTO user_master 
                        (m_type, m_regis_id, password, m_name, m_identity, m_gender, m_dob, m_age, email, phone, m_address, m_city, m_state, m_zipcode, created_at, updated_at)
                        VALUES ("P","' . $regis_id . '","' . $passwordcombine . '","' . $firstname . '", "' . $ic . '", "' . $gender . '", "' . $dob . '", "' . $age . '", "' . $email . '", "' . $contact . '", "' . $address . '", "' . $city . '", "' . $state . '", "' . $zipcode . '","' . $created_at . '","' . $created_at . '")';


                if (mysqli_query($conn, $sql)) {
                    $last_id = mysqli_insert_id($conn);
                    if (isset($_FILES["inputAvatar"]["name"])) {
                        $allowed =  array('gif', 'png', 'jpg', 'jpeg');
                        $filename = $_FILES['inputAvatar']['name'];
                        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                        if (!in_array($ext, $allowed)) {
                            echo "<script>Swal.fire('Oops...','Only can be image!','error')</script>";
                            exit();
                        } else {
                            if (!empty($_FILES['inputAvatar']['name'])) {
                                $folderpath = "../uploads/avatar/" . $last_id . "/";
                                $path = "../uploads/patient/" .  $last_id . "/" . $_FILES['inputAvatar']['name'];
                                $image = $_FILES['inputAvatar']['name'];

                                if (!file_exists($folderpath)) {
                                    mkdir($folderpath, 0777, true);
                                    move_uploaded_file($_FILES['inputAvatar']['tmp_name'], $path);
                                } else {
                                    move_uploaded_file($_FILES['inputAvatar']['tmp_name'], $path);
                                }
                            } else {
                                echo "<script>Swal.fire('Oops...','You should select a file to upload!','error')</script>";
                                exit();
                            }
                        }
                    }
                    echo '<script>
                    Swal.fire({ title: "Great!", text: "New Record Added!", type: "success" }).then((result) => {
                        if (result.value) { window.location.href = "patient-doctor-list.php?t=' . base64_encode('p') . '"; }
                    });
                    </script>';
                }
            } catch (PDOException $e) {
                echo $sql . "<br>" . $e->getMessage();
            }
            mysqli_close($conn);
        }
    }
    ?>

</body>

</html>