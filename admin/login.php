<?php
include('../config/autoload.php');
include('includes/path.inc.php');
?>
<!DOCTYPE html>
<html>

<head>
    <?php include CSS_PATH; ?>
</head>

<body>
    <?php include "../script/loginTemplate.php" ?>
</body>

</html>
<?php
if (isset($_POST['loginbtn'])) {
    $inputEmail = $conn->real_escape_string($_POST['email']);

    $check = $conn->prepare("SELECT * FROM user_master WHERE email = ? and m_type = 'a'");
    $check->bind_param("s", $inputEmail);
    $check->execute();
    $q = $check->get_result();
    $r = $q->fetch_assoc();
    if (mysqli_num_rows($q) != 1) {
        echo "<script>Swal.fire({title: 'Error!', text: 'Email Does Not exists', type: 'error'}).then(function() { $('#inputEmail').focus(); });</script>";
        exit();
    }else{
        $dbHashpassword = $r["password"];
    } 

    // $inputPassword = $conn->real_escape_string(base64_encode($_POST['password']));
    $inputPassword = $conn->real_escape_string(($_POST['password']));

    if(passwordValidator($inputPassword, $dbHashpassword)){
      
        $_SESSION['sess_adminid'] = $r['m_id'];
        $_SESSION['sess_adminemail'] = $r['email'];
        $_SESSION['admin_loggedin'] = 1;
        echo "<script>window.location.href = 'index.php'</script>";

    }else{
        echo "<script>Swal.fire({title: 'Error!', text: 'Email & Password Not Exist', type: 'error', confirmButtonText: 'Try Again'})</script>";
        exit();
    }

    if ($inputEmail == "" && empty($inputEmail)) {
        echo "<script>Swal.fire({title: 'Error!', text: 'Please Enter a Email', type: 'error'}).then(function() { $('#inputEmail').focus(); });</script>";
        exit();
    }

    if ($inputPassword == "" && empty($inputPassword)) {
        echo "<script>Swal.fire({title: 'Error!', text: 'Please Enter a Password', type: 'error'}).then(function() { $('#inputPassword').focus(); });</script>";
        exit();
    }

    // if ($result->num_rows != 1) {
    //     echo "<script>Swal.fire({title: 'Error!', text: 'Email & Password Not Exist', type: 'error', confirmButtonText: 'Try Again'})</script>";
    //     exit();
    // } else {
    //     $_SESSION['sess_adminid'] = $row['m_id'];
    //     $_SESSION['sess_adminemail'] = $row['email'];
    //     $_SESSION['admin_loggedin'] = 1;
    //     echo "<script>window.location.href = 'index.php'</script>";
    // }
    $stmt->close();
}
?>