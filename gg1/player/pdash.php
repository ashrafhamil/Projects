<?php      
session_start();
if(!isset($_SESSION['email'], $_SESSION['pass'])){
  echo "You are not logged in!";
}
  else{
    $email = $_SESSION['email'];
    include "connection.php";
    $sql = "SELECT * FROM game";
    $sql2 = "SELECT playerUserName FROM player WHERE email='$email' ";
    $result = $con->query($sql);
    $result2 = $con->query($sql2);    
    $con->close();    
?>  

<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="icon" href="z_shuttlecock.ico">
  <title>Player - Dashboard</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">  
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
        <li class="active"><a href="pdash.php">Dashboard</a></li>        
        <li><a href="pgame.php">Set Game</a></li>
        <li><a href="pcourt.php">Book Court</a></li>        
        <li><a href="pBookHistory.php">Booking History</a></li>
        <li><a href="pschedule.php">Game Schedule</a></li>        
        <li><a href="pprofile.php">Profile</a></li>        
        <li><a href="logout.php">Logout</a></li>        
      </ul><br>
    </div>
    <br>        

    <div class="col-sm-9">      
      <div class="form-group">
        <div class="input-group">          
          <input type="text" class="form-control" id="search-input" placeholder="Search Game">
        </div>
      </div>    
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">Game Name</th>
            <th scope="col">Organiser</th>
            <th scope="col">Min Player</th>
            <th scope="col">Max Player</th>            
            <th scope="col">Current Player</th>
            <th scope="col">Venue</th>
            <th scope="col">Date</th>
            <th scope="col">Time</th>
            <th scope="col">Description</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>          
          <?php // PHP CODE TO FETCH DATA FROM ROWS // LOOP TILL END OF DATA
                while($rows=$result->fetch_assoc()):          ?>
            <tr>
                <!-- fetching data from every row of every column -->
                <form action="joinForm.php" method="post">
                  <td><?php echo $rows['gname'];?></td>
                  <input type="hidden" id="gname" name="gname" value="<?php echo $rows['gname'];?>">
                  <td><?php echo $rows['organiserName'];?></td>
                  <input type="hidden" id="organiserName" name="organiserName" value="<?php echo $rows['organiserName'];?>">
                  <td><?php echo $rows['min'];?></td>
                  <td><?php echo $rows['max'];?></td>
                  <input type="hidden" id="max" name="max" value="<?php echo $rows['max'];?>">
                  <td><?php echo $rows['current'];?></td>
                  <input type="hidden" id="current" name="current" value="<?php echo $rows['current'];?>">                  
                  <td><a href="<?php echo $rows['googleMapLink']; ?>"><?php echo $rows['venue']; ?></a></td>
                  <input type="hidden" id="venue" name="venue" value="<?php echo $rows['venue'];?>">
                  <input type="hidden" id="googleMapLink" name="googleMapLink" value="<?php echo $rows['googleMapLink'];?>">
                  <td><?php echo $rows['date'];?></td>
                  <input type="hidden" id="date" name="date" value="<?php echo $rows['date'];?>">
                  <td><?php echo $rows['time'];?></td>
                  <input type="hidden" id="time" name="time" value="<?php echo $rows['time'];?>">
                  <td><?php echo $rows['desc'];?></td>
                  <?php
                  $game_name = $rows['gname'];
                  $email = $_SESSION['email'];
                  include "connection.php";
                  $sql_check = "SELECT * FROM schedule WHERE email='$email' AND gname='$game_name'";
                  $result_check = $con->query($sql_check);
                  if ($result_check->num_rows > 0) {
                      echo '<td><button class="btn btn-primary" disabled>Joined</button></td>';
                  } else {
                      echo '<td><button class="btn btn-primary" type="submit">Join</button></td>';
                  }
                  $con->close();
                  ?>
                </form>                                
            </tr> 
            <?php endwhile; ?> <!-- ni tutup while loop -->            
        </tbody>
      </table>

      <div class="well">                
        <h4>Nota</h4>                                
        <p>- Letak icon utk sort, filter and search</p>
      </div>            
            
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
  // Filter table rows based on search input value
  $('#search-input').on('keyup', function() {
    var value = $(this).val().toLowerCase();
    $('tbody tr').filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});

$(document).ready(function() {
  // Sort table rows based on clicked header 
  $('th').click(function() {
    var table = $(this).parents('table').eq(0)
    var rows = table.find('tr:gt(0)').toArray().sort(compare($(this).index()))
    this.asc = !this.asc
    if (!this.asc) {
      rows = rows.reverse()
    }
    for (var i = 0; i < rows.length; i++) {
      table.append(rows[i])
    }
  });
  
  // Compare function for sorting
  function compare(index) {
    return function(a, b) {
      var valA = getCellValue(a, index)
      var valB = getCellValue(b, index)
      return $.isNumeric(valA) && $.isNumeric(valB) ? valA - valB : valA.localeCompare(valB)
    }
  }
  
  // Get value of cell
  function getCellValue(row, index) {
    return $(row).children('td').eq(index).text()
  }
});
</script>
</body>
</html>

<?php 
}
?>