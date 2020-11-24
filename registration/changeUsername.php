<?php
    session_start();
    require 'dbConfig/config.php';
?>


<!DOCTYPE html>

<html>
<head>
    <title>Change Username Form</title>
    <link rel="stylesheet" type=text/css href="style.css">

</head>
<body style = "background-color: #add8e6">
    <div class=background>
        <center><h2>Change Your Username</h2>

        <form action="changeUsername.php" method="post">
        <br><label>Old Username:</label>
        <br><input name="oldu" type="text" class="inputvalues" placeholder="Enter Old Username"required/>
        <br><br><label>New Username:</label>
        <br><input name="newu" type="text" class="inputvalues" placeholder="Enter New Username" required/>
        <br><br><label>Confirm New Password:</label>
        <br><input name="cnewu" type="text" class="inputvalues" placeholder="Confirm New Username" required/>
        <br><br><input name="submitButton" type="submit"  class="signUpButton" value="Change Username"/>
        <br><br><a href="home.php"><input type="button" class="back" value="Nevermind"/></a>
        

    </form></center>

    <?php

    if(isset($_POST['submitButton'])) {
        $username = $_SESSION['username'];
        $oldUsername = $_POST['oldu'];
        $newUsername = $_POST['newu'];
        $confirmNewUsername = $_POST['cnewu'];

        $query = "select username from userInfoTable where username ='$username'";
        //$query = "delete from userInfoTable where username='$username'";

        $queryRun = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($queryRun);
        //echo $row['username'];
        if($row['username']==$oldUsername) {
            if ($newUsername==$confirmNewUsername) {
                $query = "update userInfoTable set username='$newUsername' where username='$username'";
                $queryRun = mysqli_query($con, $query);
                $_SESSION['username']=$newUsername;
                header('location:watchList.php');
                header("Refresh:0");
            } else {
                echo '<script type="text/javascript"> alert("New Username does not match to Confirm Username") </script>';
            }
        } else {
            echo '<script type="text/javascript"> alert("Old Username does not match to Current Username") </script>';
        }

    }
       
    ?>
    </div>

   
</body>
</html>
