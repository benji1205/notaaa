<?php
//Required to connect database
require 'connection.php';
//Required to ensure session is running
require 'session.php';
//include allows us to seperate and manage html remotely
include 'header2.php';

$user = $_SESSION['username'];

$sql = "SELECT u.*, c.* FROM user u, acccustomise c WHERE u.username=c.username AND u.username='$user'";
$query = mysqli_query($conn, $sql);
$GetData=mysqli_fetch_array($query);

$coverimage = $GetData['CoverPhoto'];
$font = $GetData['HeadFont'];
$accent1 = $GetData['AccentColour1'];
$accent2 = $GetData['AccentColour2'];

if (isset($_POST['Name'])){

    $NoteTitle=$_POST['Name'];
    $NoteFont=$_POST['Font'];
    $PageColour=$_POST['PageColour'];
    $Tag1=$_POST['Tag1'];
    $Tag2=$_POST['Tag2'];

    $uniqueID = uniqid();
    $filename = 'notes/'.$user.'_'.$uniqueID.'.json';

    fopen($filename,'w');

    $sql = "INSERT INTO note (username, NoteTitle, Content, NoteHeadFont, NoteAccentColour, Tag1, Tag2)
    VALUES ('$user', '$NoteTitle', '$filename', '$NoteFont', '$PageColour', '$Tag1', '$Tag2')";
    $result1 = mysqli_query($conn, $sql);

    if(!$result1){
        header ("Location: error.php");
    } else {
        $sql2 = mysqli_query($conn, "SELECT NoteID FROM note WHERE Content='$filename'");
        $GetData = mysqli_fetch_array($sql2);

        $NoteID=$GetData['NoteID'];

        header ("Location: note.php?NoteID=$NoteID");
    }

}

?>

<html>
    <head>
    <title>notaaa</title>
        <link rel="icon" href="image/icon.png" type="image/png">
        <link rel="stylesheet" href="style.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300..700&display=swap" rel="stylesheet">

    </head>
    <body>
        <div class="cover-container">
            <img class="cover" src="<?php echo $coverimage;?>"/>
        </div>
        <div class="main-container">
        <table width="100%">
        <tr>
            <td width="80%"><h1 class="user">Create New Note</h1></td>
        </tr>
        </table>
        

        <div class="container">
	        <div class="register-box">
                <form method="POST" action="" enctype="multipart/form-data">
                    <label>Note Title</label>
                    <input type='text' name='Name' placeholder="My New Note" maxlength="25"  required>
                    <br><br>

                    <label>Filter 1</label>
                    <input type='text' name='Tag1' placeholder="Sort your work. Example: Homework, Meetings, List (Optional)" maxlength="25">
                    <br><br>

                    <label>Filter 2</label>
                    <input type='text' name='Tag2' placeholder="Sort your work. (Optional)" maxlength="25">
                    <br><br>

                    <label>Font</label>
                        <select type="text" name="Font" class="input" id="font">
                            <option value="Comfortaa" style="font-family: 'Comfortaa'">Comfortaa (Default)</option>
                            <option value="DM Serif Display" style="font-family: 'DM Serif Display'">DM Serif Display</option>
                            <option value="Dancing Script" style="font-family: 'Dancing Script'">Dancing Script</option>
                            <option value="DM Sans" style="font-family: 'DM Sans'">DM Sans</option>
                            <option value="Cardo" style="font-family: 'Cardo'">Cardo</option>
						</select>
                    <br><br>

                    <div class="color-container">
                        <label>Page Colour</label>
                        <input class="style1" type="color" name="PageColour" value="#FFFFFF">
                        </div>
                    <br><br>

		            <button type="submit">Create Note</button><br><br>
	            </form>
        </div>
        </div>
        <style>

    .user{
        font-family: <?php echo $font;?>;
    }

    body {
        margin: 0;
        padding: 0;
        background-color: <?php echo $accent2;?>;
    }

    button{
            width: 100%;
			padding: 10px;
			background-color: <?php echo $accent1;?>;
			color: #fff;
			border: none;
			border-radius: 25px;
			cursor: pointer;
			font-weight: bold;
            font-family: <?php echo $font;?>;
            margin-bottom: 5%;
		}

    .cover-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
        width: 100%; 
    }

    .cover{
        background-color: rgba(255, 255, 255, 0.7);
        width: 100%;
        height: 250px;
        object-fit: cover;
    }

    .main-container {
        margin-left: 10%;
        margin-right: 10%;
        margin-top: 2%;

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

        select{
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 0px;
            border-radius: 25px;
        }

        .style1 {
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  width: 100%;
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
