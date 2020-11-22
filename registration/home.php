<?php
    session_start();
    require 'dbConfig/config.php';
?>

<!DOCTYPE html>

<html>
<head>
    <title>User Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type=text/css href="style.css">
    <link rel="stylesheet" href="node_modules/bulma/css/bulma.css" />
    <link href="https://fonts.googleapis.com/css?family=Shrikhand&display=swap" rel="stylesheet">

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
              <li><a>News Feed Search</a></li>
              <li><a href="watchList.php">Profile</a></li>
            </ul>
        </div>
        
        <div class="field has-addons has-addons-centered">
        
            <p class="control">
              <span class="select">
                <select placeholder = "% Change in Price" id = "determineChange">
                  <option class = "change">3</option>
                  <option class = "change">5</option>
                  <option class = "change">-3</option>
                  <option class = "change">-5</option>
                </select>
              </span>
            </p>
            <p class="control" id = "crazyVibes" >
              <input class="input" type="text" placeholder="Stock Ticker (eg. AAPL)" id = "ticker" name="ticker">
              
              <div id = "mo"></div>
            </p>

            <p class="control">
            <input class="button is-primary" type="button" id="findDate" value="Search For News"/>
            </p>     
            
        </div>
        
        <div id = "listOfButtons"></div>
        
        
        
    </section>

        <section class="section">
            <div class="container">
            <div class="column is-two-thirds">
            <div id="newsFeed"></div> 
            </div> 
        </div>
        </section>

        <?php 

            /* 
            if(isset($_GET['tickerSumbit'])) {
                $ticker = $_GET['ticker'];

                if($ticker) {
                    echo '<script type="text/javascript"> alert("Ticker Entered") </script>';

                }
            
            }
            */ 

            /*

            if(isset($_POST['tickerSubmit'])) {
                echo "Banter";
                echo '<script type="text/javascript"> alert("Article Saved") </script>';
            }
            */

            if(isset($_POST['logout'])) {
                session_destroy();
                header('location:register.php');
            }

            

            if(isset($_POST['saveArticle'])) {
                $username = $_SESSION['username'];
                $article1 = $_POST['articleTest'];
                //$query = "insert into userInfoTable values('$article1')";
                $query = "update userInfoTable set article1='$article1' where username='$username'";
                $queryRun = mysqli_query($con, $query);

                    if($query) {
                        echo '<script type="text/javascript"> alert("Article Saved") </script>';
                        $_SESSION['article1']=$article1;
                        header("Refresh:0");


                    } else {
                        echo '<script type="text/javascript"> alert("Unsuccessful") </script>';

                    }
            }
            

            if(isset($_GET['save'])) {
                $result = $_GET['save']; 
                if ($result) {
                    $username = $_SESSION['username'];
                    $article1 = $result;
                    $query = "update userInfoTable set article1='$article1' where username='$username'";
                    $queryRun = mysqli_query($con, $query);

                    if($query) {
                        $_SESSION['article1']=$article1;
                        
                    } else {
                        echo '<script type="text/javascript"> alert("Unsuccessful") </script>';
                    }
                }
            }
        
        ?>

</body>
    <script src="node_modules/jquery/dist/jquery.js"></script>
    <script src="node_modules/axios/dist/axios.js"></script>
    <script type="module" src="render.js">
    renderSiteA();
    </script>
</html>


