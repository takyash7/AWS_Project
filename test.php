<?php


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

    // Send OTP to the user's email address
    $subject = "Your OTP Code";
    $message = "Your OTP Code is: $otp";
    $headers = "From: your-email@example.com"; // Replace with your email

    if (mail($email, $subject, $message, $headers)) {
        // Redirect to OTP verification page
        header('Location: verify_otp.php');
        exit;
    } else {
        echo "Failed to send OTP. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
</head>
<body style="background-color:antiquewhite;" > 
    <form  style="margin-top: 22vh ; margin-left: 20vw ; "  method="POST" action="">
        <label  style="margin-left: 18vw;"   for="email"><h3>Enter your email address :</h3></label>
        <div  style="margin-left: 18vw;" >
        <input   type="email" name="email" required>
        <button  type="submit">Send OTP</button>

        </div>
      
    </form>
</body>
<?php include 'footer.php';
?> 

</html>
