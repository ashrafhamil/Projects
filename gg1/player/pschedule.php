<?php 
session_start();
if(!isset($_SESSION['email'], $_SESSION['pass'])){
  echo "You are not logged in!";  
}else{        
    include "connection.php";
    $email = $_SESSION['email'];
    $sql = "SELECT * FROM schedule WHERE email = '$email'";                
    $result = $con->query($sql);    
    $sql2 = "SELECT playerUserName FROM player WHERE email='$email' ";    
    $result2 = $con->query($sql2);    
    //$con->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="icon" href="z_shuttlecock.ico">
  <title>Player - Schedule</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 550px}
    
    /* Set gray background color and 100% height */
    .sidenav {
      background-color: #f1f1f1;
      height: 100%;
    }
        
    /* On small screens, set height to 'auto' for the grid */
    @media screen and (max-width: 767px) {
      .row.content {height: auto;} 
    }
    .table-hover tbody tr:hover td, 
    .table-hover tbody tr:hover th {
    background-color: #f5f5a1;
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
        <li class="active"><a href="pschedule.php">Game Schedule</a></li>        
        <li><a href="pprofile.php">Profile</a></li>                
        <li><a href="logout.php">Logout</a></li>  
      </ul><br>
    </div>
    <br>    
    <div class="col-sm-9">
      <div class="well">
        
        <h4>Your Game Schedule</h4>                         
        <table class="table table-hover">
          <thead>
            <tr>            
              <th scope="col">Player Email</th>
              <th scope="col">Game Name</th>           
              <th scope="col">Max Player</th>
              <th scope="col">Current Player</th>
              <th scope="col">Venue</th>
              <th scope="col">Date</th>
              <th scope="col">Time</th> 
              <th scope="col">Players Joined</th>
            </tr>
          </thead>              
            <tbody>
              <?php
              $gameNumber = 1; // Add a new variable to keep track of game number
              while ($rows = $result->fetch_assoc()):
                  $playerEmail = $rows['email'];
                  $sql3 = "SELECT playerUserName FROM player WHERE email IN (SELECT email FROM schedule WHERE gname = '{$rows['gname']}')";
                  $result3 = $con->query($sql3);
                  $playerJoined = '';
                  $rowNumber = 1; // Reset the row number for each game

                  while ($playerRow = $result3->fetch_assoc()) {
                      $playerJoined .= $rowNumber . '. ' . $playerRow['playerUserName'] . "<br>";
                      $rowNumber++;
                  }
                  ?>
                  <tr>
                      <td><?php echo $rows['email']; ?></td>
                      <td><?php echo $rows['gname']; ?></td>
                      <td><?php echo $rows['max']; ?></td>
                      <td><?php echo $rows['current']; ?></td>                      
                      <td><a href="<?php echo $rows['googleMapLink']; ?>"><?php echo $rows['venue']; ?></a></td>
                      <td><?php echo $rows['date']; ?></td>
                      <td><?php echo $rows['time']; ?></td>
                      <td><?php echo $playerJoined; ?></td>
                  </tr>
                  <?php
                  $gameNumber++; // Increment the game number
              endwhile;
              ?>
            </tbody>
        </table>                      
      </div>      
    </div>
  </div>
</div>        
</body>
</html>
<?php } ?>