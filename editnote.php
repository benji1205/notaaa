<?php
//Required to connect database
require 'connection.php';
//Required to ensure session is running
require 'session.php';
//include allows us to seperate and manage html remotely
include 'header2.php';

$user = $_SESSION['username'];
$note = $_GET['NoteID'];

$sql = "SELECT u.*, c.* FROM user u, acccustomise c WHERE u.username=c.username AND u.username='$user'";
$query = mysqli_query($conn, $sql);
$GetData=mysqli_fetch_array($query);

$sql = "SELECT * FROM note WHERE NoteID='$note' AND username='$user'";
$query = mysqli_query($conn, $sql);
$GetNote=mysqli_fetch_array($query);

$coverimage = $GetData['CoverPhoto'];
$font = $GetData['HeadFont'];
$accent1 = $GetData['AccentColour1'];
$accent2 = $GetData['AccentColour2'];

$options = ['Comfortaa', 'DM Serif Display', 'Dancing Script', 'DM Sans', 'Cardo'];
$noteTitle = $GetNote['NoteTitle'];
$noteFont = $GetNote['NoteHeadFont'];
$pageColour = $GetNote['NoteAccentColour'];
$Tag1 = $GetNote['Tag1'];
$Tag2 = $GetNote['Tag2'];

if (isset($_POST['update'])){

    $newNoteTitle=$_POST['Name'];
    $newNoteFont=$_POST['Font'];
    $newPageColour=$_POST['PageColour'];
    $newTag1 = $_POST['Tag1'];
    $newTag2 = $_POST['Tag2'];

    $sql = "UPDATE note SET NoteTitle='$newNoteTitle', NoteHeadFont='$newNoteFont', NoteAccentColour='$newPageColour', Tag1='$newTag1', Tag2='$newTag2' WHERE NoteID='$note'";
    $result1 = mysqli_query($conn, $sql);

    if(!$result1){
        header ("Location: error.php");
    } else {
        header ("Location: home.php");
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
            <td width="80%"><h1 class="user">Editing <?php echo $noteTitle;?></h1></td>
        </tr>
        </table>
        

        <div class="container">
	        <div class="register-box">
                <form method="POST" action="" enctype="multipart/form-data">
                    <label>Note Title</label>
                    <input type='text' name='Name' placeholder="Name" maxlength="25" value="<?php echo $noteTitle;?>" required>
                    <br><br>

                    <label>Filter 1</label>
                    <input type='text' name='Tag1' placeholder="Name" maxlength="25" value="<?php echo $Tag1; ?>">
                    <br><br>

                    <label>Filter 2</label>
                    <input type='text' name='Tag2' placeholder="Name" maxlength="25" value="<?php echo $Tag2; ?>">
                    <br><br>

                    <label>Font</label>
                    <select name="Font">
                                <?php
                                foreach ($options as $option) {
                                    $selected = ($option == $noteFont) ? 'selected' : '';
                                    echo "<option value='$option' style=\"font-family:'$option'\" $selected>$option</option>";
                                }
                                ?>
                    </select>
                    <br><br>

                    <div class="color-container">
                        <label>Page Colour</label>
                        <input class="style1" type="color" name="PageColour" value="<?php echo $pageColour; ?>">
                        </div>
                    <br><br>

		            <button type="submit" name="update">Update</button><br><br>
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
