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
    <h1>Forgotten Password</h1>
    <p>If you've forgotten your password, enter your username and select the security question you've chosen and answer it. <b>It is case sensitive.</b></p> 
        <!--action will proceed to loginprocess.php for extra processing-->
        <form id="login" action="forgotpassword.php" method="post">
        <label>Username</label>
        <input type="text" name="username" placeholder="Notify333" size="25" required autofocus>
        <br><br>
        <label>Security Question</label>
        <select type="text" name="squestion" class="input" id="squestion">
							<option value="1">What's your mother's name?</option>
							<option value="2">What's your favourite subject?</option>
							<option value="3">What's your first pet?</option>
						</select>
        <br><br>

        <label for="sanswer">Security Answer</label>
						<input type="text" name="sanswer" placeholder="Answer the question you've selected. It is case sensitive." class="input" id="sanswer">
                        <br><br>

        <button type="submit">Verify</button>
</form>
</div>
</div>
	
</body>
<?php //include 'footer.php'?>
</html>

<?php


if (isset($_POST['username'])) {

    session_start();

    $user = $_POST['username'];
	$squestion = $_POST['squestion'];
	$sanswer = $_POST['sanswer'];

    $query = mysqli_query($conn, "SELECT * FROM accsecurity WHERE username='$user' AND SQuestion1='$squestion' AND SAnswer1='$sanswer'");
    //Fetches results from SQL
    $rows = mysqli_fetch_assoc($query);

    if (mysqli_num_rows($query) == 0) {
        //if it doesn't exist it will show a pop up to indicate and return to login.php
        header("Location:error.php");
    } else {
        $_SESSION['username'] = $rows['username'];
        $user = $_SESSION['username'];
        header("Location:changepassword.php?username=$user");
        exit(); // Exit after redirecting to prevent further execution
    }

}
	?>

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

p{
    text-align: center;
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

select{
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