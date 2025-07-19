<?php

require '../PHPMailer/Exception.php';
require '../PHPMailer/SMTP.php';
require '../PHPMailer/PHPMailer.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTPS;
use PHPMailer\PHPMailer\Exception;


include 'connect.php';
include 'head2.php';

session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    // Generate a random 6-digit OTP
    $otp = rand(100000, 999999);

    // Save OTP and email in session for verification
    $_SESSION['otp'] = $otp;
    $_SESSION['email'] = $email;

    // Create an instance of PHPMailer
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail = new PHPMailer;
        $mail->SMTPDebug = 0;                               // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = '';                 // SMTP username
        $mail->Password = '';                           // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 465;                                    // TCP port to connect to
        $mail->setFrom('', 'M-Ticket (AWS)');
        $mail->addAddress($email);                // Add a recipient

        // Content
        $mail->isHTML(true);                      // Set email format to HTML
        $mail->Subject = 'Your OTP Code';
        $mail->Body    = 'Your OTP Code is: ' . $otp;

        $mail->send();
        // Redirect to OTP verification page
        header('Location: verify_otp.php');
        exit;
    } catch (Exception $e) {
        echo "Failed to send OTP. Please try again.";
        echo "Mailer Error: {$mail->ErrorInfo}";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
</head>
<body style="background-color:antiquewhite;">
    <form style="margin-top: 18vh; margin-left: 20vw;" method="POST" action="">
        <label style="margin-left: 20vw;" for="email"><h3>Enter your email address </h3></label>
        <div style="margin-left: 22vw; padding-left: 1vw ">
            <input type="email" name="email" required>
            </div>
            <div style="margin-left: 26vw; margin-top: 2vh">
            <button type="submit">Send OTP</button>
            </div>
    </form>
</body>
<?php include 'footer.php'; ?>
</html>
