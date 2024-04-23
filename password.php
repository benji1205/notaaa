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

	//Check if all info are entered
	if(isset($_POST['change'])){
		if(isset($_POST['op']) && isset($_POST['np'])){
			if(empty($_POST['op'])){
				echo "<script>alert('Please enter the current password');
				window.location='password.php?UserID=$user'</script>";

			}else if(empty($_POST['np'])){
				echo "<script>alert('Please enter the new password');
				window.location='password.php?UserID=$user'</script>";

			}else if(empty($_POST['c_np'])){
				echo "<script>alert('Please enter the confirm new password');
				window.location='password.php?UserID=$user'</script>";
			
			}else{
				$op = $_POST['op'];
				$np = $_POST['np'];
				$c_np = $_POST['c_np'];
				
				$getcode=$GetUser['password'];
				$verify = password_verify($op, $getcode);

				//check if current password matches the database
				if(!$verify){
					echo "<script>alert('Current Password entered is incorrect');
					window.location='password.php?UserID=$UserID'</script>";

				//check if new password is the same as confirm new password
				}else if($np != $c_np){
					echo "<script>alert('Confirm New Password must be the same as New Password');
					window.location='password.php?UserID=$UserID'</script>";

				}else{

					$NewPassword = password_hash($_POST['np'], PASSWORD_DEFAULT);

					$result = mysqli_query($conn, "UPDATE accsecurity SET password='$NewPassword' WHERE username='$user'");

					header ("Location:profilemoddone.php");
				}
			}
		}				
	}
    ?>

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>notaaa</title>
        <link rel="icon" href="image/icon.png" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container">
        <div class="login-box">

            <form action="password.php" method="post">
                
                <h1>Change Password</h1>

                <div>
                    <label for="cPassword">Current Password</label>
                    <input type="password" name="op" placeholder="Current Password">
                    <br><br>
                </div>
                

                <div>
                    <label for="nPassword">New Password</label>
                    <input type="password" name="np" placeholder="New Password">
                    <br><br>
                </div>
                
                <div>
                    <label for="nPassword">Confirm New Password</label>
                    <input type="password" name="c_np" placeholder="Confirm New Password">
                    <br><br>
                </div>
                
                <div class="buttons">
                    <div>
                        <button type="submit" name="change">Change</button>
                    </div> 
                </div>
            </form>
        </div>  
</div>
</body>
</html>

<style>
    
    body{
        background-color: <?php echo $GetUser['AccentColour2'];?>;
    }

    .container {
			display: flex;
			justify-content: center;
			align-items: center;
			min-height: 98vh;
		}

		.login-box {
			background-color: rgba(255, 255, 255, 0.5); 
			padding: 50px;
			border-radius: 25px;
			width: 500px;
		}
    
    form label {
			display: block;
			margin-bottom: 5px;
			font-weight: bold;
		}

		h1 {
			text-align: center;
			margin-bottom: 20px;
			font-size: 30px;
			font-weight: bold;
			font-family: <?php echo $GetUser['HeadFont'];?>;
		}

    button {
			width: 100%;
			padding: 10px;
			background-color: <?php echo $GetUser['AccentColour1'];?>;
			color: #fff;
			border: none;
			border-radius: 25px;
			cursor: pointer;
			font-weight: bold;
		}

        form input[type="text"],
		form input[type="password"] {
			width: 100%;
			padding: 10px;
			margin-bottom: 10px;
			border: 0px;
			border-radius: 25px;
		}

</style>

