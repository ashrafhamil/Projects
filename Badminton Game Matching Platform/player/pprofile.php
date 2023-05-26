<?php      
session_start();
if(!isset($_SESSION['email'], $_SESSION['pass'])){
  echo "You are not logged in!";
}
  else{    
    include "connection.php";    
    $email = $_SESSION['email'];
    $sql = "SELECT * FROM player WHERE email='$email'";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $fname = $row['fname'];
      $phone = $row['phone'];
      $city = $row['city'];
    }   
    $sql2 = "SELECT playerUserName FROM player WHERE email='$email' ";    
    $result2 = $con->query($sql2);     
    $con->close();    
?>

<!DOCTYPE html>
<html lang="en">
<head>  
  <link rel="icon" href="z_shuttlecock.ico">
  <title>Player - Profile</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 100vh}    
    /* Set gray background color and 100% height */
    .sidenav {
      background-color: #f1f1f1;
      height: 100%;
    }        
    /* On small screens, set height to 'auto' for the grid */
    @media screen and (max-width: 767px) {
      .row.content {height: auto;} 
    }
  </style>
</head>
<body>

<div class="container-fluid">
  <div class="row content">
    <div class="col-sm-3 sidenav hidden-xs">
      <h2>MohMain</h2>
      <?php while ($row2 = $result2->fetch_assoc()) {echo $row2['playerUserName']."<br>";}?>
      <ul class="nav nav-pills nav-stacked">
        <li><a href="pdash.php">Dashboard</a></li>
        <li><a href="pgame.php">Set Game</a></li>
        <li><a href="pcourt.php">Book Court</a></li>    
        <li><a href="pBookHistory.php">Booking History</a></li>    
        <li><a href="pschedule.php">Game Schedule</a></li>        
        <li class="active"><a href="pprofile.php">Profile</a></li> 
        <li><a href="logout.php">Logout</a></li>                 
      </ul><br>
    </div>
    <br>    
    <div class="col-sm-9">
      <div class="well">
        
        <h4>Player Profile</h4>        
        <p>Player Info</p>
        <p>Username : <?php echo $fname; ?></p>
        <p>Email : <?php echo $email; ?></p>
        <p>Phone Number : <?php echo $phone; ?></p>        
        <p>Location : <?php echo $city; ?></p>      
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#editModal">Edit Profile</button><br><br>                       
      </div>      
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div id="editModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Profile</h4>
      </div>
      <div class="modal-body">
        <form action="pprofile_update.php" method="POST">
          <div class="form-group">
            <label for="fname">First Name:</label>
            <input type="text" class="form-control" id="fname" name="fname" value="<?php echo $fname; ?>">
          </div>
          <div class="form-group">
            <label for="phone">Phone Number:</label>
            <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $phone; ?>">
          </div>
          <div class="form-group">
            <label for="city">City:</label>
            <input type="text" class="form-control" id="city" name="city" value="<?php echo $city; ?>">
          </div>
          <button type="submit" class="btn btn-default">Save Changes</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

</body>
</html>

<?php } ?>
