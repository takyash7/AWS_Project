<?php

include 'connect.php';
include 'head2.php';


session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $entered_otp = $_POST['otp'];
    $saved_otp = $_SESSION['otp'];

    if ($entered_otp == $saved_otp) {
        // OTP is correct, redirect to reset password page
        header('Location: reset_password.php');
        exit;
    } else {
        $error = "Invalid OTP. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Verify OTP</title>
</head>
<body style="background-color:antiquewhite;">
    <form method="POST" action="">
    <div style="margin-top: 18vh;  margin-left: 40vw ">
        <label for="otp"> <h3>Enter OTP:</h3></label>
        <input type="text" name="otp" required>
        </div>
        <div style="margin-top: 2vh;  margin-left: 47vw ">
        <button type="submit"><h4>Verify OTP</h4></button>
       </div>
    </form>
    <?php if (isset($error)) echo "<p>$error</p>";
   
    ?>

</body>
<?php
include 'footer.php';

?>

</html>
