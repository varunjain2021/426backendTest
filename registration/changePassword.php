<?php
    session_start();
    require 'dbConfig/config.php';
?>


<!DOCTYPE html>

<html>
<head>
    <title>Delete Form</title>
    <link rel="stylesheet" type=text/css href="style.css">

</head>
<body style = "background-color: #e8c97e">
    <div class=background>
        <center><h2>Change Your Password</h2>

        <form action="changePassword.php" method="post">
        <br><label>Old Password:</label>
        <br><input name="oldp" type="password" class="inputvalues" placeholder="Enter Old Password"required/>
        <br><br><label>New Password:</label>
        <br><input name="newp" type="password" class="inputvalues" placeholder="Enter New Password" required/>
        <br><br><label>Confirm New Password:</label>
        <br><input name="cnewp" type="password" class="inputvalues" placeholder="Confirm New Password" required/>
        <br><br><input name="submitButton" type="submit"  class="signUpButton" value="Change Password"/>
        <br><br><a href="home.php"><input type="button" class="back" value="Nevermind"/></a>
        

    </form></center>

    <?php

    if(isset($_POST['submitButton'])) {
        $username = $_SESSION['username'];
        $oldPassword = $_POST['oldp'];
        $newPassword = $_POST['newp'];
        $confirmNewpassword = $_POST['cnewp'];

        $query = "select password from userInfoTable where username ='$username'";
        //$query = "delete from userInfoTable where username='$username'";

        $queryRun = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($queryRun);
        echo $row['password'];
        if($row['password']==$oldPassword) {
            if ($newPassword==$confirmNewpassword) {
                $query = "update userInfoTable set password='$newPassword' where username='$username'";
                $queryRun = mysqli_query($con, $query);
                header('location:watchList.php');
            } else {
                echo '<script type="text/javascript"> alert("New Password does not match to Confirm Password") </script>';
            }
        } else {
            echo '<script type="text/javascript"> alert("Old Password does not match to Current Password") </script>';
        }

    }
       
    ?>
    </div>

   
</body>
</html>
