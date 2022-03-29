<?php
if (isset($_POST['deletePins'])){
    include_once "sqlConnect.inc";      //connect to database

    $delPinNr= $_POST['pinNr'];         // saves post values into variables
    $hostname= $_POST['hostname'];

    $sql = $mysqli->prepare("DELETE FROM tblPin WHERE idPinNr=? AND fiHostname=?");     //user prepare statement to delete the specific pinNumber and hostname
    $sql->bind_param('is', $delPinNr, $hostname);       //bound parameters
    $sql->execute();            //executes sql

    echo "Delete successfully";     //sends back a message

    $sql->close();         //close sql and connection to database
    $mysqli->close();

}
?>
