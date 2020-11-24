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
                    <li><a href="newsFeed.php" id="everyone">News Feed</a></li>
                </ul>
            </div>
            <center>
            <form action="watchList.php" method="post">
                <!-- STORE 1.1 GOES HERE-->
                <h3 class="subtitle has-text-grey is-italic">My Watchlist</h3 >
                <h3 class="links">
                
                <?php 
                $username = $_SESSION['username'];
                $sql = "select ticker, date, article, comment from allSaved where username='$username'";

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
                    $x = 0;
                    while ($row = $result->fetch_assoc()) {
                        $field1name = $row["ticker"];
                        $field2name = $row["date"];
                        $field3name = $row["article"];
                        $field4name = $row["comment"];
                        $temp = "$field4name";

                        $temp = $field1name.",".$field2name.",".$field3name.",".$field4name;

                        echo '<article id='.$x.' value="'.$temp.'" class="message">
                                <div class="message-header">
                                     <p>'.$field1name.'</p>
                                    <p>'.$field2name.'</p>
                                    <p><a href='.$field3name.'>Link To Article</a></p>
                                    <button class="delete" value="Delete" type="button" id='.$x.' name="'.$temp.'"></button>
                                </div>
                                <div name='.$x.' class="message-body">
                                '.$field4name.'
                                </div>
                                    <button type="button" id='.$x.' class="editComment" name="'.$temp.'">Edit</button>
                            </article>';
                        $x=$x+1;
                    }
                
        
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

<script> 

    function generateEdit(e) {
        let x = e.target.id
        let y = e.target.name

        console.log(y)
        $(`#${x}`).append(`<form id="editForm" action="home.php" method="post">
            <div class="box">
                <div class="control">
                    <input id="commentNew" class="input" type="text" placeholder="Type your insights here">
                </div>
                <br>
                
                <button id="saveEdit" name="${x}" class="button is-success" type="button" value=${y}>Save Edit</button>
                <button id="closeEdit" name="${x}" class="button" type="button">Cancel</button>
            </div>
          </form>`)
        $(`#${x}`).prop('disabled', true);
          
    }

    function cancelEdit(e) {

        let y = e.target.name
        

        $('#editForm').remove();
        $(`#${y}`).prop('disabled', false);

    }

    function submitEdit(e) {
        let y = e.target.value;
        let x = e.target.name;
        let oldCom = $(`div[class="message-body"][name="${x}"]`).text()
        console.log(oldCom)
        let newCom = document.getElementById('commentNew').value;

        let arr=y.split(',');
     
        $(`div[class="message-body"][name="${x}"]`).replaceWith(`<div name='${y}' class="message-body"> 
                                ${newCom}
                                </div>`);
        //console.log(bet);
        arr[4] = newCom;
        //arr[3] = oldCom;

        $.ajax({  
            type: 'GET',
            url: 'watchList.php', 
            data: {updateCom: arr},
            success: function(response) {
                console.log(newCom);
                console.log("Success");
            }
        }); 

        $('#editForm').remove();
        $(`#${x}`).prop('disabled', false);
        //header("Refresh:0")

    }

    function deleteComment(e) {

        //id='.$x.' 
        //name="'.$temp.'

        let name = e.target.name;
        let id = e.target.id;

        //let name = document.getElementById(`${id}`).value
        //let name = $(`#${id}`).val();
        let arr=name.split(',');
        $.ajax({  
            type: 'GET',
            url: 'watchList.php', 
            data: {deleteCom: arr},
            success: function(response) {
                //console.log(newCom);
                console.log("Success");
            }
        }); 

        $(`#${id}`).remove();


    }
 

    const renderEdit = function() {
        $(document).on('click', '.editComment', generateEdit);
        $(document).on('click', '#closeEdit', cancelEdit);
        $(document).on('click', '#saveEdit', submitEdit);
        $(document).on('click', '.delete', deleteComment);
    }   
    $(function(){
        renderEdit(); 
    });
    
</script>

<?php

    if(isset($_POST['logout'])) {
        session_destroy();
        echo "<script>window.location.href='/registration/register.php'</script>";
        //header('location:register.php');
        
    }

    if(isset($_GET['updateCom'])) {
        $username = $_SESSION['username'];

        $arr = $_GET['updateCom'];
        $newComment = $arr[4];
        $ticker = $arr[0];
        $date = $arr[1];
        $article= $arr[2];
        $oldComment = $arr[3];

        $query = "update allSaved set comment='$newComment' where comment='$oldComment' AND article='$article' AND username='$username' AND ticker='$ticker' AND date='$date'";
                
        $queryRun = mysqli_query($con, $query);
            if($queryRun) {
                echo '<script type="text/javascript"> alert("Comment Updates") </script>';
            } else {
                echo '<script type="text/javascript"> alert("Comment Did Not Update") </script>';
            }  
    }

    if(isset($_GET['deleteCom'])) {
        $username = $_SESSION['username'];

        $arr = $_GET['deleteCom'];
        $newComment = $arr[4];
        $ticker = $arr[0];
        $date = $arr[1];
        $article= $arr[2];
        $oldComment = $arr[3];

        $query = "delete from allSaved where comment='$oldComment' AND article='$article' AND username='$username' AND ticker='$ticker' AND date='$date'";
                
        $queryRun = mysqli_query($con, $query);
            if($queryRun) {
                echo '<script type="text/javascript"> alert("Comment Deleted") </script>';
            } else {
                echo '<script type="text/javascript"> alert("Comment Did Not Delete") </script>';
            }  
    }


    ?>
    </body>
    <script src='http://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.js'></script>
    <script src="node_modules/jquery/dist/jquery.js"></script>
    <script src="node_modules/axios/dist/axios.js"></script>
    <script type="module" src="render.js">
    renderSiteA();
    </script>
</html>