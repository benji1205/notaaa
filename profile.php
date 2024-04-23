<?php
//Required to connect database
require 'connection.php';
//Required to ensure session is running
require 'session.php';
//include allows us to seperate and manage html remotely
include 'header2.php';

$user=$_SESSION["username"];
$UserData=mysqli_query($conn, "SELECT u.*, c.*, s.* FROM user u, acccustomise c, accsecurity s WHERE u.username=c.username AND u.username=s.username AND u.username='$user'");
$GetUser=mysqli_fetch_array($UserData);

$CountNote=mysqli_query($conn, "SELECT COUNT(NoteID) AS NoNote FROM note WHERE username='$user'");
$GetCount=mysqli_fetch_array($CountNote);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>notaaa</title>
        <link rel="icon" href="image/icon.png" type="image/png">
</head>
<body>
    
<section class="profile">
    <div class="picture">
        <div id="head">
            <?php echo "<img src='image/userpfp/".$GetUser['userpfp']."'"?>
        </div>
        <div id="profileName">
            <h2 class="user"><?php echo $GetUser['name']?></h2>
        </div>
    </div>

    <div class="container">
        <div class="content1">
            <div class="user-details">
                <div class="info">
                    <span class="details">Username</span><br>
                        <div class="info-box">
                            <p><b><?php echo $GetUser['username']?></b></p>
                        </div>
                            <span class="details">No of Notes</span><br>
                            <div class="info-box">
                                <p><b><?php echo $GetCount['NoNote']?></b></p>
                            </div>
                        <div class="login-box">
                            <a href="editprofile.php?username=<?php echo $user; ?>"><button class="action">Edit Profile</button></a>
                            <a href="password.php?username=<?php echo $user; ?>"><button class="action">Change Password</button></a>
                        </div>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>

<style>
    body{
        margin: 0;
        background-color: <?php echo $GetUser['AccentColour2']; ?>;
    }

    .user{
        font-family: <?php echo $GetUser['HeadFont'];?>;
    }

    #head img{
        width: 200px;
        height: 200px;
        object-fit: cover;
        border-radius: 50%;
        border-radius: 250px;
    }

    p{
        font-size: 20px;
        margin: 10px;
        margin-left: 0;
    }

    .profile{
        display: flex;
        flex-direction: column;    
    }

    .profile .picture{
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        flex-direction: column;
        padding-top: 50px;
        padding-bottom: 20px;
    }

    .profile .picture #head{
        padding-bottom: 20px;
        display:flex;
        flex-direction: column;
        align-items: center;
        padding-top: 5%;
    }

    .profile .picture #profileName{
        padding-top:20px;
    }

    .container{
        width: 500px;
        border-radius: 20px;
        background-color: rgba(255, 255, 255, 0.5); 
        padding: 50px;
        margin-bottom: 5%;
    }

    .container .content3{
        display: flex;
        justify-content: flex-end;
        align-items:baseline;
    }
    
    button{
			width: 100%;
			padding: 10px;
            margin-bottom: 10px;
            margin-top: 10px;
			background-color: <?php echo $GetUser['AccentColour1'];?>;
			color: #fff;
			border: none;
			border-radius: 25px;
			cursor: pointer;
			font-weight: bold;
            font-family: <?php echo $GetUser['HeadFont'];?>;
		}
    
</style>
