<?php

use PHPMailer\PHPMailer\PHPMailer;

$url = "http://$_SERVER[HTTP_HOST]";
$dir = dirname("$_SERVER[PHP_SELF]");
date_default_timezone_set('Asia/Kuala_Lumpur');

if (isset($_POST['email-reset'])) {
  require 'database.php';
  $data['Valid'] = true;
  $email = mysqli_real_escape_string($conn, $_POST['email-reset']);

  $sql = $conn->query("SELECT m_id FROM user_master WHERE email = '$email'");
  // Check if th email actually registered
  if ($sql->num_rows > 0) {
    $user_id = ($sql->fetch_assoc());
    $user_id = $user_id['m_id'];
    $bytes = 20;
    // This will generate a random token with the length bytes * 2
    $token = bin2hex(openssl_random_pseudo_bytes($bytes));
    // Set the token in the database and add expire time to 7 mins
    $bsql = "UPDATE user_master SET token ='$token', tokenExpire=DATE_ADD(NOW(), INTERVAL 7 MINUTE ) WHERE m_id='$user_id'";

    $data['temp'] = true;
    $data['temp2'] = $bsql;
    // Email preparations 
    $expire = date("Y-m-d H:i:s", strtotime("now +7 minutes"));
    require_once "phpmailer/PHPMailer.php";
    require_once "phpmailer/Exception.php";
    require_once "phpmailer/SMTP.php";
    //Get the path to the recovery page
    $path = "$url" . $dir . "/password_recovery.php?email=$email&token=$token";
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'ssl';
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 465;
    $mail->Username = "raisereason@gmail.com";
    $mail->Password = "otenxrmrlprpphsv";
    $mail->addAddress($email);
    $mail->setFrom('surgerymonitoring@gmail.com');
    $mail->Subject = "Reset Password";
    $mail->isHTML(true);
    $body = $mail->Body =
      "
       <p>Hello, </p><br />
        <div>
        <p>Please Click </p>
             <div style='align-items: center;'>

            <button style='text-decoration: none; background-color: #0062cc; border: solid 1px #C89CE3;' >
            <strong
              ><a href=$path style='text-decoration: none; color: #fff;' target='_Blank'
                >Reset Password</a
              >
            </strong>
          </button>
        </div>
        <br />
        PLEASE NOTE THIS TOKEN WILL EXPIRE ON <strong>$expire</strong>
        <br />
        <br />
        </div>
        <footer>
        Best Regards <br>
        Care Team.
        </footer>
       
       ";
    // Get the result if the mail was sent 
    $data['sent'] = $mail->send();
    if ($data['sent']) {
      $conn->query($bsql);
    }
  } else {
    // Email not registered
    $data['exists'] = false;
  }
} else {
  $data['Valid'] = false;
}


$conn->close();
echo json_encode($data);
