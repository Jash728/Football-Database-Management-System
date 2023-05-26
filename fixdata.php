<?php
$insert = false;
if(isset($_POST['Submit'])){
// Set connection variables
$servername = "localhost";
$username = "root";
$password = "";
$db="football";

// Create connection
$con = mysqli_connect($servername, $username, $password,$db);
    // Collect post variables
    $Goal_T1 = $_POST['Goal_T1'];
    $Goal_T2 = $_POST['Goal_T2'];
    $Match_ID= $_POST['Match_ID'];
    $sql = "UPDATE `football`.`fixtures` SET Goal_T1=$Goal_T1,Goal_T2=$Goal_T2 where Match_ID=$Match_ID;";
    mysqli_query($con,$sql);
    //echo $sql;

    // Execute the query
    if($con->query($sql) == true){
        //echo "Successfully inserted";

        // Flag for successful insertion
        $insert = true;
    }
    else{
        echo "ERROR: $sql <br> $con->error";
    }

    // Close the database connection
    $con->close();
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
    
 .bg{
  width: 100%;
  position: absolute;
  z-index: -1;
} 
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
        <p>Enter details of match </p>
        <form method="post">
            <input type="text" name="Match_ID" id="Match_ID" placeholder="Match ID">    
            <input type="text" name="Goal_T1" id="Goal_T1" placeholder="Enter Goal of Team 1"> 
            <input type="text" name="Goal_T2" id="Goal_T2" placeholder="Enter Goal of Team 2">
            <button class="btn" id="Submit" name="Submit">Submit</button> 
        </form>
      </div>
</body>
</html>
