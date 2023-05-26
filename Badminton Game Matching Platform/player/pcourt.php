<?php  
session_start();
if(!isset($_SESSION['email'], $_SESSION['pass'])){
  echo "You are not logged in!";
}else{ 
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
  <title>Player - Court</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/smoothness/jquery-ui.css">    
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">                
  <!-- utk date and time picker -->
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
    .time-slot {
			display: inline-block;
			width: 100px;
			height: 50px;
			border: 1px solid #ccc;
			margin: 5px;
			padding: 10px;
			text-align: center;
			cursor: pointer;
			border-radius: 5px;
		}
		.time-slot.selected {
			background-color: #007bff;
			color: #fff;
		}        
  </style>
</head>
<body>
<?php
		// Define available time slots
		$timeSlots = array(
			'8:00am - 10:00am',			
			'10:00am - 12:00pm',			
			'12:00pm - 2:00pm',
			'2:00pm - 4:00pm',						
			'4:00pm - 6:00pm',
			'6:00pm - 8:00pm',
			'8:00pm - 10:00pm',
			'10:00pm - 12:00am',			
		);
	?>

<div class="container-fluid">
  <div class="row content">
    <div class="col-sm-3 sidenav hidden-xs">
      <h2>MohMain</h2>
      <?php while ($row2 = $result2->fetch_assoc()) {echo $row2['playerUserName']."<br>";}?>
      <ul class="nav nav-pills nav-stacked">
        <li><a href="pdash.php">Dashboard</a></li>
        <li><a href="pgame.php">Set Game</a></li>
        <li class="active"><a href="pcourt.php">Book Court</a></li>        
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
          <input type="text" class="form-control" id="search-input" placeholder="Search Court">
        </div>
      </div>  
      <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">Court Name</th>
              <th scope="col" class="col-sm-auto">Location</th>              
              <!-- <th scope="col">Available Court</th> -->
              <th scope="col">Price/Hour(RM)</th>            
              <th scope="col">Open Time</th>
              <th scope="col">Close Time</th>
              <th scope="col">Date</th>          
              <th scope="col">Time Slot</th>                  
              <th scope="col">Description</th>                            
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>          
            <?php // PHP CODE TO FETCH DATA FROM ROWS // LOOP TILL END OF DATA
                  $counter = 0;
                  while($rows=$result->fetch_assoc()){          ?>
              <tr>
                  <form action="pcourtform.php" method="post" id="book-court-form">                      
                  <td><?php echo $rows['cname'];?></td><input type="hidden" id="cname" name="cname" value = "<?php echo $rows['cname'];?>">
                  <td><a href="<?php echo $rows['cGoogleMapLink']; ?>" target="_blank"><?php echo "Court location";?></a></td><input type="hidden" id="cGoogleMapLink" name="cGoogleMapLink" value = "<?php echo $rows['cGoogleMapLink'];?>"></td>                                    
                  <td><?php echo $rows['cprice'];?></td><input type="hidden" id="cprice" name="cprice" value = "<?php echo $rows['cprice'];?>">
                  <td><?php echo $rows['copen'];?></td><input type="hidden" id="copen" name="copen" value = "<?php echo $rows['copen'];?>">
                  <td><?php echo $rows['cclose'];?></td><input type="hidden" id="cclose" name="cclose" value = "<?php echo $rows['cclose'];?>">
                  <input type="hidden" id="cavail" name="cavail" value = "<?php echo $rows['cavail'];?>">

                  <td>
                  <div class="input-group date">  
                  <input type="text" id="datepicker_<?php echo $counter; ?>" name="bDate" placeholder="yyyy/mm/dd"  class="form-control" style="width: 100px;" required>
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>                    
                    </div>
                  </div></td>

                  <td>
                      <?php foreach ($timeSlots as $timeSlot): ?>
                          <div class="time-slot"><?php echo $timeSlot; ?></div>
                      <?php endforeach; ?>                      
                      <input type="hidden" name="bTimeSlot" id="bTimeSlot<?php echo $counter; ?>" required>
                  </td>

                  <td><?php echo $rows['cdesc'];?></td>                         
                  <input type="hidden" id="cdesc" name="cdesc" value = "<?php echo $rows['cdesc'];?>">
                  <td><button class="btn btn-primary" type="submit" >Book</button></td>
                  </form>                                                                              
              </tr>                             
              <?php $counter++;
            }
             ?> <!-- ni tutup while loop -->                          
          </tbody>
        </table>
        <div class="well">        
        <h4>Issue</h4>                   
        <p>- Kena semak available court pada masa yg dipilih</p>                        
        <p>- Allow sort and filter</p>
        <a href="https://goo.gl/maps/nSMpQaKX1NMVDeuu9" target="_blank">View location in Google Maps</a>
      </div>      
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
        // Initialize Datepicker for each input field with a unique ID
        $(function () {
            <?php for($i = 0; $i < $counter; $i++){ ?>
                $('#datepicker_<?php echo $i; ?>').datepicker({
                    format: "yyyy-mm-dd",
                    autoclose: true,
                    todayHighlight: true,
                });
            <?php } ?>
        });
</script>

<script>
    // Handle time slot selection
    var timeSlots = document.querySelectorAll('.time-slot');
    <?php for($i = 0; $i < $counter; $i++){ ?>
        var selectedTimeSlot<?php echo $i; ?> = document.querySelector('#bTimeSlot<?php echo $i; ?>');
        timeSlots.forEach(function(timeSlot) {
            timeSlot.addEventListener('click', function() {
                // Remove selection from all time slots
                timeSlots.forEach(function(timeSlot) {
                    timeSlot.classList.remove('selected');
                });
                // Add selection to clicked time slot
                this.classList.add('selected');
                // Set selected time slot value in hidden input
                selectedTimeSlot<?php echo $i; ?>.value = this.textContent;
            });
        });
    <?php } ?>        
</script>
<script>
$(document).ready(function() { //function ni buat sbb dah letak required kat time slot input tpi user tetap blh proceed booking.
  // Add onSubmit event listener to the form
  $('#book-court-form').submit(function() {
    // Get the selected time slot
    var selectedSlot = $('.time-slot.selected');
    
    // Check if any time slot is selected
    if (selectedSlot.length === 0) {
      // Display an error message
      alert('Please select a time slot.');
      return false; // prevent the form from being submitted
    }
  });
});
</script>

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

//filter function ni kena semak balik
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
<?php } ?>