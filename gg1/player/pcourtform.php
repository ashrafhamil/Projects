<?php
session_start();
if(!isset($_SESSION['email'], $_SESSION['pass'])){
  echo "You are not logged in!";
}else{    
    include "connection.php";    
// Get the form data
$email = $_SESSION['email'];
$cname = $_POST['cname'];
$cavail = $_POST['cavail'];
$cprice = $_POST['cprice'];
$bDate = $_POST['bDate'];
$bTimeSlot = $_POST['bTimeSlot'];

if($cavail > 0){
// Check if the selected time slot already exists in the database
$query = "SELECT COUNT(*) AS count FROM book WHERE bCourtName = '$cname' AND bDate = '$bDate' AND bTimeSlot = '$bTimeSlot'";
$resultCount = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($resultCount);
$count = $row['count'];

// If the selected time slot already exists in the database, display an error message
if ($count > 0) {
	echo 'The selected time slot is already booked. Please select another time slot.';
	echo "<a href='pcourt.php'>Back to Book Court Page";
}else{			  
?>

<html>
  <head>
    <title>Payment Gateway</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">	
  </head>
  <body>
    <div class="container-sm mt-4">
      <h1 class="text-center">Payment Gateway</h1>
      <form action="pProcessPayment.php" method="POST" onsubmit="alert('Payment has been processed successfully!')">		
        <div class="form-group">
          <label for="card-number">Card Number:</label>
          <input type="text" class="form-control" id="card-number" name="card-number" >
        </div>
        <div class="form-group">
          <label for="exp-date">Expiration Date:</label>
          <input type="text" class="form-control" id="exp-date" name="exp-date" >
        </div>
        <div class="form-group">
          <label for="cvv">CVV:</label>
          <input type="text" class="form-control" id="cvv" name="cvv" >
        </div>
        <div class="form-group">
          <label for="name-on-card">Name on Card:</label>
          <input type="text" class="form-control" id="name-on-card" name="name-on-card" >
        </div>
        <div class="form-group">
          <label for="billing-address">Billing Address:</label>
          <input type="text" class="form-control" id="billing-address" name="billing-address" >
        </div>
        <div class="form-group">
          <label for="amount">Amount:</label>
          <input type="text" class="form-control" id="amount" name="amount" >
        </div>
		<input type="hidden" name="email" value="<?php echo $_SESSION['email']; ?>">
		<input type="hidden" name="cname" value="<?php echo $_POST['cname']; ?>">
		<input type="hidden" name="cavail" value="<?php echo $_POST['cavail']; ?>">
		<input type="hidden" name="cprice" value="<?php echo $_POST['cprice']; ?>">
		<input type="hidden" name="bDate" value="<?php echo $_POST['bDate']; ?>">
		<input type="hidden" name="bTimeSlot" value="<?php echo $_POST['bTimeSlot']; ?>">
        <button type="submit" class="btn btn-primary">Pay</button>
      </form>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  </body>
</html>


<?php } ?>
<?php 
}else{
 	echo "$cname is fully booked at that time.<br>";
	 echo "Please choose another time or date.<br>";
 	echo "<a href='pcourt.php'>Back to Book Court Page";
 }
 
}

?>
