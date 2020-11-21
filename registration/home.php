<?php
    session_start();
    require 'dbConfig/config.php';
?>

<!DOCTYPE html>

<html>
<head>
    <title>User Registraton</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type=text/css href="style.css">
    <link rel="stylesheet" href="node_modules/bulma/css/bulma.css" />
    <link href="https://fonts.googleapis.com/css?family=Shrikhand&display=swap" rel="stylesheet">

</head>

<body style = "background-color: #e8c97e">
    <div class=background>
    <center><h2 class="title has-text-info is-family-secondary">Welcome
        <?php echo $_SESSION['username']
        ?></h2 >
        <h3>This is a Home Page</h3>
        <form action="home.php" method="post">
         <br><label>Article To Save:</label>
         <br><input  name="articleTest" type="text" class="inputvalues" placeholder="www.nio.com"/>
         <br><input name="saveArticle" type="submit" class="saveArticleButton" value="Save Article"/>
         <br><br><h3 class="subtitle has-text-grey is-italic">My Links</h3 >
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
        </form>
        

    </center>
    
    <div class="container">
        <div class="content has-text-centered">
            <h1 class="title has-text-info is-family-secondary">Helping Traders Filter For Stock Specific News</h1>
            <h5 class="subtitle has-text-grey is-italic">Find the news that matters</h5>
        </div>
        <div class="tabs is-medium is-centered">
            <ul>
                <li class="is-active"><a>News Feed Search</a></li>
                <li><a>Top News</a></li>
                <li><a href="/watchList.php">Watch Lists</a></li>
                <li><a>Saved Feeds</a></li>
            </ul>
        </div>
        <div class="field has-addons has-addons-centered">
            <p class="control">
              <span class="select">
                <select>
                  <option>% Change in Price</option>
                  <option>10/option>
                  <option>50</option>
                </select>
              </span>
            </p>
            <p class="control" name="stockType">
              <input class="input" id="ticker" type="text" placeholder="Stock Ticker (eg. AAPL)">
            </p>
            <p class="control">
              <a class="button is-primary" id="generate">
                Search For News
              </a>
            </p>
          </div>
    </div>
    </div>
</section>

        <section class="section">
            <div class="container">
            <div class="column is-two-thirds">
            <div id="newsFeed"></div> 
            </div> 
        </div>
        </section>

        <?php 
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
        
        ?></h2>

</body>
    <script src="node_modules/jquery/dist/jquery.js"></script>
    <script src="node_modules/axios/dist/axios.js"></script>
    <script type="module" src="renderNews.js">
    renderSite();
    </script>
</html>
