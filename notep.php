<?php
require 'connection.php';
require 'session.php';

$note = $_GET["NoteID"];
$sql = "SELECT * FROM note WHERE NoteID='$note' AND username='$user'";
$query = mysqli_query($conn, $sql);
$GetNote = mysqli_fetch_array($query);

$notepath = $GetNote['Content'];

// Check if JSON data is received
if(isset($_POST['jsonData'])) {
    // Get JSON data from POST request
    $jsonData = $_POST['jsonData'];
    $currentDateTime = date("Y-m-d H:i:s");
    
    $sql = "UPDATE note SET LastEdit='$currentDateTime' WHERE NoteID='$note'";
    $query = mysqli_query($conn, $sql);

    // File path to save JSON data
    $filePath = $notepath;

    // Write JSON data to file
    file_put_contents($filePath, $jsonData);

    // Optionally, you can send a response back to the client
    echo "<script>alert('Successfully Saved');
		window.location='note.php?NoteID=$note'</script>";
} else {
    // If JSON data is not received, return an error response
    http_response_code(400);
    echo 'Error: JSON data not received.';
}
?>
