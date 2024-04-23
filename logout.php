<?php
session_start(); // Initialize the session

if (session_destroy()) {
    // Session destroyed successfully
    header("location: index.php");
    exit();
} else {
    // Handle the case when there was an issue destroying the session
    echo "Error: Unable to destroy the session.";
}
?>
