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

    .bg{
  width: 100%;
  position: absolute;
  z-index: -1;
} 
.container{
    text-align: center;
}
.container h1 {
    text-align: center;
    font-family: Verdana, Geneva, Tahoma, sans-serif;
    font-size: 40px;
    color: black;
}

.container p{
     text-align: center;
    font-family: Verdana, Geneva, Tahoma, sans-serif;
    font-size: 20px;
    color: black;
}
.navbar {
    overflow: hidden; /* Hide overflow */
    /* background-color: transparent ;  */
    /* Dark background color */
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
  .players{
      color: black;
  }
  .details{
      color: white;
      margin-left: 45%;
  }
  </style>

<body>
<img class="bg" src="fallback.jpg" alt="UEFA">
    <div class="bgimg">
        <img class="img" src="logo2.png" alt="logo" height="130px">
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
        <p style="color: white;">Select Player name</p>
        <form method="post">
  
  <select id="Jersey" name ="Jersey" style="margin:10px;">
    <option disabled selected>-- Select Player name --</option>
    <?php
      $servername = "localhost";
      $username = "root";
      $password = "";
      $db="football";
      
      // Create connection
      $con = mysqli_connect($servername, $username, $password,$db);
         // Using database connection file here
        $records = mysqli_query($con, "SELECT player_name From stats");  // Use select query here 

        while($data = mysqli_fetch_array($records))
        {
            echo "<option value='". $data['player_name'] ."'>" .$data['player_name'] ."</option>";  // displaying data in option menu
        }	
    ?>  
    </select>
    <button class="btn" name="details" id="details">View Players</button> 

  
  </form>
  </div>
  <div class="details">
  <?php

if(isset($_POST['stats'])){
// Set connection variables
$servername = "localhost";
$username = "root";
$password = "";
$db="football";

// Create connection
$con = mysqli_connect($servername, $username, $password,$db);
$name=$_POST['player_name'];

$sql="CALL `player_name`('$name');";
$result = mysqli_query($con,$sql);
    if ($result !== false && $result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo " <br> Player Name: " . $row["player_name"]." <br> &nbsp &nbsp  &nbsp- 2016-17: " . $row["2016-17"].  "<br>";
        }
    } else {
        echo "0 results";
    }  
}
?>
  </div>

</body>
</html>