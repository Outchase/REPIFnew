<?php
if (isset($_POST['updateScriptContent'])) {
    include_once "sqlConnect.inc";      //connect to database

    $scriptName = $_POST['scriptName'];
    $path = $_POST['path'];
    $scriptDesc = $_POST['scriptDesc'];
    $scriptContent = $_POST['scriptContent'];
    $filePath = "/smartbox/Scripts" . $path;
    $file= fopen($filePath, "w+");

    if ($file) {
        fwrite($file, $scriptContent);
        fclose($file);

        $sql = $mysqli-> prepare("UPDATE tblScript SET dtDescription=? WHERE idScriptname=?");        //use prepare statement to update values from specific hostname
        $sql->bind_param('ss', $scriptDesc, $scriptName);      //bound parameters
        $sql-> execute();   //excutes sql

        echo "Update successfully";     //return message back

        $sql->close();      //close sql and database connection
        $mysqli->close();

    } else {
        echo "No files found";
    }
}
?>