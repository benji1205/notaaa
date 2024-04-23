<?php
//Required to connect database
require 'connection.php';
//Required to ensure session is running
require 'session.php';
include 'header2.php';

$user = $_SESSION['username'];

$sql = "SELECT u.*, c.* FROM user u, acccustomise c WHERE u.username=c.username AND u.username='$user'";
$query = mysqli_query($conn, $sql);
$GetData=mysqli_fetch_array($query);

$coverimage = $GetData['CoverPhoto'];
$font = $GetData['HeadFont'];
$accent1 = $GetData['AccentColour1'];
$accent2 = $GetData['AccentColour2'];
$name = $GetData['name'];

$sql = "SELECT n.*, u.* FROM user u, note n WHERE n.username=u.username AND u.username='$user' ORDER BY LastEdit DESC";

?>

<html>
    <head>
        <title>notaaa</title>
        <link rel="icon" href="image/icon.png" type="image/png">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    </head>
    <body>
        <div class="cover-container">
            <img class="cover" src="<?php echo $coverimage;?>"/>
        </div>
        <div class="main-container">
        <table width="100%">
        <tr>
            <td width="90%"><h1 class="user">Welcome Back, <?php echo $name;?>!</h1></td>
            <td width="10%"><a href="newnote.php" class="icon"><span class="material-symbols-outlined">add</span></a></td>
        </tr>
        </table>
        <?php include 'search.php';?>
        <div id="hide">
        <?php
        $query = mysqli_query($conn, $sql);

        ?>
        <table width="100%" class="main-table">
        <?php
        while ($rows = mysqli_fetch_assoc($query)){

            $NoteID = $rows['NoteID'];
            $NoteTitle = $rows['NoteTitle'];
            $NoteHeadFont = $rows['NoteHeadFont'];
            $NoteAccentColour = $rows['NoteAccentColour'];
            $Tag1 = $rows['Tag1'];
            $Tag2 = $rows['Tag2'];
            ?>

        <tr>
            <td width="90%">
            <a href="note.php?NoteID=<?php echo $NoteID;?>">
                <div class="table-content" style="background-color: <?php echo $NoteAccentColour;?>; font-family: <?php echo $NoteHeadFont;?>">
                    <?php echo $NoteTitle;?> <?php if($Tag1 == NULL) {}else{ ?><span class="tags"><?php echo $Tag1;?></span><?php } if($Tag2 == NULL){}else{?><span class="tags"><?php echo $Tag2;?></span><?php }?>
                </div>
            </a>
        </td>
        <td width="5%">
            <a href="editnote.php?NoteID=<?php echo $NoteID;?>"><span class="material-symbols-outlined" id="edit">edit</span></a>
        </td>
        <td width="5%">
            <a href="dropnote.php?NoteID=<?php echo $NoteID;?>"><span class="material-symbols-outlined">delete</span></a>
        </td>
        </tr>
        <?php 
        }
        ?>
        </table>
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
			width: 50%;
			padding: 10px;
            margin: 10px;
			background-color: <?php echo $accent1;?>;
			color: #fff;
			border: none;
			border-radius: 25px;
			cursor: pointer;
			font-weight: bold;
            margin-bottom: 7%;
            font-family: <?php echo $font;?>;
		}

    .tags{
        font-size: 13px;
        background-color: rgba(0, 0, 0, 0.1);
        padding: 7px;
        border-radius: 25px;
        margin-right: 5px;
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
        height: 400px;
        object-fit: cover;
    }

    .main-container {
        margin-left: 10%;
        margin-right: 10%;
        margin-top: 2%;
        margin-bottom: 4%;
    }

    .table-content {
        margin: 3px;
        padding: 15px;
        border-radius: 10px;
        box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.2);
    }

    .main-table a{
        text-decoration: none;
        color: #000000;
        font-size: 20px;
    }
    
    .icon .material-symbols-outlined {
        font-variation-settings:
        'FILL' 0,
        'wght' 300,
        'GRAD' 0,
        'opsz' 24;
        color: #ffffff;
        font-size: 50px;
        background-color: <?php echo $accent1;?>;
        border-radius: 50px;
    }

    .material-symbols-outlined {
        font-variation-settings:
        'FILL' 0,
        'wght' 300,
        'GRAD' 0,
        'opsz' 24;
        color: #000000;
        font-size: 30px;
    }

</style>