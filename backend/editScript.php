<?php
if (isset($_POST['editScript'])) {
    include_once "sqlConnect.inc";      //connect to database
    $scriptName = $_POST['scriptName'];
    $path = $_POST['path'];
    $fileContent = file_get_contents("/smartbox/Scripts" . $path);

    $sql = "SELECT dtDescription FROM tblScript WHERE idScriptName= '$scriptName'";
    $result = $mysqli->query($sql);             //saves the result in a variable
    $row = mysqli_fetch_assoc($result);

    $output = "<h2>Script " . $scriptName . "</h2>";
    $output .= "<form method='post' onsubmit=updateScriptContent('" . $path . "','".$scriptName."') class='form'>
        <label>Description: <input id='scriptDesc' type='text' value='".$row['dtDescription']."'></label><br>
        <textarea id='scriptContentForm' required>" . $fileContent . "</textarea><br>
        <div class='formButton'><input type='submit' value='Update' class='normalBtn'>";
    $output.="<button onclick='cancelUpload()' class='normalBtn'>Cancel</button></div>";

    echo $output;
}

?>