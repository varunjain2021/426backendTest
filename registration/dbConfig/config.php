<?php

$server="sql203.epizy.com";
$username="epiz_27274061";
$password="mgElAaG7212Ua8";
$dbname="epiz_27274061_trialLoginDB";
//$con = mysqli_connect("epiz_27255484", "root", "") or die("Unable to connect");

$con = mysqli_connect($server, $username, $password, $dbname) or die("Unable to connect");
mysqli_select_db($con, $dbname);
//mysqli_select_db($con, "trialLoginDB")


?>