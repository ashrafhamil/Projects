<?php      
session_start();
if(!isset($_SESSION['email'], $_SESSION['pass'])){
  echo "You are not logged in!";
}
  else{
    $email = $_SESSION['email'];
    include "connection.php";
    $sql = "SELECT * FROM ccourt";    
    $result = $con->query($sql);	
    $sql2 = "SELECT playerUserName FROM player WHERE email='$email' ";
    $result2 = $con->query($sql2);    
    $con->close();    
?>  

<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="icon" href="z_shuttlecock.ico">
  <title>Player - Game</title>
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
        <li class="active"><a href="pgame.php">Set Game</a></li>
        <li><a href="pcourt.php">Book Court</a></li>  
        <li><a href="pBookHistory.php">Booking History</a></li>      
		<li><a href="pschedule.php">Game Schedule</a></li>        
        <li><a href="pprofile.php">Profile</a></li>
        <li><a href="logout.php">Logout</a></li>                  
      </ul><br>
    </div>
    <br>    
    <div class="col-sm-9">
  <div class="well">
    <h4>Set Game</h4>
    <form name="setgame" method="post" action="pgameform.php">      
      <div class="form-group">
        <label for="gname">Game Name:</label>
        <input type="text" class="form-control" id="gname" name="gname">
      </div>
      <div class="form-group">
        <label for="min">Minimum Number of Players:</label>
        <input type="number" class="form-control" id="min" name="min">
      </div>      
      <div class="form-group">
        <label for="max">Maximum Number of Players:</label>
        <input type="number" class="form-control" id="max" name="max">
      </div>
      <div class="form-group">
        <label for="current">Current Number of Players(excluding you):</label>
        <input type="number" class="form-control" id="current" name="current">
      </div>            
      <div class="form-group">
        <label for="venue">Venue:</label>
        <select class="form-control" name="venue" id="venue">
          <?php while($row1 = mysqli_fetch_array($result)):;?>
          <option><?php echo $row1[0];?></option>
          <?php endwhile;?>		  
        </select>
      </div>
      <div class="form-group">
        <label for="date">Date:</label>
        <input type="date" class="form-control" id="date" name="date">
      </div>
      <div class="form-group">
        <label for="time">Time:</label>
        <input type="time" class="form-control" id="time" name="time">
      </div>
      <div class="form-group">
        <label for="desc">Description:</label>
        <input type="text" class="form-control" id="desc" name="desc">
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>  
    </form>                 
  </div>      
</div>

  </div>
</div>

</body>
</html>
<?php } ?> 

