<?php  
    include "connection.php";
    $sql = "SELECT * FROM ccourt";
    $result = $con->query($sql);
    $con->close();    
?> 
<!DOCTYPE html>
<html>
<head>
    <title>Date Picker</title>
    <!-- Include Bootstrap CSS and JS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
        
</head>
<body>
    <div class="container">
    <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">Date</th>              
            </tr>
          </thead>
          
        <tbody>
        <?php while($rows=$result->fetch_assoc()){ ?>        
            <td>
        <form action="process_date.php" method="post">            
                <div class="input-group date">
                    <input type="text" class="form-control" id="date" name="date">
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>                    
                    </div>
                </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            </td>
        </form>        
    </div>
    <?php } ?>
                  </tbody>
                  </table>

    <script type="text/javascript">
        // Initialize Datepicker
        $(function () {
            $('#date').datepicker({
                format: "yyyy-mm-dd",
                autoclose: true,
                todayHighlight: true,
            });
        });
    </script>
</body>
</html>
