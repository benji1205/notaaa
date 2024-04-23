<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
</head>   
  
<?php
//This is to validate whether if this is an admin or normal user
//If the status has "Admin" then it will show the admin header
$user=$_SESSION["username"];
$UserData=mysqli_query($conn, "SELECT u.*, c.* FROM user u, acccustomise c WHERE u.username=c.username AND u.username='$user'");
$GetUser=mysqli_fetch_array($UserData);

$accent1 = $GetUser['AccentColour1'];

?>
<!-- Header -->
<header class="header">
    <a href="home.php" class="logo"><h2>notaaa</h2></a>
    <nav>
    <div class="dropdown">
                <a class="nav-link" href="profile.php">
                    <?php echo "<img src='image/userpfp/".$GetUser['userpfp']."' alt='Profile Picture'>"?>
                </a>
            </button>
                
                    <div class="dropdown-content">
                        <a href="logout.php">Log out</a>
                    </div>
                </div>   
    </nav>
</header>
</html>

<style>
/*header*/
header {
    position: fixed;
    width: 100%;
    top: 0;
    left: 0;
    display: flex;
    justify-content: space-between;
    align-items: center; /* Center vertically */
    padding-left: 40px;
    padding-right: 10px;
    z-index: 100;
    transition: all 0.2s ease-out;
    background-color:#fff;  
}
header .nav-link{
    margin-right: 100px;
}
header.scrolled {
    position: sticky;
    background-color:#fff;  
}

.nav-links {
    list-style-type: none;
    margin: 0;
    padding: 0;
}

.nav-link {
    display: block; /* Make the link a block-level element */
}

.nav-link img {
    border-radius: 50%;
    width: 50px;
    height: 50px;
    object-fit: cover;
    display: block; /* Ensure the image is a block-level element */
    margin: 0; /* Reset margin */
    padding: 0; /* Reset padding */
}

/* The container <div> - needed to position the dropdown content */
.dropdown {
  position: relative;
  display: inline-block;
}

/* Dropdown Content (Hidden by Default) */
.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 80px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
  border-radius: 25px;
}

header .logo{
    text-decoration: none;
    color: <?php echo $accent1;?>;
}

/* Links inside the dropdown */
.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

/* Change color of dropdown links on hover */
.dropdown-content a:hover {
    background-color: #f1f1f1;
    border-radius: 25px;
}

/* Show the dropdown menu on hover */
.dropdown:hover .dropdown-content {
  display: block;
}

</style>
