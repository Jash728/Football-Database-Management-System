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

    .container p {
        text-align: center;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        font-size: 30px;
        color: white;
    }

    .navbar {
        overflow: hidden;
        /* Hide overflow */
        background-color: transparent;
        /* Dark background color */
        font-family: sans-serif;
        font-weight: bold;
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

    .addteam {
        background-image: url("./images/fallback.jpg");
        color: white;
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

        <form action="add_player.php" method="post">
            <input type="number" name="Player_ID" id="Player_ID" placeholder="Player ID">
            <input type="text" name="Name" id="Name" placeholder="Name">
            <input type="number" name="Team_ID" id="Team_ID" placeholder="Team ID">
            <select id="Team_Name" name="Team_Name" style="margin:10px;">
                <option disabled selected>-- Select Team Name --</option>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $db = "football";

                // Create connection
                $con = mysqli_connect($servername, $username, $password, $db);
                // Using database connection file here
                $records = mysqli_query($con, "SELECT DISTINCT Team_Name From player_profile");  // Use select query here 

                while ($data = mysqli_fetch_array($records)) {
                    echo "<option value='" . $data['Team_Name'] . "'>" . $data['Team_Name'] . "</option>";  // displaying data in option menu
                }
                ?>
            </select>
            <input type="year" name="Position" id="Position" placeholder="Position">
            <input type="text" name="Country" id="Country" placeholder="Country">
            <input type="number" name="Jersey" id="Jersey" placeholder="Jersey">
            <input type="number" name="Physical" id="Physical" placeholder="Physical">
            <input type="number" name="Shooting" id="Shooting" placeholder="Shooting">
            <input type="number" name="Pace" id="Pace" placeholder="Pace">
            <input type="number" name="Dribbling" id="Dribbling" placeholder="Dribbling">
            <input type="number" name="Passing" id="Passing" placeholder="Passing">
            <input type="number" name="Defending" id="Defending" placeholder="Defending">

            <button class="btn" id="Submit" name="Submit" style="background-image: url(fallback.jpg);">Submit</button>
        </form>
    </div>
    <div class="addteam">
        <?php
        if (isset($_POST['Submit'])) {
            // Set connection variables
            $servername = "localhost";
            $username = "root";
            $password = "";
            $db = "football";

            // Create connection
            $con = mysqli_connect($servername, $username, $password, $db);

            // Check for connection success
            if (!$con) {
                die("connection to this database failed due to" . mysqli_connect_error());
            }
            // echo "Success connecting to the db";

            // Collect post variables
            $Team_ID = $_POST['Team_ID'];
            $Team_Name = $_POST['Team_Name'];
            $Player_ID = $_POST['Player_ID'];
            $Name = $_POST['Name'];
            $Position = $_POST['Position'];
            $Jersey = $_POST['Jersey'];
            $Country = $_POST['Country'];
            $Physical = $_POST['Physical'];
            $Shooting = $_POST['Shooting'];
            $Pace = $_POST['Pace'];
            $Dribbling = $_POST['Dribbling'];
            $Passing = $_POST['Passing'];
            $Defending = $_POST['Defending'];


            $sql = "INSERT INTO `player` (`Player_ID`,`Team_ID`,`Name`, `Physical`, `Shooting`, `Pace`,`Dribbling`,`Passing`,`Defending`) VALUES ($Player_ID,$Team_ID,'$Name', $Physical, $Shooting, $Pace,$Dribbling,$Passing,$Defending);";
            //echo $sql;
            $sql2 = "INSERT  INTO `player_profile` (`Player_ID`,`Team_ID`,`Name`, `Position`, `Jersey`, `Team_Name`,`Country`) VALUES ($Player_ID,$Team_ID,'$Name', '$Position', $Jersey,'$Team_Name','$Country');";
            // Execute the query
            mysqli_query($con, $sql);
            mysqli_query($con, $sql2);
            if ($con->query($sql) == true) {
                // echo "Successfully inserted";

                // Flag for successful insertion
                $insert = true;
            } else {
                echo "<script>alert('ERROR: $con->error');</script>";
            }
            if ($con->query($sql2) == true) {
                // echo "Successfully inserted";

                // Flag for successful insertion
                $insert = true;
            } else {
                echo "<script>alert('ERROR: $con->error');</script>";
            }
        }
        ?>
    </div>
</body>

</html>