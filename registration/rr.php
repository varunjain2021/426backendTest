<?php

    require 'dbConfig/config.php';
?>


<!DOCTYPE html>

<html>
<head>
    <title>Registraton Form</title>
    <link rel="stylesheet" type=text/css href="style.css">

</head>
<body style = "background-color: #e8c97e">
    <div class=background>
        <center><h2>Registration Form</h2>
        <form action="rr.php" method="post">
        <br><label>Username:</label>
        <br><input  name="username" type="text" class="inputvalues" placeholder="Enter Username" required/>
        <br><br><label>Password:</label>
        <br><input name="password" type="password" class="inputvalues" placeholder="Enter Password" required/>
        <br><br><label>Confirm Password:</label>
        <br><input name="cpassword" type="password" class="inputvalues" placeholder="Confirm Password" required/>
        <br><br><input name="submitButton" type="submit"  class="signUpButton" value="Sign Up"/>
        <br><br><a href="register.php"><input type="button" class="back" value="Back to Login"/>

    </form></center>

    <?php
        if(isset($_POST['submitButton'])) {
            //echo '<script type="text/javascript"> alert("Sign Up Clicked") </script>';
            $username = $_POST['username'];
            $password = $_POST['password'];
            $cpassword = $_POST['cpassword'];

            if($password==$cpassword) {
                $query = "select * from userInfoTable where username ='$username'";
                $queryRun = mysqli_query($con, $query);

                if (mysqli_num_rows($queryRun)>0) {
                    echo '<script type="text/javascript"> alert("User Exists") </script>';
                } else 
                {
                    $query = "insert into userInfoTable values('$username', '$password', 'www.null.com')";
                    $queryRun = mysqli_query($con, $query);

                    if($query) {
                        echo '<script type="text/javascript"> alert("User Registered") </script>';

                    } else {
                        echo '<script type="text/javascript"> alert("Unsuccessful") </script>';

                    }

                }
            } else {
                echo '<script type="text/javascript"> alert("Passwords do not match") </script>';

            }
        
        }
    ?>
    </div>

   
</body>
</html>
