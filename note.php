<?php
//Required to connect database
require 'connection.php';
//Required to ensure session is running
require 'session.php';
include 'header2.php';

$user = $_SESSION['username'];
$note = $_GET['NoteID'];
$sql = "SELECT * FROM note WHERE NoteID='$note' AND username='$user'";
$query = mysqli_query($conn, $sql);
$GetNote = mysqli_fetch_array($query);

?>
<head>
<title>notaaa</title>
<link rel="icon" href="image/icon.png" type="image/png">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>
<style>

    h1{
        font-family: <?php echo $GetNote['NoteHeadFont'];?>;
    }
    .container{
        margin-top: 10%;
        margin-left: 25%;
        margin-right: 25%;
        margin-bottom: 5%;
    }

        .editor {
            border: 2px solid rgba(0, 0, 0, .0);
            padding: 10px;
            min-height: auto;
            font-size: 16px;
        }

        .editor:hover {
            border: 2px solid rgba(0, 0, 0, .25);
            border-radius: 5px;
        }

        button {
            padding: 8px 16px;
            margin: 4px;
            border: none;
            background-color: rgba(0, 0, 0, .1);
            color: #000000;
            border-radius: 4px;
            cursor: pointer;
        }

        body{
            background-color: <?php echo $GetNote['NoteAccentColour'];?>;
        }
        .style1 {
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  width: 60px;
  height: 44px;
  background-color: rgba(0, 0, 0, .1);
  border: none;
  cursor: pointer;
  margin: 4px;
  padding: 8px 16px;
  border-radius: 4px;
}
.style1::-webkit-color-swatch {
  border-radius: 25px;
  border: none;
}
.style1::-moz-color-swatch {
  border-radius: 25px;
  border: none;
}
    </style>

<body onload="loadJSONData()">
        <div class="container">
        <h1><?php echo $GetNote['NoteTitle'];?></h1>
        <table width="100%">
            <tr>
                <td width="95%">
        <button id="boldButton"><span class="material-symbols-outlined">format_bold</span></button>
        <button id="italicButton"><span class="material-symbols-outlined">format_italic</span></button>
        <button id="underlineButton"><span class="material-symbols-outlined">format_underlined</span></button>
    <!-- <button id="addCheckboxButton">Add Checkbox</button> -->
    <!--<button id="emojipicker">Emoji</button>-->
    
    <!-- Add a color picker input -->
    <input type="color" id="textColorPicker" class="style1">    
    <button id="changeColorButton"><span class="material-symbols-outlined">format_paint</span></button>
                </td>
                <td width="5%">
    <button id="saveButton"><span class="material-symbols-outlined">save</span></button>
                </td>
    </tr>
        </table>
    <div class="editor" contenteditable="true" id="editor" autofocus></div>
        </div>

    
    <form id="jsonForm" action="notep.php?NoteID=<?php echo $note?>" method="post">
        <input type="hidden" name="jsonData" id="jsonDataInput">
        <button type="submit" style="display: none;" id="submitJsonDataButton"></button>
    </form>

    <script>
        const editor = document.getElementById('editor');
        const boldButton = document.getElementById('boldButton');
        const italicButton = document.getElementById('italicButton');
        const underlineButton = document.getElementById('underlineButton');
        const textColorPicker = document.getElementById('textColorPicker');
        const changeColorButton = document.getElementById('changeColorButton');
        // const addCheckboxButton = document.getElementById('addCheckboxButton');
        const saveButton = document.getElementById('saveButton');
        
        boldButton.addEventListener('click', () => {
            document.execCommand('bold', false, null);
            editor.focus();
        });
        
        italicButton.addEventListener('click', () => {
            document.execCommand('italic', false, null);
            editor.focus();
        });
        
        underlineButton.addEventListener('click', () => {
            document.execCommand('underline', false, null);
            editor.focus();
        });
        
        // Change text color using the color picker
        changeColorButton.addEventListener('click', () => {
            const selectedColor = textColorPicker.value;
            document.execCommand('foreColor', false, selectedColor);
            editor.focus();
        });

        // addCheckboxButton.addEventListener('click', () => {
        //     const checkbox = document.createElement('input');
        //     checkbox.type = 'checkbox';
        //     editor.appendChild(checkbox);
        //     editor.appendChild(document.createTextNode(' ')); // Add a space for separation
        //     editor.focus();
        // });

        function getIndex(str, char, n) {
            return str.split(char).slice(0, n).join(char).length;
        }

        saveButton.addEventListener('click', (event) => {
            event.preventDefault()
            let editorContent = editor.innerHTML;
            const content=editorContent;
            // const checkboxes = Array.from(editor.querySelectorAll('input[type="checkbox"]')).map((checkbox, index) => {
            //     let position=getIndex(editorContent, checkbox.outerHTML, index + 1)
                
            //     return {
            //         position,
            //         checked: checkbox.checked
            //     };
            // });
            const jsonData = {
                content,
                checkboxes: []
            };
            const jsonString = JSON.stringify(jsonData, null, 2);
            document.getElementById('jsonDataInput').value = jsonString;
            document.getElementById('submitJsonDataButton').click();
        });

// Function to load JSON data from file and populate editor
function loadJSONData() {
    fetch('<?php echo $GetNote['Content']; ?>')
    .then(response => response.json())
    .then(data => {
    const editor = document.getElementById('editor');
    editor.innerHTML = data.content;

    // Remove defaut checkboxes
    editor
        .querySelectorAll('input[type=checkbox]')
        .forEach((checkbox) => checkbox.remove());

    // Add editable checkboxes
    // Number of extra characters to shift by
    let shift = 0;

    data.checkboxes.forEach((checkboxData) => {
        // Create the checkbox with the correct attributes
        const checkbox = document.createElement('input');
        checkbox.setAttribute('type', 'checkbox');

        //Set checked state
        if (checkboxData.checked) {
            checkbox.setAttribute('checked', checkboxData.checked);
        }
    

    // Add the checkbox to the the right position
    editor.innerHTML =
    editor.innerHTML.slice(0, checkboxData.position + shift) +
    checkbox.outerHTML +
    editor.innerHTML.slice(checkboxData.position + shift);

    // Update number of characters to shift the remaining content
    if (checkboxData.checked) {
    shift += 'checked="true"'.length + 1;
    }
});
  });
}

    </script>
</body>
</html>