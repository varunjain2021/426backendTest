<?php
    session_start();
    require 'dbConfig/config.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="node_modules/bulma/css/bulma.css" />
    <link rel="stylesheet" type=text/css href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Shrikhand&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>426 Project</title>
</head>


<body>
    <section class="section">
        <div class="container">
            <div class="content has-text-centered">
                <center ><h5 class="title has-text-info is-family-secondary">Welcome
                <?php echo $_SESSION['username']
                ?></h5 > </center>
                <h1 class="title has-text-info is-family-secondary">Helping Traders Filter For Stock Specific News</h1>
                <h5 class="subtitle has-text-grey is-italic">Find the news that matters</h5>
            </div>
            <div class="tabs is-medium is-centered">
                <ul>
                    <li><a href="home.php">News Feed Search</a></li>
                    <li><a>Profile</a></li>
                </ul>
            </div>
            <center>
            <form action="watchList.php" method="post">
                <!-- STORE 1.1 GOES HERE-->
                <h3 class="subtitle has-text-grey is-italic">My Watchlist</h3 >
                <h3 class="links">
                
                <?php 
                $username = $_SESSION['username'];
                //$sql = "select article1 from userInfoTable where username='$username'";
                $sql = "select article1 from userInfoTable where username='$username'";

                $queryRun = mysqli_query($con, $sql);

                $row = $queryRun -> fetch_assoc();

                echo "<p class=linksA> {$row["article1"]} </p>";
                //echo $row["article1"];

                //echo $_SESSION['article1'];
                ?></h3>
                <br><input name="logout" type="submit" class="logoutButton" value="Logout"/>
                <br><br><a href="changePassword.php"><input name="changePassword" type="button" class="changePword" value="Change Password"/></a>
                <br><br><a href="changeUsername.php"><input name="changeUsername" type="button" class="changePword" value="Change Username"/></a>
                <br><br><a href="deleteConfirm.php"><input name="deleteUser" type="button" class="back" value="Delete Account"/></a>

            </form>
            
        </center>
    </section>

<br>

<section class="section">
    <div class="container">
        <div class="column is-two-thirds">
            <div id="profileFeed"></div> 
        </div> 
    </div>
</section> 

<?php

    if(isset($_POST['logout'])) {
        session_destroy();
        header('location:register.php');
    }
    ?>
    </body>
    <script src="node_modules/jquery/dist/jquery.js"></script>
    <script src="node_modules/axios/dist/axios.js"></script>
    <script type="module" src="render.js">
    renderSiteA();
    </script>
</html>