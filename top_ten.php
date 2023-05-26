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

    /* .bgi{
  width: 100%;
  position: absolute;
  z-index: -1;
  background-size: cover;
  background: repeat-y;
}  */

    .container h1 {
        text-align: center;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        font-size: 40px;
        color: black;
    }

    .container p {
        text-align: center;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        font-size: 20px;
        color: black;
    }

    .navbar {
        overflow: hidden;
        /* Hide overflow */
        /* background-color: transparent ;  */
        /* Dark background color */
        font-family: sans-serif;
        font-weight: bold;
        background-image: url("./images/fallback.jpg");

    }

    /* Style the navigation bar links */
    .navbar a {
        float: left;
        /* Make sure that the links stay side-by-side */
        display: block;
        /* Change the display to block, for responsive reasons (see below) */
        color: white;
        /* White text color */
        text-align: center;
        /* Center the text */
        padding: 17px 50px;
        /* Add some padding */
        text-decoration: none;
        /* Remove underline */
    }

    .players {
        color: black;
    }
</style>

<body>
    <div class="bgimg">
        <img class="img" src="logo3.png" alt="logo" height="130px">
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
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "football";

    // Create connection
    $con = mysqli_connect($servername, $username, $password, $db);
    $sql = "CALL `top_ten`();";
    $result = mysqli_query($con, $sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo " <br> Name: " . $row["Name"] . " <br> &nbsp &nbsp  &nbsp- Physical: " . $row["Physical"] . "<br> &nbsp &nbsp  &nbsp- Shooting: " . $row["Shooting"] . "<br> &nbsp &nbsp  &nbsp- Pace: " . $row["Pace"] . "<br> &nbsp &nbsp  &nbsp- Dribbling: " . $row["Dribbling"] . "<br> &nbsp &nbsp  &nbsp- Passing: " . $row["Passing"] . "<br> &nbsp &nbsp  &nbsp- Defending: " . $row["Defending"] . "<br>";
        }
    } else {
        echo "0 results";
    }
    ?>
</body>

</html>