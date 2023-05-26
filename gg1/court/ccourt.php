<?php
session_start();
if (!isset($_SESSION['cemail'], $_SESSION['cpass'])) {
  echo "You are not logged in!";
} else {
  include "connection.php";
  $cemail = $_SESSION['cemail'];
  $sql = "SELECT * FROM ccourt";
  $sql2 = "SELECT cusername FROM courtowner WHERE cemail='$cemail' ";
  $result = $con->query($sql);
  $result2 = $con->query($sql2);
  $row = $result2->fetch_assoc();
  $cusername = $row['cusername'];
  $con->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="icon" href="z_court.ico">
  <title>Court - Set Court</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content { height: 100vh }
    /* Set gray background color and 100% height */
    .sidenav {
      background-color: #f1f1f1;
      height: 100%;
    }
    /* On small screens, set height to 'auto' for the grid */
    @media screen and (max-width: 767px) {
      .row.content { height: auto; }
    }
  </style>
</head>
<body>

<div class="container-fluid">
  <div class="row content">
    <div class="col-sm-3 sidenav hidden-xs">
      <h2>MohMain</h2>
      <h5><?php echo $cusername ?></h5>
      <ul class="nav nav-pills nav-stacked">
        <li><a href="cdash.php">Dashboard</a></li>
        <li class="active"><a href="ccourt.php">Register New Court</a></li>
        <li><a href="cUpdateCourt.php">Update Existing Court</a></li>
        <li><a href="cprofile.php">Profile</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul><br>
    </div>
    <br>
    <div class="col-sm-9">
      <div class="well">
        <h4>Register Court</h4>
        <form name="setcourt" method="post" action="ccourtform.php">
          <div class="form-group">
            <label for="cname">Court Name:</label>
            <input type="text" class="form-control" id="cname" name="cname">
          </div>
          <div class="form-group">
            <label for="cloca">Court Location:</label>
            <input type="text" class="form-control" id="cloca" name="cloca">
          </div>
          <div class="form-group">
            <label for="cloca">Court Google Map Link:</label>
            <input type="text" class="form-control" id="cGoogleMapLink" name="cGoogleMapLink">
          </div>
          <div class="form-group">
            <label for="cloca">Price Per Hour:</label>
            <input type="number" class="form-control" min="0.10" max="100.00" step="0.10" name="cprice" />
          </div>
          <div class="form-group">
            <label for="cPhone">Court Phone Number:</label>
            <input type="text" class="form-control" id="cPhone" name="cPhone">
          </div>
          <div class="form-group">
            <label for="ctotal">Total Number of Courts:</label>
            <input type="int" class="form-control" id="ctotal" name="ctotal">
          </div>
          <div class="form-group">
            <label for="cavail">Number of Courts Available: (1-100)</label>
            <input type="number" class="form-control" id="cavail" name="cavail">
          </div>
          <div class="form-group">
            <label for="copen">Open Time:</label>
            <input type="time" class="form-control" id="copen" name="copen">
          </div>
          <div class="form-group">
            <label for="cclose">Closed Time:</label>
            <input type="time" class="form-control" id="cclose" name="cclose">
          </div>
          <div class="form-group">
            <label for="cdesc">Description:</label>
            <input type="text" class="form-control" id="cdesc" name="cdesc">
          </div>
          <input type="hidden" id="cemail" name="cemail" value="<?php echo $cemail ?>">
          <input class="btn btn-primary" type="submit" name="Submit" id="Submit" value="Submit">
        </form>
      </div>
    </div>
  </div>
</div>

</body>
</html>
<?php } ?>
