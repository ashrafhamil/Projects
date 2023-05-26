<?php
session_start();
include "connection.php";
if(!isset($_SESSION['cemail'], $_SESSION['cpass'])){
    echo "You are not logged in!";
  }else{  
  $cfname = $_POST['cfname'];
  $clname = $_POST['clname'];
  $cadd = $_POST['cadd'];
  $cphone = $_POST['cphone'];  

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
