<?php
//Required to connect database
require 'connection.php';
?>

<html>
	<head>
	<title>notaaa</title>
        <link rel="icon" href="image/icon.png" type="image/png">
		<link rel="stylesheet" href="style.css">
</head>
    <?php //include 'header.php' ?>

    <body class="default-background">
    <div class="container">
        <div class="login-box">
    <h1>Login</h1>
        <!--action will proceed to loginprocess.php for extra processing-->
        <form id="login" action="loginprocess.php" method="post">
        <label>Username</label>
        <input type="text" name="username" placeholder="notify333" size="25" required autofocus>
        <br><br>
        <label>Password</label>
        <input type="password" name="password" placeholder="*********" size="25" required>
        <br><br>
        <button type="submit">Login</button>
		<a class="signup-link" href="forgotpassword.php">Forgot password?</a>
</form>
</div>
</div>
	
</body>
<?php //include 'footer.php'?>
</html>

<style>

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

		.signup-link {
		display: block;
		text-align: center;
		margin-top: 5%;
		color: #000000;
		text-decoration: none;
	    }

		.signup-link:hover {
			text-decoration: underline;
		}
		
	</style>