<?php
include "connection.php";
$con = mysqli_connect('localhost', 'root', '','tempatmain');
$cusername = $_POST['cusername'];
$cfname = $_POST['cfname'];
$clname = $_POST['clname'];
$cemail = $_POST['cemail'];
$cadd = $_POST['cadd'];
$cphone = $_POST['cphone'];
$cpass = $_POST['cpass'];

// database insert SQL code
$sql = "INSERT INTO `courtowner` (`cusername`,`cfname`,`clname`,`cemail`,`cadd`,`cphone`,`cpass`) VALUES ('$cusername','$cfname','$clname','$cemail','$cadd','$cphone','$cpass')";
// insert in database 
$rs = mysqli_query($con, $sql);
if($rs)
{
	echo "New Court Owner Registration Completed. Please proceed to Login.";
}

?>