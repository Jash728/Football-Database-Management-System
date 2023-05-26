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
    $Team_ID = $_POST['Team_ID'];
    $Team_Name = $_POST['Team_Name'];
    $Year_Founded= $_POST['Year_Founded'];
    $Stadium = $_POST['Stadium'];
    $title = $_POST['title'];
    $sql = "INSERT INTO `football`.`team_info` (`Team_ID`,`Team_Name`, `Year_Founded`, `Stadium`,  `title`) VALUES ($Team_ID,'$Team_Name', $Year_Founded, '$Stadium', $title);";
    mysqli_query($con,$sql);
    //echo $sql;

    // Execute the query
    if($con->query($sql) == true){
        //echo "Successfully inserted";

        // Flag for successful insertion
        $insert = true;
    }
    else{
        echo "<script>alert('ERROR: $con->error');</script>";
       
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
        
      <h1>team_info</h1>
        <p>Enter details of your team </p>
        <?php
        if($insert == true){
        echo "<p class='submitMsg'>Thanks for submitting your form. We are happy to see you joining us for the US trip</p>";
        }
        ?>
        <form method="post">
            <input type="text" name="Team_ID" id="Team_ID" placeholder="Enter team ID"> 
            <input type="text" name="Team_Name" id="Team_Name" placeholder="Enter team name">
            <input type="year" name="Year_Founded" id="Year_Founded" placeholder="Year">
            <input type="text" name="Stadium" id="Stadium" placeholder="Stadium">
            <input type="text" name="title" id="title" placeholder="No. of title">
            <button class="btn" id="Submit" name="Submit">Submit</button> 
        </form>
      </div>
</body>
</html>
