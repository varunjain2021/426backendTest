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
    <script src='http://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.js'></script>

    <title>426 Project</title>
</head>


<body>
    <section class="section">
        <div class="container">
            <div class="content has-text-centered">
                <center ><h5 class="title has-text-info is-family-secondary ">Welcome
                <?php echo $_SESSION['username']
                ?></h5 > </center>
                <h1 class="title has-text-info is-family-secondary is-1">StockFeed</h1>
                <h5 class="subtitle has-text-grey is-italic">Helping Traders Filter For Stock Specific News</h5>
            </div>
            <div class="tabs is-medium is-centered">
                <ul>
                    <li><a href="home.php">News Feed Search</a></li>
                    <li><a href="watchList.php">Profile</a></li>
                    <li><a>Popular Stocks</a></li>
                </ul>
            </div>
            <center>
            <form action="watchList.php" method="post">
                <!-- STORE 1.1 GOES HERE-->
                <h3 class="subtitle has-text-grey is-italic">Popular Ticker-Dates Saved</h3 >
                <h3 class="links">
                
                <?php 
                $username = $_SESSION['username'];
                //$sql = "select article1 from userInfoTable where username='$username'";
                $sql = "select username, ticker, date from allSaved";

                //$queryRun = mysqli_query($con, $sql);

                //$row = $queryRun -> fetch_assoc();
                /*
                echo '<table border="0" cellspacing="2" cellpadding="2"> 
                    <tr> 
                        <td> <font face="Arial">Value1</font> </td> 
                        <td> <font face="Arial">Value2</font> </td> 
                        <td> <font face="Arial">Value3</font> </td> 
                    </tr>';
                */
                //if ($result = mysqli_query($con, $sql)) {
                    $result = mysqli_query($con, $sql);
                    while ($row = $result->fetch_assoc()) {
                        $field1name = $row["ticker"];
                        $field2name = $row["date"];
                        $field3name = $row["username"];

                        //$temp = $field1name.",".$field2name.",".$field4name;

                        echo '<article class="message">
                                <div class="message-header">
                                     <p>'.$field1name.'</p>
                                    <p>'.$field2name.'</p>
                                    <p>'.$field3name.'</p>

                                </div>
                            </article>';
                        /*echo '<tr> 
                            <td>'.$field1name.'</td> 
                            <td>'.$field2name.'</td> 
                            <td>'.$field3name.'</td> 
                        </tr>';*/
                    }
                
                    
                //$result->free();
                //}

                //echo "<p class=linksA> {$row["article"]} </p>";
                //echo $row["article1"];

                //echo $_SESSION['article1'];
                ?></h3>

                
            </form>
            
        </center>
    </section>

<br>


<?php

    ?>
    </body>
    <script src='http://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.js'></script>
    <script src="node_modules/jquery/dist/jquery.js"></script>
    <script src="node_modules/axios/dist/axios.js"></script>
    <script type="module" src="render.js">
    renderSiteA();
    </script>
</html>