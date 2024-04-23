<?php
require 'connection.php';
require 'session.php';

$NoteID = $_GET['NoteID'];

$sql = "SELECT * FROM note WHERE NoteID='$NoteID'";
$query = mysqli_query($conn, $sql);
$GetNote=mysqli_fetch_array($query);

?>
<html>
    <head>
        <title>notaaa</title>
        <link rel="icon" href="image/icon.png" type="image/png">
        <link rel="stylesheet" href="style.css">
    </head>


    <body class="error-background">
        <center>
            <h1>Deleting <?php echo $GetNote['NoteTitle'];?></h1>
            <p>Are you sure you'd like to delete? You can't retrieve the file back once deleted!</p>
            <br>
            <a href="home.php"><button class="anti-action">No</button></a>
            <form method="POST" action="dropnotep.php?NoteID=<?php echo $NoteID;?>">
                <button class="action" name="comfirm">Yes</button></a>
            </form>
        </center>
    </body>
</html>

<style>
        center{
            justify-content:center;
            padding-top:10%;
        }

        form{
            padding: 10px;
        }

        .action{
    width: 25%;
	padding: 10px;
	background-color: transparent;
	color: #fff;
	border: none;
	border-radius: 25px;
	cursor: pointer;
    font-weight: bold;
    text-decoration: underline;
    }

    .action:hover{
    width: 25%;
	padding: 10px;
	background-color: #000000--;
	color: #fff;
	border: none;
	border-radius: 25px;
	cursor: pointer;
    font-weight: bold;
    }

    .anti-action{
    width: 25%;
	padding: 10px;
	background-color: #fff;
	color: red;
	border: none;
	border-radius: 25px;
	cursor: pointer;
    font-weight: bold;
    }

    </style>