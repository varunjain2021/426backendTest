<?php
    //session_start();
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
        <h3>This is a Tab</h3>
       

    </center>


    </body>
    <script src="node_modules/jquery/dist/jquery.js"></script>
    <script src="node_modules/axios/dist/axios.js"></script>
    <script type="module" src="renderNews.js">
    renderSite();
    </script>
</html>