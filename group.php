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
  .groupa{
      color: white;
  }
  th,
        td {
            font-weight: bold;
            border: 1px solid white;
            padding: 8px;
            text-align: center;
        }
  
        td {
            font-weight: lighter;
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
      <section class="groupa">
        <!-- <h1>League Standing</h1> -->
        <!-- TABLE CONSTRUCTION-->
        <h1>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp &nbsp &nbsp &nbsp Group A &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Group B</h1>

        <table style="width:50%; float:left">
            <tr>
                <th>Team ID</th>
                <th>Team name</th>
            </tr>
            <!-- PHP CODE TO FETCH DATA FROM ROWS-->
            <?php   // LOOP TILL END OF DATA 
            $servername = "localhost";
            $username = "root";
            $password = "";
            $db="football";
            
            // Create connection
            $con = mysqli_connect($servername, $username, $password,$db);
            $sql="SELECT * from group_a;";
            $result = mysqli_query($con,$sql);
                while($rows=$result->fetch_assoc())
                {
             ?>
            <tr>
                <!--FETCHING DATA FROM EACH 
                    ROW OF EVERY COLUMN-->
                <td><?php echo $rows['Team_ID'];?></td>
                <td><?php echo $rows['Team_Name'];?></td>
            </tr>
            <?php
                }
             ?>
        </table>
        
        <table style="width:50%; float:left">
            <tr>
                <th>Team ID</th>
                <th>Team name</th>
            </tr>
            <!-- PHP CODE TO FETCH DATA FROM ROWS-->
            <?php   // LOOP TILL END OF DATA 
            $servername = "localhost";
            $username = "root";
            $password = "";
            $db="football";
            
            // Create connection
            $con = mysqli_connect($servername, $username, $password,$db);
            $sql="SELECT * from group_b;";
            $result = mysqli_query($con,$sql);
                while($rows=$result->fetch_assoc())
                {
             ?>
            <tr>
                <!--FETCHING DATA FROM EACH 
                    ROW OF EVERY COLUMN-->
                <td><?php echo $rows['Team_ID'];?></td>
                <td><?php echo $rows['Team_Name'];?></td>
            </tr>
            <?php
                }
             ?>
        </table>
        <br>
    </section>
    <div class="gc">

    <section class="groupa">
    <h1>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp &nbsp &nbsp &nbsp Group C &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Group D</h1>
 
    <table style="width:50%; float:left">
            <tr>
                <th>Team ID</th>
                <th>Team name</th>
            </tr>
            <!-- PHP CODE TO FETCH DATA FROM ROWS-->
            <?php   // LOOP TILL END OF DATA 
            $servername = "localhost";
            $username = "root";
            $password = "";
            $db="football";
            
            // Create connection
            $con = mysqli_connect($servername, $username, $password,$db);
            $sql="SELECT * from group_c;";
            $result = mysqli_query($con,$sql);
                while($rows=$result->fetch_assoc())
                {
             ?>
            <tr>
                <!--FETCHING DATA FROM EACH 
                    ROW OF EVERY COLUMN-->
                <td><?php echo $rows['Team_ID'];?></td>
                <td><?php echo $rows['Team_Name'];?></td>
            </tr>
            <?php
                }
             ?>
        </table>
        <table style="width:50%; float:left">
            <tr>
                <th>Team ID</th>
                <th>Team name</th>
            </tr>
            <!-- PHP CODE TO FETCH DATA FROM ROWS-->
            <?php   // LOOP TILL END OF DATA 
            $servername = "localhost";
            $username = "root";
            $password = "";
            $db="football";
            
            // Create connection
            $con = mysqli_connect($servername, $username, $password,$db);
            $sql="SELECT * from group_d;";
            $result = mysqli_query($con,$sql);
                while($rows=$result->fetch_assoc())
                {
             ?>
            <tr>
                <!--FETCHING DATA FROM EACH 
                    ROW OF EVERY COLUMN-->
                <td><?php echo $rows['Team_ID'];?></td>
                <td><?php echo $rows['Team_Name'];?></td>
            </tr>
            <?php
                }
             ?>
        </table>
    </section>

    </div>
</body>
</html>