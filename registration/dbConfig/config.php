<?php
/*
$server="sql111.epizy.com";
$username="epiz_27255484";
$password="K2hRK5MgfQFB7";
$dbname="epiz_27255484_trialLoginDB";
$con = mysqli_connect("epiz_27255484", "root", "") or die("Unable to connect");

$con = mysqli_connect($server, $username, $password, $dbname) or die("Unable to connect");
mysqli_select_db($con, $dbname);
mysqli_select_db($con, "trialLoginDB")
*/

$con = mysqli_connect("localhost", "root", "") or die("Unable to connect");

mysqli_select_db($con, "trialLoginDB")

?>