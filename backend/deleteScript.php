<?php
if (isset($_POST['deleteScript'])) {
    include_once "sqlConnect.inc";      //connect to database

    $scriptName = $_POST['scriptName'];
    $path = $_POST['path'];
    $filePath = "/smartbox/*" . $path;
    $files = glob($filePath);

    if (count($files) > 0) {
        for ($i = 0; $i < count($files); $i++) {
            unlink($files[$i]);
        }

        $sql = $mysqli->prepare("DELETE FROM tblScript WHERE idScriptName=?");     //user prepare statement to delete the specific pinNumber and hostname
        $sql->bind_param('s', $scriptName);       //bound parameters
        $sql->execute();            //executes sql

        echo "Delete successfully";     //sends back a message

        $sql->close();         //close sql and connection to database
        $mysqli->close();

    } else {
        echo "No files found";
    }
}
?>