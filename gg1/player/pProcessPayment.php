<?php
session_start();
if(!isset($_SESSION['email'], $_SESSION['pass'])){
  echo "You are not logged in!";
}else{    
    include "connection.php";     
$email = $_POST['email'];
$cname = $_POST['cname'];
$cavail = $_POST['cavail'];
$cprice = $_POST['cprice'];
$bDate = $_POST['bDate'];
$bTimeSlot = $_POST['bTimeSlot'];

// Insert the booking into the database
$sql = "UPDATE ccourt SET cavail = ('$cavail'-1) WHERE cname = '$cname'";
$sql2 = "INSERT INTO book (bBooker, bCourtName, bDate, bTimeSlot) VALUES ('$email', '$cname', '$bDate', '$bTimeSlot')";
$result = mysqli_query($con, $sql);
$result2 = mysqli_query($con, $sql2);

// If the booking was successful, display a receipt
if($result && $result2)
{       
	echo "You booked $cname .<br>";
    echo "Here is your receipt!<br>";
	echo "<a href='pcourt.php'>Back to Book Court Page";
}
}
?>
