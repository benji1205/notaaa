<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

<div class="search-container">
    <form method="post">
        <div class="search-bar">
        <span class="material-symbols-outlined">search</span>
            <input type="text" name="findname" class="search-input" placeholder="Hit Enter to Search">
            <button type="submit" name="SUBMIT" class="search-button"></button>
        </div>
    </form>
</div>

<?php
if (isset($_POST['SUBMIT'])) {
    $foundname= $_POST['findname'];
    $foundname = '%' . $foundname . '%';
?>

<body onload="javascript:hidden()">
<div>
<table width="100%" class="main-table">
<!--This row should be hidden-->	
<?php
$no=1;
$data1=mysqli_query($conn,"SELECT * FROM note WHERE NoteTitle LIKE '%$foundname%' OR Tag1 LIKE '%$foundname%' OR Tag2 LIKE '%$foundname%'
");		
while ($info1=mysqli_fetch_array($data1))
{
    $NoteID = $info1['NoteID'];
            $NoteTitle = $info1['NoteTitle'];
            $NoteHeadFont = $info1['NoteHeadFont'];
            $NoteAccentColour = $info1['NoteAccentColour'];
            $Tag1 = $info1['Tag1'];
            $Tag2 = $info1['Tag2'];
?>
    <tr>
            <td width="90%">
            <a href="note.php?NoteID=<?php echo $NoteID;?>">
                <div class="table-content" style="background-color: <?php echo $NoteAccentColour;?>; font-family: <?php echo $NoteHeadFont;?>">
                    <?php echo $NoteTitle;?> <?php if($Tag1 == NULL) {}else{ ?><span class="tags"><?php echo $Tag1;?></span><?php } if($Tag2 == NULL){}else{?><span class="tags"><?php echo $Tag2;?></span><?php }?>
                </div>
                </a>
            </td>
            <td width="5%">
                <a href="editnote.php?NoteID=<?php echo $NoteID;?>"><span class="material-symbols-outlined" id="edit">edit</span></a>
            </td>
            <td width="5%">
                <a href="dropnote.php?NoteID=<?php echo $NoteID;?>"><span class="material-symbols-outlined">delete</span></a>
            </td>
        </tr>
<?php $no++;} ?>
</table>
</div>
</body>
<?php } ?>

<script>
function hidden(){
document.getElementById('hide').style.visibility = "hidden";
}
</script>

<style>
.search-container {
    display: flex;
    justify-content: left;
    padding-bottom: 2%;
    width: 100%;
}

.search-bar {
    display: flex;
    align-items: left;
    background-color: #ffffff;
    border: transparent;
    border-radius: 25px;
    overflow: hidden;
    width: 200%;
    padding-top: 10px;
    padding-bottom: 10px;
    padding-left: 5px;
    margin-top: 15px;
    margin-left: 5px;
}

.search-input {
    flex: 1;
    border: none;
    font-size: 16px;
	outline: none;
}

.search-button {
    background-color: transparent;
    border: none;
    padding: 0;
    margin: 0;
    cursor: pointer;
    display: flex;
    align-items: center;
    outline: none;
    width: 0;

}

</style>
</html>







