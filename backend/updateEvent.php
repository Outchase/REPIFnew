<?php
if (isset($_POST['updateEvent'])) {
    include_once "sqlConnect.inc";      //connects to database
    $eventCode = $_POST['code'];
    $eventDesc = $_POST['eventDesc'];
    $hostname = $_POST['hostname'];
    $pinNr= $_POST['pinNr'];

    $sql = $mysqli-> prepare("UPDATE tblEvent SET idEventCode=?, dtDescription =? WHERE fiPinNr=? AND fiHostname=?");    //use prepare statement to update the values from specific group
    $sql->bind_param('ssis', $eventCode, $eventDesc, $pinNr, $hostname);     //bound parameter
    $sql-> execute();       //executes sql
    echo "Update successfully";     //sends message back

    $sql->close();      //close sql and database connection
    $mysqli->close();
}

?>