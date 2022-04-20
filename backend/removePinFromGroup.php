<?php
if (isset($_POST['removePin'])){
    include_once "sqlConnect.inc";      //connects to the database
    $pinNr= $_POST['pinNr'];
    $group= $_POST['group'];
    $hostname= $_POST['hostname'];

    $sql = $mysqli->prepare("DELETE FROM tblAffect WHERE fiGroupNr=? AND fiPinNr=? AND fiHostname=?");     //user prepare statement to delete the specific pinNumber and hostname
    $sql->bind_param('iis', $group, $pinNr, $hostname);       //bound parameters
    $sql->execute();            //executes sql

    echo "Remove successfully";     //sends back a messageDE

    $sql->close();         //close sql and connection to database
    $mysqli->close();
}
?>