<?php
if (isset($_POST['deleteEvent'])){
    include_once "sqlConnect.inc";      //connects to the database
    $eventCode= $_POST['eventCode'];
    $hostname= $_POST['hostname'];
    $pinNr= $_POST['pinNr'];

    $sql = $mysqli->prepare("DELETE FROM tblEvent WHERE idEventCode=? AND fiPinNr=? AND fiHostname=?");     //use prepare statement to delete the specific Group
    $sql->bind_param('sis', $eventCode,$pinNr, $hostname);       //bound parameters
    $sql->execute();            //executes sql

    echo "Delete successfully";     //sends back a message

    $sql->close();         //close sql and connection to database
    $mysqli->close();
}
?>