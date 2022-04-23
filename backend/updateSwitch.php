<?php
if (isset($_POST['switchUpdate'])) {
    include_once "sqlConnect.inc";      //connects to database

    $editSwitchDesc = $_POST['editSwitchDesc'];
    $editSwitchSeq = $_POST['editSwitchSeq'];
    $editSwitchDelay = $_POST['editSwitchDelay'];
    $functionsCode = $_POST['functionsCode'];
    $hostname = $_POST['hostname'];
    $eventCode = $_POST['eventCode'];
    $pinNr = $_POST['pinNr'];
    $groupNr = $_POST['groupNr'];

    $sql = $mysqli-> prepare("UPDATE tblExecuteTheSwitch SET dtDescription =?, dtSequenceNr =?, dtDelay =? WHERE idShouldFunctionsCode =? AND fiHostname =? AND fiEventCode =? AND fiPinNr =? AND fiGroupNr =?");    //use prepare statement to update the values from specific group
    $sql->bind_param('siisssii', $editSwitchDesc, $editSwitchSeq, $editSwitchDelay, $functionsCode, $hostname, $eventCode, $pinNr, $groupNr);     //bound parameter
    $sql-> execute();       //executes sql
    echo "Update successfully";     //sends message back

    $sql->close();      //close sql and database connection
    $mysqli->close();
}
?>