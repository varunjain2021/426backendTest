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
            <h1 class="title has-text-info is-family-secondary is-1">StockFeed</h1>
            <h5 class="subtitle has-text-grey is-italic">Helping Traders Filter For Stock Specific News</h5>
            <p>Use search bar below to filter for the articles based on a percentage price change in a stock's price!</p> 
            
        </div>
        <div class="tabs is-medium is-centered">
            <ul>
              <li><a>News Feed Search</a></li>
              <li><a href="watchList.php" id="clearNews">Profile</a></li>
              <li><a href="newsFeed.php" id="everyone">Popular Stocks</a></li>
            </ul>
        </div>
        <div class="field has-addons has-addons-centered">
            <p class="control">
                <input class = "input" placeholder = "% Change in Price (eg. 3)" id = "determineChange" style="width: 215px">
                <!--
              <span class="select">
                <select placeholder = "% Change in Price" id = "determineChange">
                    
                    
                    <option class = "change">3</option>
                    <option class = "change">5</option>
                    <option class = "change">10</option>
                    <option class = "change">-3</option>
                    <option class = "change">-5</option>
                    <option class = "change">-10</option>
                    
                </select>
              </span>
              -->
            </p>
            <p class="control" id = "crazyVibes" >
              <input class="input" type="text" placeholder="Stock Ticker (eg. AAPL)" id = "ticker" style="width: 250px" required/>
              <div id = "mo"></div>
            </p>
            
            <p class="control">
              <a class="button is-primary" id="findDate" style="width: 215px">
                Search For News
              </a>
            </p>
            
          </div>
          <br>
          <center>
          <div id = "listOfDateButtons" class="buttons"></div>
          </center>
    </div>
</section>

<section class="section">
  <div class="container">
      <div class="column is-half is-offset-one-quarter">
          <div id="newsFeed">
            <div id="abc">
              <!-- Popup Div Starts Here -->
              <!-- Popup Div Ends Here -->
              </div>
          </div> 
      </div> 
  </div>
</section> 

        <?php 


            if(isset($_GET['saveArr'])) {
                $username = $_SESSION['username'];
                //$article1 = $_POST['saveArticle'];
                $arr = $_GET['saveArr'];
                $comment = $arr[3];
                
                
                //echo $_SESSION['comment'];
                //$arr = explode(",", $article1);
                $ticker = $arr[0];
                $date = $arr[1];
                $article1= $arr[2];
                //echo $comment;
                //$query = "insert into userInfoTable values('$article1')";
                $query = "update userInfoTable set article1='$article1' where username='$username'";
                
                $query = "select * from allSaved where username='$username' AND ticker='$ticker' AND date='$date' AND article='$article1')";
                $queryRun = mysqli_query($con, $query);
                    if(mysqli_num_rows($queryRun)>0) {
                        echo '<script type="text/javascript"> alert("Article Already Saved") </script>';
                        
                        //$_SESSION['article1']=$article1;
                    } else {
                        $query = "insert into allSaved values('$username', '$ticker', '$date', '$article1', '$comment')";
                        $queryRun = mysqli_query($con, $query);
                        echo '<script type="text/javascript"> alert("Article Saved") </script>';
                        

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


