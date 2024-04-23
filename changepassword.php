<?php
//Required to connect database
require 'connection.php';
//Required to ensure session is running
require 'session.php';
//include allows to seperate and manage html remotely
//include 'header2.php';
?>

<html lang="en">
    <head>
		<title>notaaa</title>
        <link rel="icon" href="image/icon.png" type="image/png">
        <link rel="stylesheet" href="style.css">
    </head>
    <body class="default-background">
        <section class="password">
            <div class="container">

                <form  action="changepassword.php" method="post">

                    <h1>Change Password</h1>   

                    <div>
                        <label for="nPassword">New Password</label>
                        <input type="password" name="np" placeholder="*********">
                        <br><br>
                    </div>
                    
                    <div>
                        <label for="nPassword">Confirm New Password</label>
                        <input type="password" name="c_np" placeholder="*********">
                        <br><br>
                    </div>
                    
                    <div class="buttons">
                        <div>
                            <button type="submit" name="change">Change</button>
                        </div> 
                    </div>

                </form>

            </div>  
</section>

        <?php //include("footer.php"); ?>

    </body>
</html>

<?php

    //Get the session info
    $user = isset($_GET['username']) ? $_GET['username'] : '';
    $user = isset($_SESSION['username']) ? $_SESSION['username'] : '';    
	$UserData=mysqli_query($conn, "SELECT s.*, u.* FROM user u, accsecurity s WHERE u.username=s.username AND u.username='$user'");
	$GetUser=mysqli_fetch_array($UserData);

	//Check if all info are entered
	if(isset($_POST['change'])){
		if(isset($_POST['np'])){
			if(empty($_POST['np'])){
				echo "<script>alert('Please enter the new password');
				window.location='password.php?username=$user'</script>";

			}else if(empty($_POST['c_np'])){
				echo "<script>alert('Please enter the confirm new password');
				window.location='password.php?username=$user'</script>";
			}
				else{
				$np = $_POST['np'];
				$c_np = $_POST['c_np'];

				//check if new password is the same as confirm new password
                if($np != $c_np){
					echo "<script>alert('Confirm New Password must be the same as New Password');
					window.location='password.php?username=$user'</script>";

				}else{

					$NewPassword = password_hash($_POST['np'], PASSWORD_DEFAULT);

					$result = mysqli_query($conn, "UPDATE accsecurity SET password='$NewPassword' WHERE username='$user'");

					echo "<script>alert('Password change is Successful. You will be logged out of the account. Please relogin to continue.');
					window.location='logout.php'</script>";
				}
			}
		}				
	}

?>

<style>
		.password {
			display: flex;
			justify-content: center;
			align-items: center;
			min-height: 98vh;
		}

		.container {
			background-color: rgba(255, 255, 255, 0.5); 
			padding: 50px;
			border-radius: 25px;
			width: 500px;
		}

		h1 {
			text-align: center;
			margin-bottom: 20px;
			font-size: 30px;
			font-weight: bold;
		}

		form label {
			display: block;
			margin-bottom: 5px;
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

		button {
			width: 100%;
			padding: 10px;
			background-color: #000;
			color: #fff;
			border: none;
			border-radius: 25px;
			cursor: pointer;
			font-weight: bold;
		}
		
	</style>