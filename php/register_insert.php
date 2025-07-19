<! Script to add newly registered people in to the Database -->

<style >  .table{  font-family: Montserrat, sans-serif;
align-items: center}

</style>
<link rel="stylesheet" type="text/css" href="./index.css">


<?php

require '../PHPMailer/Exception.php';
require '../PHPMailer/SMTP.php';
require '../PHPMailer/PHPMailer.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTPS;
use PHPMailer\PHPMailer\Exception;

include 'connect.php';
include 'head2.php';

$name = $_POST['name'];
$email = $_POST['email'];
$dob  = $_POST['dob']; 
$password = $_POST['password'];
$Gender = $_POST['Gender'];
$Phone = $_POST['phone'];

$sql_userdatabase="Insert into userdatabase(Name ,Email , Gender, password , dob , Phone) values ('$name' , '$email' , '$Gender', '$password', '$dob', '$Phone')";

if(mysqli_query($connect, $sql_userdatabase) == true)
{
	echo "<center><h1><b>You have been sucessfully registered<b> </h1></center><br><br>";
	echo '<center><table><tr><td><A href="sindex.php"><button style="background-color:black; border-color:black"><span style="color:white">Sign in ! </span></button></a></td></tr></table></center>';


	$mail = new PHPMailer;
	$mail->SMTPDebug = 0;                               // Enable verbose debug output
	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = '2022pietcryash059@poornima.org';                 // SMTP username
	$mail->Password = 'Yashtak@69';                           // SMTP password
	$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;                            // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 465;                                    // TCP port to connect to
	$mail->setFrom('2022pietcryash059@poornima.org', 'M-Ticket (AWS)');
    $mail->addAddress($_POST['email'],$_POST['name']);
    $mail->Subject = 'Comformation Mail';
	$mail->Body    = 'Welcome To M-Ticket';
	if(!$mail->send()) {
		echo 'Message could not be sent.';
		echo 'Mailer Error: ' . $mail->ErrorInfo;
	} else {
		echo "<center><h3><b>The comformation mail have benn sent to your mail<b> </h3></center><br><br>";
	}
}
else
{
	echo "<center><h1><b>Registration Unsucessful , try again with different credentials<b> </h1></center><br><br>";
    echo '<center><table><tr><td><A href="register.php"><button style="background-color:black; border-color:black"><span style="color:white">Register&nbsp&nbspAgain</span></button></a></td></tr></table></center>';
}

?>
