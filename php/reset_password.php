<?php

include 'head2.php';

session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_password = $_POST['password'];
    $email = $_POST['email'];

    // Connect to the database
    $conn = new mysqli('localhost', 'root', '', 'train');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Update the password in the database
    $stmt = $conn->prepare("UPDATE userdatabase SET password = ? WHERE Email = ?");
    if ($stmt === false) {
        die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
    }
    $stmt->bind_param("ss", $new_password, $email);

    if ($stmt->execute()) {
       
     echo "<h2>Password updated successfully</h2>";
    
    header("location:book.php");
    
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
    session_destroy();
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
</head>
<body style="background-color:antiquewhite;">
    <form  method="POST" action="">
        <div style="margin-top: 15vh;  margin-left: 38vw ">
           <label for="email">Enter your E-mail id</label>
           <input style="margin-top: 5vh " type="email" name="email" required>
           </div>
           <div style="margin-top: 2vh; margin-left: 38vw">
           <label for="password">Enter new password</label>
           <input type="password"  name="password" required>
           </div>
           <div style="margin-top: 2vh; margin-left: 45vw">
           <button type="submit">Reset Password</button>
        </div>
    </form>
</body>
<?php
include 'footer.php';
?>
</html>
