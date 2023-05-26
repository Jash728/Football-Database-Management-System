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
  .league_stand{
    color: white;
    text-align: center;
    font-family: Verdana, Geneva, Tahoma, sans-serif;
    
  }
  /* td {
           
            border: 1px solid blak;
        }
   */
        th,
        td {
            font-weight: bold;
            border: 0.5px solid white;
            padding: 5px;
            text-align: center;
        }
  
        td {
            font-weight: lighter;
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
    <div class="league_stand">
    <section >
        <!-- <h1>League Standing</h1> -->
        <!-- TABLE CONSTRUCTION-->
        <table>
            <tr>
                <th>Team Name</th>
                <th>Title</th>
      
            </tr>
            <!-- PHP CODE TO FETCH DATA FROM ROWS-->
            <?php   // LOOP TILL END OF DATA 
            $servername = "localhost";
            $username = "root";
            $password = "";
            $db="football";
            
            // Create connection
            $con = mysqli_connect($servername, $username, $password,$db);
            $sql="select * from team_info";
            $result = mysqli_query($con,$sql);
                while($rows=$result->fetch_assoc())
                {
             ?>
            <tr>
                <!--FETCHING DATA FROM EACH 
                    ROW OF EVERY COLUMN-->
                <td><?php echo $rows['Team_Name'];?></td>
                <td><?php echo $rows['title'];?></td>
                
            </tr>
            <?php
                }
             ?>
        </table>
    </section>
    </div>
      <div class="button" >
      
        <form action="teamdetails.php" method="post" style="margin-left: 500px; margin-right: 30px; text-align: center;   float: left">
            <button class="add">Team details</button> 
        </form>
        <form action="Add_Team.php" method="post" style="margin-right: 30px; text-align: center; float: left">
            <button class="add">Add team</button> 
        </form>
        <form action="delete_team.php" method="post" style="margin-right: 30px; text-align: center; float: left">
            <button class="add">Delete team</button> 
        </form>
       
      </div>
</body>
</html>