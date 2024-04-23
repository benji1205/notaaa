<?php
//Required to connect database
require 'connection.php';
//include allows to seperate and manage html remotely
//include 'header2.php';
?>

<html>
    <head>
    <title>notaaa</title>
        <link rel="icon" href="image/icon.png" type="image/png">
        <link rel="stylesheet" href="style.css">
    </head>
    <body class="default-background">
        
        <center>
            <h1>notaaa</h1>
            <div class="profiles-container">
        <?php
        //verify saved accounts
        $sql = "SELECT SUM(InfoSaved) AS Info FROM accsecurity";
        $query = mysqli_query($conn, $sql);
        $acc = mysqli_fetch_assoc($query);

        if ($acc['Info'] >= 1){
            
            $sql2 = "SELECT s.*, u.* FROM user u, accsecurity s WHERE u.username=s.username AND s.InfoSaved=1";
            $query2 = mysqli_query($conn, $sql2);

            while ($rows = mysqli_fetch_assoc($query2)){

                $userpfp = $rows['userpfp'];
                $name = $rows['name'];
                $username = $rows['username'];
                $password= $rows['password'];?>
            
            <div class="profile">
                        <form id="login" action="loginprocess.php" method="post">
                            <button type="submit">
                                <input type="hidden" name="username" value="<?php echo $username; ?>" /> 
                                <img src="image/userpfp/<?php echo $userpfp;?>" alt="Profile Picture" class="head">
                                <div class="profile-name"><?php echo $name?></div>
                            </button>
                        </form>
                    </div>
            <?php 
            }
            ?>
            </div>

            <div class="login-box">
                <a href="login.php"><button class="action">Log In</button></a>
                <a href="register1.php"><button class="action">Sign Up</button></a>
            </div>
            <center>

        <?php 
        } else { 
            //when there's no saved accounts
        ?>
            <section id="main-login" class="section-p1">
                <div class="login-box">
                    <div class="profile-container">
                    <div class="profile">Get Ready to Note with Us!</div>
                        <a href="login.php"><button class="action">Log In</button></a>
                        <a href="register1.php"><button class="action">Sign Up</button></a>
                </div>
                </div>
            </section>
        <?php 
        } 
        
        //include("footer.php"); ?>

    </body>
</html>

<style>

.profiles-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
    }

    .profile {
        margin: 10px;
    }

    .profile button {
        background-color: transparent;
        border: none;
        cursor: pointer;
    }

    .profile button:hover .head {
        opacity: 0.9;
    }

    .profile .head {
        background-color: rgba(255, 255, 255, 0.7);
        border-radius: 50%;
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 250px;
    }

    .profile-name {
        padding-top: 10px;
        text-align: center;
        font-weight: bold;
    }

    .action{
    width: 300px;
	padding: 10px;
	background-color: #000;
	color: #fff;
	border: none;
	border-radius: 25px;
	cursor: pointer;
    font-weight: bold;
    }

    center{
        justify-content:center;
        padding-top:10%;
    }


</style>