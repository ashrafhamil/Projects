<?php      
session_start();
if (!isset($_SESSION['cemail'], $_SESSION['cpass'])) {
  echo "You are not logged in!";
} else {
  include "connection.php";
  $cemail = $_SESSION['cemail'];
  $sql = "SELECT * FROM ccourt WHERE cOwnerEmail='$cemail' ";
  $sql2 = "SELECT cusername FROM courtowner WHERE cemail='$cemail' ";
  $result = $con->query($sql);
  $result2 = $con->query($sql2);

  $row = $result2->fetch_assoc();
  $cusername = $row['cusername'];

// Fetch data from the "book" table based on court name and court owner email
$bookSql = "SELECT b.bCourtName, b.bTimeSlot, b.bTimeStamp 
            FROM book b
            INNER JOIN ccourt c ON b.bCourtName = c.cname
            WHERE c.cOwnerEmail = '$cemail'";
$bookResult = $con->query($bookSql);


  $con->close();
?>
 

<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="icon" href="z_court.ico">
  <title>Court - Dashboard</title>
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
      <h5><?php echo $cusername?></h5>
      <ul class="nav nav-pills nav-stacked">
        <li class="active"><a href="cdash.php">Dashboard</a></li>                
        <li><a href="ccourt.php">Register New Court</a></li>
        <li><a href="cUpdateCourt.php">Update Existing Court</a></li>                
        <li><a href="cprofile.php">Profile</a></li>
        <li><a href="logout.php">Logout</a></li>        
      </ul><br>
    </div>
    <br>
    
    <div class="col-sm-9">
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">Court Name</th>
            <th scope="col">Price/Hour</th>
            <th scope="col">Total Court</th>
            <th scope="col">Booked Court</th>
            <th scope="col">Available Court</th>
            <th scope="col">Action</th>
            <!-- <th scope="col">Date</th>
            <th scope="col">Time</th>
            <th scope="col">Description</th> -->
          </tr>
        </thead>
        <tbody>          
          <?php // PHP CODE TO FETCH DATA FROM ROWS // LOOP TILL END OF DATA
                while($rows=$result->fetch_assoc()){
          ?>
            <tr>
                <!-- fetching data from every row of every column -->
                <td><?php echo $rows['cname'];?></td>
                <td><?php echo $rows['cprice'];?></td>
                <td><?php echo $rows['ctotal'];?></td>
                <td><?php echo $rows['cavail'];?></td>
                <td><?php echo $rows['cavail'];?></td>
                <td><button class="btn btn-primary" type="button">Update</button></td>
                <!-- <td><?php echo $rows['date'];?></td>
                <td><?php echo $rows['time'];?></td>
                <td><?php echo $rows['desc'];?></td> -->
            </tr> 
            <?php } ?> <!-- ni tutup while loop tadi -->
        </tbody>
      </table>

      <div class="col-sm-9">
      <h3>Booked Courts</h3>
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">Court Name</th>
            <th scope="col">Time</th>
            <th scope="col">Timestamp</th>
            <th scope="col">More Info</th>
          </tr>
        </thead>
        <tbody>          
          <?php
          while ($rows = $bookResult->fetch_assoc()) {
          ?>
            <tr>
              <td><?php echo $rows['bCourtName']; ?></td>
              <td><?php echo $rows['bTimeSlot']; ?></td>
              <td><?php echo $rows['bTimeStamp']; ?></td>
              <td><button type="button" class="btn btn-link" data-toggle="modal" data-target="#myModal">Details</button></td>
            </tr> 
          <?php
          }
          ?>
        </tbody>
      </table>

      <div class="well">                
        <h4>Developer Notes:</h4>                
        <p>- Tambah button utk edit number of court available. Better to automate it</p>
      </div>                              
  </div>
</div>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content -->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Book Details</h4>
      </div>
      <div class="modal-body">
        <p>Book ID      : </p>
        <p>Booker Name  : </p>
        <p>Booker Email : </p>
        <p>Payment Made :</p>
        <p>Court Name   : </p>
        <p>Date         : </p>
        <p>Time Slot    : </p>      
        <p>Time Stamp   : </p>
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