<?php

session_start();

$user=$_SESSION["username"];
$UserData=mysqli_query($conn, "SELECT u.*, c.*, s.* FROM user u, acccustomise c, accsecurity s WHERE u.username=c.username AND u.username=s.username AND u.username='$user'");
$GetUser=mysqli_fetch_array($UserData);
// Get the UserID from the session data


// Check if the UserID exists in the session or redirect to login page if not set
if (!isset($username)) {
    header("Location: login.php");
    exit();
}


?>