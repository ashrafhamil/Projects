<?php
session_start();
include "connection.php";

if(isset($_POST['fname'], $_POST['phone'], $_POST['city'])) {
  $fname = $_POST['fname'];
  $phone = $_POST['phone'];
  $city = $_POST['city'];
  $email = $_SESSION['email'];

  $sql = "UPDATE player SET fname='$fname', phone='$phone', city='$city' WHERE email='$email'";
  if($con->query($sql) === TRUE) {
    // Update successful, redirect back to profile page
    header("Location: pprofile.php");
    exit();
  } else {
    echo "Error updating record: " . $con->error;
  }
}

$con->close();
?>
