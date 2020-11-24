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
<body style = "background-color: #add8e6">
    <div class=background>
        <center><h2>Are you sure you want to delete?</h2>

        <form action="deleteConfirm.php" method="post">
        <br><br><input name="deleteSendButton" type="submit"  class="back" value="Yes, delete my profile"/>
        <br><br><a href="home.php"><input type="button" class="signUpButton" value="Nevermind"/>
        

    </form></center>

    <?php

    if(isset($_POST['deleteSendButton'])) {
        $username = $_SESSION['username'];

        $query = "delete from userInfoTable where username='$username'";
        $queryRun = mysqli_query($con, $query);
        $query = "delete from allSaved where username='$username'";
        $queryRun = mysqli_query($con, $query);

        if($query) {
            session_destroy();
            header('location:register.php');

        } else {
            echo '<script type="text/javascript"> alert("Unsuccessful Deletion") </script>';

        }
        
        
    }
       
    ?>
    </div>

   
</body>
</html>
