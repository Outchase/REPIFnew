<?php
if (isset($_POST['deleteScriptSm'])) {
    include_once "sqlConnect.inc";


    $hostname = $_POST['hostname'];
    $scriptName = $_POST['scriptName'];

    $filePath = "/smartbox/" . $hostname . "/*/" . $scriptName . ".sh";
    $files = glob($filePath);


    if (count($files) > 0) {
        unlink($files[0]);

         echo "Delete successfully";     //sends back a message


    }else {
        echo "Script does not exist in Smartbox folder";
    }

    $sql = $mysqli->prepare("DELETE tblUse FROM tblUse INNER JOIN tblAffect ON tblAffect.fiGroupNr=tblUse.fiGroupNr WHERE tblAffect.fiHostname=? AND tblUse.fiScriptName=?");     //use prepare statement to delete Script from Smartbox
    $sql->bind_param('ss', $hostname,$scriptName);       //bound parameters
    $sql->execute();            //executes sql
    $sql->close();         //close sql and connection to database
    $mysqli->close();
}
?>
