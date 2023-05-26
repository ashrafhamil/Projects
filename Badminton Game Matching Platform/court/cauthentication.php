<?php      
    include('connection.php'); 
    session_start() ;
    $_SESSION["cemail"] = $_POST['cemail'];
    $_SESSION["cpass"] = $_POST['cpass'];
    $cemail = $_SESSION['cemail'];  
    $cpass = $_SESSION['cpass'];  
      
        //to prevent from mysqli injection  
        $cemail = stripcslashes($cemail);  
        $cpass = stripcslashes($cpass);  
        $cemail = mysqli_real_escape_string($con, $cemail);  
        $cpass = mysqli_real_escape_string($con, $cpass);  
      
        $sql = "select * from courtowner where cemail = '$cemail' and cpass = '$cpass'";  
        $result = mysqli_query($con, $sql);  
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
        $count = mysqli_num_rows($result);  
          
        if($count == 1){  
            header("Location:cdash.php");
            // echo "<h1><center> Login successful </center></h1>";  
            // echo "<a href='cdash.php' >Go to Dashboard</a>";             
        }  
        else{  
            echo "<h1> Login failed. Invalid email or password.</h1>";  
        }     
?>  