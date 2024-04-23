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

	<body class="default-background">

    <h1>Let's Get You Started</h1>

	    <div class="container">
	        <div class="register-box">


                <form method="POST" action="register1p.php" enctype="multipart/form-data">

                            <h2>Part 1: Profile Setup</h2>
                            <label class="custom-file-upload">Profile Picture</label>
                            <input type="file" name="image">
                            <br><br>

                            <label>Username</label>
                            <input type="text" name="username" placeholder="notify333" maxlength="12" required autofocus>
                            <br><br>

                            <label>Name</label>
                            <input type='text' name='Name' placeholder="Kathyrene Smith" maxlength="25" required>
                            <br><br>

                            <label>Password</label>
                            <input type="password" name="ep" placeholder="*********" id="password" required>
                            <br><br>

                            <label>Confirm Password</label>
                            <input type="password" name="c_ep" placeholder="**********" id="password" required>
                            <br><br>

            </div>
        </div>

        <div class="after-container">
	        <div class="register-box">

                <h2>Part 2: Keep Your Profile Secured</h2>
                    <label class="checkbox-container">
                        <input type="checkbox" id="myCheckbox" name='InfoSaved' value='1'>
                        <span class="checkmark"></span>
                        Keep Info Saved?
                    </label>
                    <br><br>

						<label for="squestion">Security Question</label>
						<select type="text" name="squestion" class="input" id="squestion">
                            <option value="1">What's your mother's name?</option>
							<option value="2">What's your favourite subject?</option>
							<option value="3">What's your first pet?</option>
						</select>
                        <br><br>

						<label for="sanswer">Security Answer</label>
						<input type="text" name="sanswer" class="input" placeholder="Restore your account with this question. It is case sensetive." id="sanswer">
                        <br><br>

            </div>
        </div>

        <div class="after-container">
	        <div class="register-box">

                        <h2>Part 3: Customise the Experience</h2>
                        <label>Cover Photo</label>
                        <input type="file" name="coverphoto">
                        <br><br>

                            <label>Header Font</label>
                            <select type="text" name="font" class="input" id="font">
                                <option value="Comfortaa" style="font-family: 'Comfortaa'">Comfortaa (Default)</option>
                                <option value="DM Serif Display" style="font-family: 'DM Serif Display'">DM Serif Display</option>
                                <option value="Dancing Script" style="font-family: 'Dancing Script'">Dancing Script</option>
                                <option value="DM Sans" style="font-family: 'DM Sans'">DM Sans</option>
                                <option value="Cardo" style="font-family: 'Cardo'">Cardo</option>
						    </select>
                            <br><br>

                            <div class="color-container">
                            <label>Accent Colour (Use Darker Colour)</label>
                            <input class="style1" type="color" name="accent1" value="#000000">
                            </div>
                            <br><br>

                            <div class="color-container">
                            <label>Background Colour (Use Lighter Colour)</label>
                            <input class="style1" type="color" name="accent2" value="#f5f5f5">
                            </div>
                            <br><br>

            </div>
        </div>

        <div class="after-container">
		            <button type="submit">Let's go</button><br><br>
	            </form>
        </div>
    </div>
        <?php //include 'footer.php';?>
    </body>
</html>

<style>

		.container {
			display: flex;
			justify-content: center;
			align-items: center;
			margin-top: 3%;
		}

        .after-container {
			display: flex;
			justify-content: center;
			align-items: center;
			margin-top: 2%;
		}

		.register-box {
			background-color: rgba(255, 255, 255, 0.5); 
			padding: 50px;
            padding-top: 20px;
            padding-bottom: 20px;
			border-radius: 25px;
			width: 500px;
		}

		h1 {
			text-align: center;
			margin-bottom: 20px;
			font-size: 30px;
			font-weight: bold;
            margin-top: 7%;
		}

		label {
			display: block;
			margin-bottom: 5px;
			font-weight: bold;
		}

		input[type="text"],
		input[type="password"]{
			width: 100%;
			padding: 10px;
			margin-bottom: 10px;
			border: 0px;
			border-radius: 25px;
		}

		button{
			width: 500px;
			padding: 10px;
            margin: 10px;
			background-color: #000;
			color: #fff;
			border: none;
			border-radius: 25px;
			cursor: pointer;
			font-weight: bold;
            margin-bottom: 7%;
		}

        select{
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 0px;
            border-radius: 25px;
        }

        /*------ Style 1 ------*/
.style1 {
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  width: 101%;
  height: 45px;
  background-color: transparent;
  border: none;
  cursor: pointer;
}
.style1::-webkit-color-swatch {
  border-radius: 25px;
  border: none;
}
.style1::-moz-color-swatch {
  border-radius: 25px;
  border: none;
}

.color-container {
  display: flex;
  flex-direction: column;
}

.checkbox-container {
    display: inline-block;
    position: relative;
    padding-left: 25px;
    cursor: pointer;
}

.checkbox-container input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}

.checkmark {
    position: absolute;
    top: 0;
    left: 0;
    height: 20px;
    width: 20px;
    background-color: #fff;
    border-radius: 5px;
}

.checkbox-container:hover input ~ .checkmark {
    background-color: #ccc;
}

.checkbox-container input:checked ~ .checkmark {
    background-color: #000;
}

.checkmark:after {
    content: "";
    position: absolute;
    display: none;
}

.checkbox-container input:checked ~ .checkmark:after {
    display: block;
}

.checkbox-container .checkmark:after {
    left: 6px;
    width: 6px;
    height: 12px;
    border: solid white;
    border-width: 0 3px 3px 0;
    transform: rotate(45deg);
}

</style>