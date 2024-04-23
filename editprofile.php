<?php
//Required to connect database
require 'connection.php';
require 'session.php';
include 'header2.php';

$user=$_SESSION["username"];
$UserData=mysqli_query($conn, "SELECT u.*, c.*, s.* FROM user u, acccustomise c, accsecurity s WHERE u.username=c.username AND u.username=s.username AND u.username='$user'");
$GetUser=mysqli_fetch_array($UserData);

// Array of dropdown options
$options = ['Comfortaa', 'DM Serif Display', 'Dancing Script', 'DM Sans', 'Cardo']; // Replace with your actual options
$newimageName = $GetUser['userpfp'];
$font = $GetUser['HeadFont'];
$coverphoto = $GetUser['CoverPhoto'];

if (isset($_POST['update'])){
    if (isset($_FILES['new_image']) && $_FILES['new_image']['error'] === 0) {
        $newimage = $_FILES['new_image']['tmp_name']; // Temporary path of the uploaded image
        $newimageName = $_FILES['new_image']['name']; // Original name of the uploaded image

        $uniqueID = uniqid();
        $newimageName = $uniqueID . '_' . $newimageName;

        $destination = 'image/userpfp/' . $newimageName;
        move_uploaded_file($newimage, $destination);

    }

    if (isset($_FILES['new_coverphoto']) && $_FILES['new_coverphoto']['error'] === 0) {
        $newcover = $_FILES['new_coverphoto']['tmp_name']; // Temporary path of the uploaded image
        $newcoverName = $_FILES['new_coverphoto']['name']; // Original name of the uploaded image

        $uniqueID = uniqid();
        $newcoverName = $uniqueID . '_' . $newcoverName;

        $destination = 'image/cover/' . $newcoverName;
        move_uploaded_file($newcover, $destination);

        $coverphoto = $destination;

    }

    $newname = $_POST['Name'];
    $newInfoSaved = isset($_POST['InfoSaved']) ? $_POST['InfoSaved'] : 0; // Set to 0 if not checked, assuming 0 means "not saved"
    $newHeaderFont = $_POST['font'];
    $newAccent1 = $_POST['accent1'];
    $newAccent2 = $_POST['accent2'];

    $result1 = mysqli_query($conn, "UPDATE user SET userpfp='$newimageName', name='$newname' WHERE username='$user'");
    $result2 = mysqli_query($conn, "UPDATE accsecurity SET InfoSaved='$newInfoSaved' WHERE username='$user'");
    $result3 = mysqli_query($conn, "UPDATE acccustomise SET CoverPhoto='$coverphoto', HeadFont='$newHeaderFont', 
    AccentColour1='$newAccent1', AccentColour2='$newAccent2' WHERE username='$user'");

    if ($result1 && $result2 && $result3) {
        header("Location: profilemoddone.php");
    } else {
        header("Location: error.php");
    }
}
?>



<style>
    body{
        margin: 0;
        background-color: <?php echo $GetUser['AccentColour2']; ?>;
    }

    .user{
        font-family: <?php echo $font;?>;
    }

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
			background-color: <?php echo $GetUser['AccentColour1']; ?>;
			color: #fff;
			border: none;
			border-radius: 25px;
			cursor: pointer;
			font-weight: bold;
            margin-bottom: 7%;
            font-family: <?php echo $font;?>;
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
    background-color: <?php echo $GetUser['AccentColour1']; ?>;
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
<html>
    <head>
        <title>notaaa</title>
        <link rel="icon" href="image/icon.png" type="image/png">
        <link rel="stylesheet" href="style.css">
    </head>

	<body>

    <h1 class="user">Edit Profile</h1>

	    <div class="container">
	        <div class="register-box">


                <form method="POST" action="" enctype="multipart/form-data">

                            <h2 class="user">Profile</h2>
                            <label class="custom-file-upload">Profile Picture</label>
                            <input type="file" name="new_image">
                            <br><br>

                            <label>Name</label>
                            <input type='text' name='Name' placeholder="Kathyrene Smith" maxlength="25" value="<?php echo $GetUser['name']; ?>" required>
                            <br><br>

                            <label class="checkbox-container">
                                <input type="checkbox" id="myCheckbox" name='InfoSaved' value="1" <?php if($GetUser['InfoSaved'] == 1) echo 'checked'; ?>>
                                <span class="checkmark"></span>
                                Keep Info Saved?
                            </label>
                            <br><br>
            </div>
        </div>

        <div class="after-container">
	        <div class="register-box">

                        <h2 class="user">Experience Customisation</h2>
                        <label>Cover Photo</label>
                        <input type="file" name="new_coverphoto">
                        <br><br>

                            <label>Header Font</label>
                            <select name="font">
                                <?php
                                foreach ($options as $option) {
                                    $selected = ($option == $GetUser['HeadFont']) ? 'selected' : '';
                                    echo "<option value='$option' style=\"font-family:'$option'\" $selected>$option</option>";
                                }
                                ?>
                            </select>
                            <br><br>

                            <div class="color-container">
                            <label>Accent Colour (Use Darker Colour)</label>
                            <input class="style1" type="color" name="accent1" value="<?php echo $GetUser['AccentColour1']; ?>">
                            </div>
                            <br><br>

                            <div class="color-container">
                            <label>Background Colour (Use Lighter Colour)</label>
                            <input class="style1" type="color" name="accent2" value="<?php echo $GetUser['AccentColour2']; ?>">
                            </div>
                            <br><br>

            </div>
        </div>

        <div class="after-container">
		            <button type="submit" name="update">Update</button>
	            </form>
        </div>
    </div>
        <?php //include 'footer.php';?>
    </body>
</html>