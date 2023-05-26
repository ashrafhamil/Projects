<?php      
session_start();
if(!isset($_SESSION['cemail'], $_SESSION['cpass'])){
  echo "You are not logged in!";
}
  else{
    include "connection.php";
    $cemail = $_SESSION['cemail'];
    $sql = "SELECT * FROM ccourt WHERE cOwnerEmail='$cemail'";
    $result = $con->query($sql);    
    $sql2 = "SELECT cusername FROM courtowner WHERE cemail='$cemail' ";    
    $result2 = $con->query($sql2);         
    $row2 = $result2->fetch_assoc();
    $cusername = $row2['cusername'];
    $con->close();
?>  

<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="icon" href="z_court.ico">
  <title>Court - Profile</title>
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
        <li><a href="cdash.php">Dashboard</a></li>              
        <li><a href="ccourt.php">Register New Court</a></li>
        <li class="active"><a href="cUpdateCourt.php">Update Existing Court</a></li>                
        <li><a href="cprofile.php">Profile</a></li>                
        <li><a href="logout.php">Logout</a></li>        
      </ul><br>
    </div>
    <br>    
    <div class="col-sm-9">
      <div class="well">
        
        <h4>Update Existing Court</h4>                

        <?php
        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            $cname = $row['cname'];
            $cloca = $row['cloca']; 
            $cGoogleMapLink = $row['cGoogleMapLink'];
            $cprice = $row['cprice'];
            $ctotal = $row['ctotal'];      
            $copen = $row['copen'];
            $cclose = $row['cclose'];
            $cdesc = $row['cdesc'];
        ?>
        
        <h4><b><?php echo $cname; ?></b></h4>
        <p>Court Location : <?php echo $cloca; ?></p>
        <p>Google Map Link : <a href="<?php echo $cGoogleMapLink; ?>"><?php echo $cGoogleMapLink; ?></a></p>
        <p>Court Price : RM<?php echo $cprice; ?></p>        
        <p>Total Court : <?php echo $ctotal; ?> courts</p>        
        <p>Open Time : <?php echo $copen; ?></p>        
        <p>Close Time : <?php echo $cclose; ?></p>        
        <p>Court Description : <?php echo $cdesc; ?></p>                
        <button type="button" class="btn btn-info " data-toggle="modal" data-target="#editModal">Update Court</button>           
        <button type="button" class="btn btn-danger " data-toggle="modal" data-target="#deleteModal">Delete Court</button><br><br>
        <?php 
          } 
        } 
        ?>        
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
        <h4 class="modal-title">Update Existing Court</h4>
      </div>
      <div class="modal-body">
        <form action="cUpdateCourtProcess.php" method="POST">
          <div class="form-group">
            <label for="cname">Court Name:</label>
            <input type="text" class="form-control" id="cname" name="cname" value="<?php echo $cname; ?>">
          </div>
          <div class="form-group">
            <label for="cloca">Court Location:</label>
            <input type="text" class="form-control" id="cloca" name="cloca" value="<?php echo $cloca; ?>">
          </div>          
          <div class="form-group">
            <label for="cloca">Google Map Link:</label>
            <input type="text" class="form-control" id="cGoogleMapLink" name="cGoogleMapLink" value="<?php echo $cGoogleMapLink; ?>">
          </div>          
          <div class="form-group">
            <label for="cprice">Court Price:</label>
            <input type="text" class="form-control" id="cprice" name="cprice" value="<?php echo $cprice; ?>">
          </div>
          <div class="form-group">
            <label for="ctotal">Total Court:</label>
            <input type="text" class="form-control" id="ctotal" name="ctotal" value="<?php echo $ctotal; ?>">
          </div>
          <div class="form-group">
            <label for="copen">Open Time:</label>
            <input type="time" class="form-control" id="copen" name="copen" value="<?php echo $copen; ?>">
          </div>
          <div class="form-group">
            <label for="cclose">Close Time:</label>
            <input type="time" class="form-control" id="cclose" name="cclose" value="<?php echo $cclose; ?>">
          </div>
          <div class="form-group">
            <label for="cdesc">Court Description:</label>
            <input type="text" class="form-control" id="cdesc" name="cdesc" value="<?php echo $cdesc; ?>">
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

<div id="deleteModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Delete Court</h4>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete this court?</p>
      </div>
      <div class="modal-footer">
        <form action="deleteCourt.php" method="POST">
          <input type="hidden" name="cname" value="<?php echo $cname; ?>">
          <button type="submit" class="btn btn-danger">Delete</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        </form>
      </div>
    </div>
  </div>
</div>



</body>
</html>

<?php } ?>
