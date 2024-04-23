<?php
require 'connection.php';
require 'session.php';

$NoteID = $_GET['NoteID'];

if (isset($_POST['comfirm'])){

    $NoteID = $_GET['NoteID'];

    $sql1 = "DELETE FROM note WHERE NoteID=$NoteID";
    $query2 = mysqli_query($conn, $sql1);

    if (!$query2){
        header("error.php");
    }else{
        echo "<script>alert('Successfully Deleted');
		window.location='home.php'</script>";
    }
}
?>