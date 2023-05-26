<?php      
session_start();
if(!isset($_SESSION['cemail'], $_SESSION['cpass'])){
  echo "You are not logged in!";
}else{
include "connection.php";
// get the post records
$cname = $_POST['cname'];
$cloca = $_POST['cloca'];
$cGoogleMapLink = $_POST['cGoogleMapLink'];
$cprice = $_POST['cprice'];
$cPhone = $_POST['cPhone'];
$ctotal = $_POST['ctotal'];
$cavail = $_POST['cavail'];
$copen = $_POST['copen'];
$cclose = $_POST['cclose'];
$cdesc = $_POST['cdesc'];
$cOwnerEmail = $_POST['cemail'];

// database insert SQL code
$sql = "INSERT INTO `ccourt` (`cname`,`cloca`,`cGoogleMapLink`,`cprice`,`cPhone`,`ctotal`,`cavail`,`copen`,`cclose`,`cdesc`, `cOwnerEmail`) VALUES ('$cname','$cloca','$cGoogleMapLink','$cprice','$cPhone','$ctotal','$cavail','$copen','$cclose','$cdesc', '$cOwnerEmail')";
// insert in database 
$rs = mysqli_query($con, $sql);

if($rs)
{
	echo "New Court Registered!</br>";
	echo "<a href='cdash.php'>Back to Dashboard</a>";
}

}
?>