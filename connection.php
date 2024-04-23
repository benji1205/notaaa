<?php
//Database Setup
$servername="localhost";
$username="root";
$password="";
$database="notaaa";
date_default_timezone_set("Asia/Kuala_Lumpur");

$conn=mysqli_connect($servername, $username, $password, $database);
// Check the connection status
if (mysqli_connect_errno()) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>