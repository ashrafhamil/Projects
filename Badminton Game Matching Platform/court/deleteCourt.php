<?php
session_start();
if (!isset($_SESSION['cemail'], $_SESSION['cpass'])) {
  echo "You are not logged in!";
} else {
  include "connection.php";
  $cname = $_POST['cname'];
  
  // Delete the court from the database
  $sql = "DELETE FROM ccourt WHERE cname = '$cname'";
  if ($con->query($sql) === TRUE) {
    // Court deleted successfully
    echo "Court deleted successfully.";
  } else {
    // Error occurred while deleting the court
    echo "Error: " . $con->error;
  }
  
  $con->close();
}
?>
