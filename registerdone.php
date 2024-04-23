<?php
session_start();
require 'connection.php';

?>
<html>
    <head>
    <title>notaaa</title>
        <link rel="icon" href="image/icon.png" type="image/png">
        <link rel="stylesheet" href="style.css">
    </head>


    <body class="default-background">
        <center>
            <h1>Welcome aboard!</h1>
            <p> We're so glad you can note with us! You'll now be redirected to the login screen.</p>
            <br>
            <a href="logout.php"><button class="action">Restart</button></a>
        </center>
    </body>
</html>

<style>
        center{
            justify-content:center;
            padding-top:10%;
        }

        .action{
    width: 25%;
	padding: 10px;
	background-color: #000;
	color: #fff;
	border: none;
	border-radius: 25px;
	cursor: pointer;
    font-weight: bold;
    }

    </style>