<?php
if(isset($_POST['editScriptSm'])){
    $hostname=$_POST['hostname'];
    $path=$_POST['path'];
    $filePath = "/smartbox/".$hostname."/*/". $path . ".sh";
    $fileSource = glob($filePath);
    $fileContent = file_get_contents($fileSource[0]);

    $output = "<h2>Script " . $path . "</h2>";
    $output .= "<form method='post' onsubmit=updateSmScriptContent('" . $path . "','".$hostname."') class='form'>
        <textarea id='smScriptContentForm' required>" . $fileContent . "</textarea><br>
        <div class='formButton'><input type='submit' value='Update' class='normalBtn'>";
    $output.="<input class='normalBtn' type='button' value='Close' onclick='cancelChanges()'></div></form>";

    echo $output;
}
?>