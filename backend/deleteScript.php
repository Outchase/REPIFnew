<?php
if (isset($_POST['deleteScript'])){
    include_once "sqlConnect.inc";      //connect to database

    $scriptName= $_POST['scriptName'];
    $dirPath= "/smartbox/*/".$scriptName;
    $filePath= "/smartbox/*/".$scriptName."/*";
    $dirs= glob($dirPath);
    $files= glob($filePath);

    if (count($dirs)>0) {
        for ($i = 0; $i < count($dirs); $i++) {
            unlink($files[$i]);
            rmdir($dirs[$i]);
        }

        $sql = $mysqli->prepare("DELETE FROM tblScript WHERE idScriptName=?");     //user prepare statement to delete the specific pinNumber and hostname
        $sql->bind_param('s', $scriptName);       //bound parameters
        $sql->execute();            //executes sql

        echo "Delete successfully";     //sends back a message

        $sql->close();         //close sql and connection to database
        $mysqli->close();

    } else {
        echo "No directory/files found";
    }
    //unlink("/smartbox/SB_4/".$scriptName."/Twice-Feel.sh"); // works
}
?>