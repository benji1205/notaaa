<?php
require 'connection.php';
require 'session.php';

$user=$_SESSION["username"];
$UserData=mysqli_query($conn, "SELECT u.*, c.*, s.* FROM user u, acccustomise c, accsecurity s WHERE u.username=c.username AND u.username=s.username AND u.username='$user'");
$GetUser=mysqli_fetch_array($UserData);

?>

<html>
    <head>
    <title>notaaa</title>
        <link rel="icon" href="image/icon.png" type="image/png">
        <link rel="stylesheet" href="style.css">
    </head>


    <body>
        <center>
            <h1 class="user">Profile Modifications Successful!</h1>
            <p>We're almost done updating your changes! You will be logged out of the account. Please relogin to continue.</p>
            <br>
            <a href="logout.php"><button class="action">Restart</button></a>
        </center>
    </body>
</html>

<style>

    .user{
        font-family: <?php echo $GetUser['HeadFont'];?>;
    }

    body{
        background-color: <?php echo $GetUser['AccentColour2'];?>;
    }
        center{
            justify-content:center;
            padding-top:10%;
        }

    .action{
        width: 25%;
        padding: 10px;
        background-color: <?php echo $GetUser['AccentColour1'];?>;
        color: #fff;
        border: none;
        border-radius: 25px;
        cursor: pointer;
        font-family: <?php echo $GetUser['HeadFont'];?>;
        font-weight: bold;
    }

    </style>