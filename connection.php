<?php
$servername = "localhost";
$username = "root";
$password = "";
$db="football";

// Create connection
$con = mysqli_connect($servername, $username, $password,$db);
if(!$con){
    die("connection to this database failed due to" . mysqli_connect_error());
}
?>