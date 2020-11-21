<?php
    session_start();
    require 'dbConfig/config.php';
?>

<!DOCTYPE html>

<html>
<head>
    <title>User Registraton</title>
    <link rel="stylesheet" type=text/css href="style.css">

</head>
<body style = "background-color: #e8c97e">
    <div class=background>
        <center><h2>Login Form</h2>
        <form action="register.php" method="post">
        <br><label>Username:</label>
        <br><input name="username" type="text" class="inputvalues" placeholder="Enter Username">
        <br><br><label>Password:</label>
        <br><input name="password" type="password" class="inputvalues" placeholder="Enter Password">
        <br><br><input name="login" type="submit" class="loginButton" value="Login"/>
        <br><br><a href="rr.php"><input type="button" class="registerButton" value="Register"/>

    </form></center>

    <?php
    if (isset($_POST['login'])) {
        $username=$_POST['username'];
        $password=$_POST['password'];

        $query="select * from userInfoTable where username='$username' AND password = '$password'";
    
        $query_run = mysqli_query($con, $query);

        if (mysqli_num_rows($query_run)>0) {
            // valid user
            echo '<script type="text/javascript"> alert("User Exists & Logged In") </script>';
            $_SESSION['username']=$username;
            $_SESSION['article1'];

            header('location: home.php');
        } else {
            //not valid user
            echo '<script type="text/javascript"> alert("Not Valid User") </script>';

        }
    
    }


    ?>
    </div>

   
</body>
</html>
