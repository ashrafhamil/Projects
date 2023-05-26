<?php      
    include('connection.php');  
    session_start();
    $_SESSION["email"] = $_POST['email'];
    $_SESSION["pass"] = $_POST['pass'];

    $email = $_SESSION["email"];
    $pass = $_SESSION["pass"];
      
        //to prevent from mysqli injection  
        $email = stripcslashes($email);  
        $pass = stripcslashes($pass);  
        $email = mysqli_real_escape_string($con, $email);  
        $pass = mysqli_real_escape_string($con, $pass);  
      
        $sql = "select * from player where email = '$email' and pass = '$pass'";  
        $result = mysqli_query($con, $sql);  
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
        $count = mysqli_num_rows($result);  
          
        if($count == 1){  
            header("Location:pdash.php");
            // echo "<h1><center> Login successful </center></h1>";  
            // echo "<a href='pdash.php' >Go to Dashboard</a>";             
        }  
        else{  
            echo "<h1> Login failed. Invalid email or password.</h1>";  
        }     
?>  