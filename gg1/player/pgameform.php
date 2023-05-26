<?php
session_start();
if(!isset($_SESSION['email'], $_SESSION['pass'])){
  echo "You are not logged in!";  
}else{
include "connection.php";
// Get the post records
$email = $_SESSION['email'];
$gname = $_POST['gname'];
$min = $_POST['min'];
$max = $_POST['max'];
$current = $_POST['current'];
$venue = $_POST['venue'];
$date = $_POST['date'];
$time = $_POST['time'];
$desc = $_POST['desc'];

$sql2 = "SELECT playerUserName FROM player WHERE email='$email' ";    
$result2 = $con->query($sql2);    
while ($row2 = $result2->fetch_assoc()) {$playerUserName = $row2['playerUserName'];}
// Retrieve the googleMapLink based on gname
$sqlGoogleMapLink = "SELECT cGoogleMapLink FROM ccourt WHERE cname = '$venue'";
$resultGoogleMapLink = mysqli_query($con, $sqlGoogleMapLink);
$rowGoogleMapLink = mysqli_fetch_assoc($resultGoogleMapLink);
$googleMapLink = $rowGoogleMapLink['cGoogleMapLink'];

// Database insert SQL code
$sql = "INSERT INTO `game` (`gname`,`organiserName`,`min`,`max`,`current`,`venue`,`googleMapLink`,`date`,`time`,`desc`) VALUES ('$gname','$playerUserName','$min','$max','$current','$venue','$googleMapLink','$date','$time','$desc')";

// Insert into database
$rs = mysqli_query($con, $sql);

if ($rs) {
    echo "$gname successfully set.<br>";
    echo "<a href='pdash.php'>Back to Dashboard</a>";
}
}

?>
