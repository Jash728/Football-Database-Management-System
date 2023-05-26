<?php
$insert = false;
if(isset($_POST['Team_ID'])){
// Set connection variables
$servername = "localhost";
$username = "root";
$password = "";
$db="football";

// Create connection
$con = mysqli_connect($servername, $username, $password,$db);
    
    // Execute the query
    if($con->query($sql) == true){
        // echo "Successfully inserted";

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
<body>
    <img class="bg" src="fallback.jpg" alt="UEFA">
    <div class="bgimg">
        <img class="img" src="logo2.png" alt="logo" height="100px">
    </div>
    <style>
    .teamname{
      text-align: left;
        color: white;
    }
    body {
    margin: 0;
    padding: 0;
    font-family: sans-serif;
    background: url() no-repeat;
    background-size: cover;
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
  .transfer{
      color: white;
  }
    </style>
    
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
    <div class="transfer">
  <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db="football";
    
    // Create connection
    $con = mysqli_connect($servername, $username, $password,$db);
    $sql="select * from transferlogs";
    $result=mysqli_query($con,$sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo " <br> Name: " . $row["Name"]. " <br> &nbsp &nbsp  &nbsp- Past Club: " . $row["Past_Club"]. "<br> &nbsp &nbsp  &nbsp- New Club: " . $row["Future_Club"]."<br>";
        }
    } else {
        echo "0 results";
    }
  ?>
  </div>
</body>
</html>