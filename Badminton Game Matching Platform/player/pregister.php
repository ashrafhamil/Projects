<?php
include "connection.php";
// get the post records
$playerUserName = $_POST['playerUserName'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$add1 = $_POST['add1'];
$add2 = $_POST['add2'];
$zip = $_POST['zip'];
$city = $_POST['city'];
$state = $_POST['state'];
$pass = $_POST['pass'];

// database insert SQL code
$sql = "INSERT INTO `player` (`playerUserName`,`fname`,`lname`,`email`,`phone`,`add1`,`add2`,`zip`,`city`,`state`,`pass`) VALUES ('$playerUserName','$fname','$lname','$email','$phone','$add1','$add2','$zip','$city','$state','$pass')";
// insert in database 
$rs = mysqli_query($con, $sql);

if($rs)
{
	echo "Contact Records Inserted<br>";
	echo "<a href='plogin.html'>Click to Login";
}

?>