<?php
if(isset($_POST['submit'])){
    $servername = "localhost";
    $user = "root";
    $pass = "";
    $db="football";

// Create connection
$con = mysqli_connect($servername, $user, $pass,$db);
    $username=$_POST['username'];
    $password=$_POST['password'];
    $sql="select * from users where username='$username' and password='$password' ";
    $res=mysqli_query($con,$sql);
    $count=mysqli_num_rows($res);
if($count>0){
   $_SESSION['ADMIN_LOGIN']='yes';
   $_SESSION['ADMIN_USERNAME']='$username';
   header('Location:Home.php');
   die();
}else{
   $msg="username or password is incorrect";
}
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
<style type="text/css">
    body {
    margin: 0;
    padding: 0;
    font-family: sans-serif;
    background: url() no-repeat;
    background-size: cover;
}
.formu{
    margin: 0;
    position: absolute;
    top: 43%;
    left: 50%;
    margin-right: -50%;
    transform: translate(-50%, -50%)
}
.form {
    margin: 0;
    position: absolute;
    top: 50%;
    left: 50%;
    margin-right: -50%;
    transform: translate(-50%, -50%)
	}

.form input{
		display: inline-block;
		text-align: left;
	}
.button{
    margin: 0;
    position: absolute;
    top: 58%;
    left: 50%;
    margin-right: -50%;
    color: white;
  background: black;
  padding: 6px 10px;
  font-size: 20px;
  border: 2px solid white;
  border-radius: 14px;
  cursor: pointer;
    transform: translate(-50%, -50%)
}

</style>
<body>

    <img class="bg" src="bg.jpg" alt="UEFA">
    <div class="bgimg">
        <img class="img" src="logo2.png" alt="logo" height="100px">
    </div>
         <form method="post">
         <div class="formu">
            <input type="text" name="username" id="username" placeholder="Enter username">
         </div>
        <div class="form">
            <i class="fa fa-user" aria-hidden="true"></i>
            <input type="password" name="password" id="password" placeholder="Enter password">
        </div class = "form">
            
            <button class="button" name="submit" id="submit">Sign in</button> 
        </form>

      </div>
</body>
</html>
