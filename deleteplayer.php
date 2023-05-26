<?php
require('connection.php');
if(isset($_POST['Delete'])){
    $servername = "localhost";
        $username = "root";
        $password = "";
        $db="football";
        
        // Create connection
        $con = mysqli_connect($servername, $username, $password,$db);
    $Name = $_POST['Name'];
    $sql="delete from player where Name= '$Name' ";
    $sql2="delete from player_profile where Name= '$Name' ";
    mysqli_query($con,$sql);
    mysqli_query($con,$sql2);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UEFA Champions league</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto|Sriracha&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<style>
    body {
    margin: 0;
    padding: 0;
    font-family: sans-serif;
    background: url() no-repeat;
    background-size: cover;
}
.container h1 {
    text-align: center;
    font-family: Verdana, Geneva, Tahoma, sans-serif;
    font-size: 40px;
    color: white;
}

.container p{
     text-align: center;
    font-family: Verdana, Geneva, Tahoma, sans-serif;
    font-size: 20px;
    color: white;
}
.navbar {
    overflow: hidden; /* Hide overflow */
    background-color: transparent ; /* Dark background color */
    font-family: sans-serif;
    font-weight: bold;
  }
  
  /* Style the navigation bar links */
  .navbar a {
    float: left; /* Make sure that the links stay side-by-side */
    display: block; /* Change the display to block, for responsive reasons (see below) */
    color: white; /* White text color */
    text-align: center; /* Center the text */
    padding: 17px 50px; /* Add some padding */
    text-decoration: none; /* Remove underline */
  }
</style>
<body>
<img class="bg" src="fallback.jpg" alt="UEFA">
    <div class="bgimg">
        <img class="img" src="logo2.png" alt="logo" height="100px">
    </div>
    <div class="navbar">
        <a href="Home.php">Home</a>
        <a href="fixtures.php">Fixtures</a>
        <a href="result.php">Results</a>
        <a href="group.php">Groups</a>
        <a href="transferlogs.php">Transferlogs</a>
        <a href="team.php">Teams</a>
        <a href="player.php">Player</a>
        <a href="league_standing.php">League Standing</a>
        <a href="about.php">About</a>
    </div>
      
      <div class="container">        
        
          <p>Delete player from the league </p>
          <form method="post">
  
    <select id="Name" name = "Name" style="margin:10px;">
      <option disabled selected>-- Select Player Name --</option>
      <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $db="football";
        
        // Create connection
        $con = mysqli_connect($servername, $username, $password,$db);
           // Using database connection file here
          $records = mysqli_query($con, "SELECT DISTINCT Name From player");  // Use select query here 
  
          while($data = mysqli_fetch_array($records))
          {
              echo "<option value='". $data['Name'] ."'>" .$data['Name'] ."</option>";  // displaying data in option menu
          }	
      ?>  
    </select>
              <button class="btn" name="Delete" id="Delete">Delete</button> 
          </form>
        </div>
</body>
</html>
