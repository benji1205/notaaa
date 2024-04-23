<?php
//Needed to connect the database
require 'connection.php';

//Indicates if a session has begun
session_start();

//Replacing data to enter the SQL query
if (isset($_POST['username']) && isset($_POST['password'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $query = mysqli_query($conn,
        "SELECT s.*, u.* FROM user u, accsecurity s WHERE u.username=s.username AND u.username='$user'");
    //Fetches results from SQL
    $rows = mysqli_fetch_assoc($query);

    if(!$query){
        echo "Error: " . $query . "<br>" . mysqli_error($conn); 
    }

    $getcode = $rows['password'];
    $verify = password_verify($pass, $getcode);

    //Checks if the data exist in the database
    if (mysqli_num_rows($query) == 0 || !$verify) {
        //if it doesn't exist it will show a pop up to indicate and return to login.php
        echo "<script>
                alert('The UserID or password is incorrect.');
                window.location = 'index.php';
            </script>";
    } else {
        $_SESSION['username'] = $rows['username'];
        header("Location:home.php");
        exit(); // Exit after redirecting to prevent further execution
    }
} else if (isset($_POST['username'])){

    $user = $_POST['username'];

    $query = mysqli_query($conn,
        "SELECT s.*, u.* FROM user u, accsecurity s WHERE u.username=s.username AND u.username='$user'");
    //Fetches results from SQL
    $rows = mysqli_fetch_assoc($query);


    if(!$query){
        echo "Error: " . $query . "<br>" . mysqli_error($conn); 
    }

    if (mysqli_num_rows($query) == 0) {
        //if it doesn't exist it will show a pop up to indicate and return to login.php
        echo "<script>
                alert('The UserID or password is incorrect.');
                window.location = 'index.php';
            </script>";
    } else {
        $_SESSION['username'] = $rows['username'];
        header("Location:home.php");
        exit(); // Exit after redirecting to prevent further execution
    }

}
