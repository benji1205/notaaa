<?php
session_start();
require 'connection.php';

if (isset($_POST['username'])) {

	$ep = $_POST['ep'];
	$c_ep = $_POST['c_ep'];

	if($ep != $c_ep){
		echo "<script>alert('Confirm New Password must be the same as New Password');
		window.location='register1.php'</script>";
	} else {

        if (isset($_FILES['coverphoto']) && $_FILES['coverphoto']['error'] === 0) {
            $coverphoto = $_FILES['coverphoto']['tmp_name']; 
            $coverName = $_FILES['coverphoto']['name']; 
        
            $uniqueID = uniqid();
            $coverName = $uniqueID . '_' . $coverName;
        
            $destination = 'image/cover/' . $coverName;
            move_uploaded_file($coverphoto, $destination);
        
            $coverphoto = $destination;
        } else {
            $coverphoto = 'image/cover/coverdefault.png';
        }
        
        if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
            $image = $_FILES['image']['tmp_name']; 
            $imageName = $_FILES['image']['name']; 

            $uniqueID = uniqid();
            $imageName = $uniqueID . '_' . $imageName;

            $destination = 'image/userpfp/' . $imageName;
            move_uploaded_file($image, $destination);

        } else {

            $imageName = 'userdefault.png';
        }

        $username = $_POST['username'];
        $password = password_hash($_POST['ep'], PASSWORD_DEFAULT);
        $name = $_POST['Name'];
        $InfoSaved = $_POST['InfoSaved'];
        $squestion = $_POST['squestion'];
        $sanswer = $_POST['sanswer'];
        $font = $_POST['font'];
        $accent1 = $_POST['accent1'];
        $accent2 = $_POST['accent2'];

		$register1= "INSERT INTO user
		(username, name, userpfp)
		VALUES 
		('$username','$name','$imageName')";
        $register2= "INSERT INTO accsecurity
		(username, password, SQuestion1, SAnswer1, InfoSaved)
		VALUES 
		('$username','$password','$squestion', '$sanswer', '$InfoSaved')";
        $register3 = "INSERT INTO acccustomise
        (username, CoverPhoto, HeadFont, AccentColour1, AccentColour2)
        VALUES
        ('$username','$coverphoto','$font','$accent1','$accent2')";

        $result1 = mysqli_query($conn, $register1);
        $result2 = mysqli_query($conn, $register2);
        $result3 = mysqli_query($conn, $register3);

        if ($result1 && $result2 && $result3) {
            header ("Location:registerdone.php");
        } else {
            header ("location:error.php");
        }
	}
}
?>