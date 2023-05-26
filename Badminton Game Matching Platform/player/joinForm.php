<?php
include "connection.php";
// get the POST records
session_start();
	$email = $_SESSION['email'];
	$gname = $_POST['gname'];  	
	$max = $_POST['max'];
	$current = $_POST['current'];
	$venue = $_POST['venue'];
	$googleMapLink = $_POST['googleMapLink'];
	$date = $_POST['date'];
	$time = $_POST['time'];

if($current+1 <= $max){

// database insert SQL code
$sql = "UPDATE game SET current = ('$current'+1) WHERE gname = '$gname'";
$sql2 = "INSERT INTO schedule (email, gname, max,current,venue, googleMapLink, date, time) VALUES ('$email', '$gname', '$max', '$current', '$venue', '$googleMapLink', '$date', '$time')";
// insert in database 
$results = mysqli_query($con, $sql);
$results2 = mysqli_query($con, $sql2);

if($results && $results2)
{    
	echo "Successfully recorded!<br>";
	echo "You joined $gname .<br>";
	echo "<a href='pdash.php'>Back To Dashboard";
}
 }else{
 	echo "$gname already have enough number of players.<br>";
	 echo "Please join other game.<br>";
 	echo "<a href='pdash.php'>Back To Dashboard";
 }

?><!-- ni nanti semak balik. stop kat sini haritu -->                